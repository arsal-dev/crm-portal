@extends('superadmin.layouts.layout')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h4 class="card-title">All Projects</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td><img src="{{ asset('storage/' . $project->project_image) }}"
                                        alt="{{ $project->project_name }}"></td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->project_description }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td><a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-primary"
                                        title="Edit User"><i
                                            class="mdi mdi-table-edit
                                    "></i></a> &nbsp;
                                    <form method="POST" action="{{ route('projects.destroy', $project->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
