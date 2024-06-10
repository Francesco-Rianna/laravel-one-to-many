@extends('layouts.admin')
@section('content')
<h1 class="text-center">Our Projects</h1>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Slug</th>
        <th scope="col">Nome cliente</th>
        <th scope="col">Testo</th>
        <th scope="col">immagine</th>
        
      </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{$project->name}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->client_name}}</td>
                <td>{{$project->summary}}</td>
                <td>
                  @if ($project->cover_image)
                    <div>
                        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}" style="width : 100px">
                    </div>
                  @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">view</a>
                    <form action="{{route('admin.projects.destroy', ['project' =>$project->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  class="btn btn-danger mt-4" type="submit">elimina</button>
                    </form>
                </td>

            </tr>
        @endforeach
            
    </tbody>
  </table>
@endsection