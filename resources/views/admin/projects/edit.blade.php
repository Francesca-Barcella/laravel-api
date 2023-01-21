@extends('layouts.admin')

@section('content')

<div class="container">
  <h1>Edit Project</h1>

  <!-- inserisco messaggio per validazione fallita -->
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{route('admin.projects.update', $project->slug)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!--CAMPO COVER_IMAGE-->
    <div class="d-flex mb-3 gap-4">
      <img src="{{asset('storage/' . $project->cover_image)}}" alt="" width="150">

      <div>
        <label for="cover_image" class="form-label @error('cover_image') is-invalid @enderror">Replace Cover Image</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control" placeholder="" aria-describedby="coverImagehelpId">
        <small id="coverImagehelpId" class="text-muted">Add cover image</small>
      </div>
    </div>

    <!-- messaggio di errore direttamente sotto al campo cover image -->
    @error('cover_image')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror

    <!--CAMPO TITLE-->
    <div class="mb-3">
      <label for="title" class="form-label">Name</label>
      <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Add New Project" aria-describedby="titleHelpId" value="{{old('title', $project->title)}}">
      <small id="titleHelpId" class="text-muted">Add new project</small>
    </div>

    <!-- messaggio di errore direttamente sotto al campo title -->
    @error('title')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror

    <!--CAMPO SELECT TYPE-->
    <div class="mb-3">
      <label for="type_id" class="form-label">Types</label>
      <select class="form-select form-select-lg @error('type_id') is-invalid @enderror" name="type_id" id="type_id">

        <option value="">No type</option>

        @foreach ($types as $type)
        <option value="{{$type->id}}" {{ $type->id == old('type_id', $project->type?->id) ? 'selected' : ''}}>{{$type->name}}
        </option>
        @endforeach
      </select>
    </div>

    <!-- messaggio di errore direttamente sotto al campo cover select type -->
    @error('type_id')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror

    <!--CAMPO TECHNOLOGY -->
    <div class="mb-3">
      <label for="technologies" class="form-label">Technology</label>
      <!--  name="technologies[]" messo al plurare e con array vuoto per far capire che name conterrà record multipli -->
      <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
        <option value="" disabled>Select Technology</option>
        @forelse($technologies as $technology)
        <!-- aggiungo un if - else per mostrare gli errori di validazione-->
        @if ($errors->any())
        <!-- cerca nell'array l'id di technology selezionata, se è inclusa nella lista old imposta 'selected' e mostra l'id preselezionato altrimenti non fa nulla-->
        <option value="{{$technology->id}}"{{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{$technology->name}}</option>
        @else
        <option value="{{$technology->id}}" {{$project->technologies->contains($technology->id) ? 'selected' : ''}}>{{$technology->name}}</option>
        @endif
        @empty
        <option value="" disabled>No Technologies here</option>
        @endforelse
      </select>
    </div>

    <!-- messaggio di errore direttamente sotto al campo Technology -->
    @error('technology_id')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror

    <!--CAMPO DESCRIPTION-->
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{old('description', $project->description)}}</textarea>
    </div>

    <!-- messaggio di errore direttamente sotto al campo description -->
    @error('description')
    <div class="alert alert-danger" role="alert">
      {{$message}}
    </div>
    @enderror

    <button type="submit" class="btn btn-primary">Update</button>

  </form>
</div>

@endsection