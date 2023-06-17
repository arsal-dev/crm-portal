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
                <h4 class="card-title">Admin Users</h4>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#notificationModalAllAdmins" role_id="2">
                        Send Notification to All Admins
                    </button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->created_at }}</td>
                                <td>
                                    <a href="{{ route('superadmin.admins.edit', ['id' => $admin->id]) }}"
                                        class="btn btn-outline-primary" title="Edit User"><i
                                            class="mdi mdi-table-edit"></i></a>
                                    &nbsp;
                                    <form action="{{ route('superadmin.admins.delete', $admin->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-info btn-send-notification"
                                        data-bs-toggle="modal" data-bs-target="#notificationModal"
                                        data-user-id="{{ $admin->id }}">
                                        Send Notification
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Single Admin Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="notificationModalLabel">Send Notification</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Notification form fields -->
                    <form id="notificationForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- All Admins Notification Modal -->
    <div class="modal fade" id="notificationModalAllAdmins" tabindex="-1" aria-labelledby="notificationModalAllAdminsLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="notificationModalAllAdminsLabel">Send Notification To All Admins</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Notification form fields -->
                    <form id="notificationFormAllAdmins" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Submit form when sending notification to a single admin
        $('.btn-send-notification').on('click', function() {
            var userId = $(this).data('user-id');
            $('#notificationForm').attr('action', '/superadmin/send-notification/user/' + userId);
        });

        // Submit form when sending notification to all admins
        $('#notificationModalAllAdmins').on('shown.bs.modal', function() {
            $('#notificationFormAllAdmins').attr('action', '/superadmin/send-notification/all-admins');
        });
    </script>
@endsection
