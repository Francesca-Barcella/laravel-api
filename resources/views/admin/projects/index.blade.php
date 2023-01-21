@extends('layouts.admin')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="table-responsive">

    <h1 class="my-3">My Projects</h1>
    <table class="table table-striped
    table-hover	
    table-borderless
    table-primary
    align-middle">

        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Cover Image</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody class="table-group-divider">
            @forelse ($projects as $project)
            <tr class="table-primary">
                <td scope="row">{{$project->id}}</td>
                <td>
                    @if($project->cover_image)
                    <img src="{{asset('storage/'. $project->cover_image)}}" alt="" class="img-fluid" width="150">
                    @else
                    <div class="placeholder p-5 bg-secondary d-flex align-items-center justify-content-center" style="width: 150px">placeholder</div>
                    @endif
                </td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.projects.show', $project->slug)}}">
                        <i class="fas fa-eye  fa-sm fa-fw"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.projects.edit', $project->slug)}}">
                        <i class="fas fa-pencil  fa-sm fa-fw"></i>
                    </a>

                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#project-{{$project->id}}">
                        <i class="fas fa-trash  fa-sm fa-fw"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="project-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modal-{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-{{$project->id}}">Delete Project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro sicuro di voler <strong>cancellare</strong> il progetto: <strong>{{$project->title}}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE');
                                        <button type="submit" class="btn btn-danger">Confirm</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td>nessun post presente</td>
            </tr>
            @endforelse
        </tbody>

        <tfoot>
        </tfoot>

    </table>

    <a name="" id="" class="btn btn-primary position-fixed bottom-0 end-0 m-3" href="{{route ('admin.projects.create')}}" role="button">Add New Project</a>
</div>


@endsection