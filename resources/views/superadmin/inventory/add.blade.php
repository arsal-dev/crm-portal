@extends('superadmin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h5 class="card-title">Add Inventory</h5>
            <form method="POST" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture" required>
                </div>

                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" id="area" name="area" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01">
                </div>

                <div class="form-group">
                    <label for="project">Project</label>
                    <select class="form-control" id="project" name="project" required>
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add Inventory</button>
            </form>
        </div>
    </div>
@endsection
