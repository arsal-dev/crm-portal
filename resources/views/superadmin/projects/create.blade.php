@extends('superadmin.layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Project</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input id="project_name" type="text" class="form-control" name="project_name" required
                                    autofocus>
                            </div>

                            <div class="form-group">
                                <label for="project_description">Project Description</label>
                                <textarea id="project_description" class="form-control" name="project_description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="project_image">Project Image</label>
                                <input id="project_image" type="file" class="form-control" name="project_image" required>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Create Project
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
