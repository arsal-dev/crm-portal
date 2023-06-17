@extends('superadmin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Inventory</h5>
            <form method="POST" action="{{ route('inventory.update', ['id' => $inventory->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $inventory->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                    <img src="{{ asset('storage/' . $inventory->picture) }}" class="img-fluid" alt="Inventory Image">
                </div>

                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" id="area" name="area" value="{{ $inventory->area }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $inventory->price }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="project">Project</label>
                    <select class="form-control" id="project" name="project" required>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ $inventory->project_id == $project->id ? 'selected' : '' }}>{{ $project->project_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Inventory</button>
            </form>
        </div>
    </div>
@endsection
