 
@extends('layouts.app')
@section('content')
@include('projects.create_project')
<div class = "container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="px-1 py-3">Projects</h1>
            <button type="button" class="btn btn-primary rounded-pill px-5 my-3" data-toggle="modal"  data-target="#create_project" data-backdrop="static" data-keyboard="false">NEW ENTRY</button>
        </div>
    </div>
    <table class="table table-bordered table-hover">
    <thead>
        <th>@sortablelink('name', 'Name')</th>
        <th>Description</th>
        <th>@sortablelink('StartDate', 'StartDate')</th>
        <th>@sortablelink('duration', 'Duration')</th>
        <th>Created At</th>
    </thead>
    <tbody>
        @if ($projects->count() == 0)
        <tr>
            <td colspan="5">No products to display.</td>
        </tr>
        @endif

        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->name}}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->startDate }}</td>
            <td>{{ $project->duration }}</td>
            <td>{{ $project->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="row">
        <div class="col-md-4">
            <p >
                Displaying {{$projects->count()}} of {{ $projects->total() }} project(s).
            </p>
        </div>
        <div class="col-md-8">
        {{ $projects->links("pagination::bootstrap-4") }}
        </div>
    <div>
</div>
@endsection