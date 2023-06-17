@extends('superadmin.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>All Notifications</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse ($notifications as $notification)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $notification->data['heading'] }}</h5>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <p>{{ $notification->data['notification'] }}</p>
                            <hr>
                            <div class="text-end">
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary btn-sm">Mark as Read</button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No notifications found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
