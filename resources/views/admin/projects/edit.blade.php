@extends('layouts.admin')

@section('content')

<h1 class="text-center"> Edit project</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{ route('admin.projects.update', ['project' =>$project->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$project->name}}">
    </div>
    <div class="form-group">
        <label for="client_name">Client Name:</label>
        <input type="text" class="form-control" id="client_name" name="client_name" value="{{$project->client_name}}">
    </div>
    <div class="">
        <label for="cover_image" class="form-label">Inserisci un immagine</label>
        <input class="form-control" type="file" id="cover_image" name="cover_image">
        @if ($project->cover_image)
            <div>
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}" style="width : 100px">
            </div>
        @else
           <strong>Immagine non presente</strong>
        @endif
    </div>
    <div class="form-group">
        <label for="summary">Summary:</label>
        <textarea class="form-control" id="summary" name="summary" rows="4" >{{$project->summary}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection