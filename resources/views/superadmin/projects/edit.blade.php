@extends('superadmin.layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Project</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.update', $project->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Display current image -->
                            <div class="form-group">
                                <label for="current_image">Current Image</label><br>
                                <img src="{{ asset('storage/' . $project->project_image) }}" alt="Current Image"
                                    width="200">
                            </div>

                            <!-- Upload new image -->
                            <div class="form-group">
                                <label for="project_image">Project Image</label>
                                <input type="file" class="form-control @error('project_image') is-invalid @enderror"
                                    id="project_image" name="project_image">
                                @error('project_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Other project fields -->
                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input type="text" class="form-control @error('project_name') is-invalid @enderror"
                                    id="project_name" name="project_name"
                                    value="{{ old('project_name', $project->project_name) }}">
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="project_description">Project Description</label>
                                <textarea class="form-control @error('project_description') is-invalid @enderror" id="project_description"
                                    name="project_description" rows="3">{{ old('project_description', $project->project_description) }}</textarea>
                                @error('project_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
