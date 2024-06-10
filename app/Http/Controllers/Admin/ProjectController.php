<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects= Project::all();
    
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $formData = $request->all();
        $validatedData = $this->validateProjectData($request);

        if($request->hasFile('cover_image')) {
            $img_path = Storage::disk('public')->put('projects_img',$formData['cover_image']);
            $formData['cover_image'] =  $img_path;
        };
        $newProject = new Project();
        $newProject->slug = Str::slug($formData['name'],'-');
        $newProject->fill($formData);
    
        
        $newProject->save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project= Project::findOrFail($id);

        return view('admin.projects.show', compact('project') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project= Project::findOrFail($id);

        return view('admin.projects.edit', compact('project') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateProjectData($request);
        $project = Project::findOrFail($id);
        $formData = $request->all();
    
        if ($request->hasFile('cover_image')) {
            // Rimuovi l'immagine vecchia se esiste
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            // Carica la nuova immagine
            $img_path = Storage::disk('public')->put('projects_img', $formData['cover_image']);
            $formData['cover_image'] = $img_path;
        }
    
        // Genera lo slug dal nome del progetto
        $formData['slug'] = Str::slug($formData['name'], '-');
    
        // Aggiorna il progetto con i nuovi dati
        $project->update($formData);
    
        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validateProjectData(Request $request)
    {
        return $request->validate([
            'name' => 'required|min:5|max:250',
            'client_name' => 'required|string',
            'summary' => 'nullable|string', 
        ], [
            'name.required'=> 'Il campo nome è obbligatorio.',
            'name.min' => 'Il nome deve contenere almeno 5 caratteri.',
            'name.max' => 'Il nome non può superare i 15 caratteri.',
            'client_name.required'=> 'Il campo nome cliente è obbligatorio.',
            'summary.string' => 'Il campo sommario deve essere una stringa.', 
        ]);
    }
}    
