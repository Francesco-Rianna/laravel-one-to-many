
@extends('layouts.admin')

@section('content')

<h1 class="text-center">Create New Project</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{ route('admin.projects.store') }}"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="client_name">Client Name:</label>
        <input type="text" class="form-control" id="client_name" name="client_name">
    </div>
    <div class="">
        <label for="cover_image" class="form-label">Inserisci un immagine</label>
        <input class="form-control" type="file" id="cover_image" name="cover_image">
    </div>

    <div>
        <label for="type_id">Tipo</label>
        <select class="form-select" id="type_id" name="type_id">
            <option selected>Scegli il tipo</option>
            @foreach($types as $type)
             <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label for="summary">Summary:</label>
        <textarea class="form-control" id="summary" name="summary" rows="4" ></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection