@extends('superadmin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">All Agreements</h5>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Document</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agreements as $agreement)
                        <tr>
                            <td>{{ $agreement->name }}</td>
                            <td>{{ $agreement->description }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $agreement->document) }}" target="_blank">
                                    View Document
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('agreements.destroy', $agreement->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this agreement?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
