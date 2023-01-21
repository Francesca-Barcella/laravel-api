@extends('layouts.admin')

@section('content')

@if($project->cover_image)
<img src="{{asset('storage/'. $project->cover_image)}}" alt="" class="img-fluid">
@else
<div class="placeholder p-5 bg-secondary">placeholder</div>
@endif
{{-- TITOLO PROGETTO --}}
<h1>Title project: {{$project->title}}</h1>
{{-- SLUG TITOLO PROGETTO --}}
<div><strong>Slug Title project:</strong> {{$project->slug}}</div>
{{-- TYPE PROGETTO --}}
<div><strong>Type project:</strong> {{$project->type ? $project->type->name : 'Uncatecorized'}}</div>
{{-- TECHNOLOGIES PROGETTO --}}
<div>
    <strong>Technology used:</strong> 
    @if(count($project->technologies) > 0)

    @foreach ($project->technologies as $technology)
        <div>#{{$technology->name}}</div>
    @endforeach

    @else
    <div>no technologies assigned</div>
    @endif
    </div>
{{-- DESCRIPTION PROGETTO --}}
<div><strong>Descritpion project:</strong> {{$project->description}}</div>


@endsection