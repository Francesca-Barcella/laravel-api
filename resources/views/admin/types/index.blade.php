@extends('layouts.admin')

@section('content')

<h1>Types page</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col pe-4">
            <form action="{{route('admin.types.store')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="name" name="name" type="text" class="form-control" placeholder="Type name" aria-label="Recipient's username" aria-describedby="button-addon">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon">Button</button>
                </div>
            </form>

        </div>

        <div class="col">
            <div class="table-responsive-md">
                <table class="table table-striped table-hover table-borderless table-primary align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Types Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($types as $type)

                        <tr class="table-primary">
                            <td scope="row">{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->slug}}</td>
                            <td>number of types</td>
                            <td>actions</td>
                        </tr>
                        @empty

                        <tr class="table-primary">
                            <td scope="row">No Types</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @endsection