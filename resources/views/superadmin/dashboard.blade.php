@extends('superadmin.layouts.layout')

@section('content')
    <div class="row">
        @foreach ($projects as $project)
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/' . $project->project_image) }}" alt="Project Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->project_name }}</h5>
                        <p class="card-text">{{ $project->project_description }}</p>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
