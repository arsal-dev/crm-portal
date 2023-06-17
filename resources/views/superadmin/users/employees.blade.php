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
                <h4 class="card-title">Employee Users</h4>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#notificationModalAllEmployees">
                        Send Notification to All Employees
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
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->created_at }}</td>
                                <td>
                                    <a href="{{ route('superadmin.admins.edit', ['id' => $employee->id]) }}"
                                        class="btn btn-outline-primary" title="Edit User">
                                        <i class="mdi mdi-table-edit"></i>
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('superadmin.admins.delete', $employee->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this project?')">
                                            Delete
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#notificationModal" data-user-id="{{ $employee->id }}">
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

    <!-- Single Employee Notification Modal -->
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

    <!-- All Employees Notification Modal -->
    <div class="modal fade" id="notificationModalAllEmployees" tabindex="-1"
        aria-labelledby="notificationModalAllEmployeesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="notificationModalAllEmployeesLabel">Send Notification to All Employees
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Notification form fields -->
                    <form id="notificationFormAllEmployees" method="POST"
                        action="{{ route('superadmin.send.notification.allEmployees') }}">
                        @csrf
                        <div class="form-group">
                            <label for="titleAll">Title</label>
                            <input type="text" class="form-control" id="titleAll" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="messageAll">Message</label>
                            <textarea class="form-control" id="messageAll" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Submit form when sending notification to a single employee
        $('#notificationModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var employeeId = button.data('user-id');
            $('#notificationForm').attr('action', '/superadmin/send-notification/employee/' + employeeId);
        });

        // Submit form when sending notification to all employees
        $('#notificationModalAllEmployees').on('show.bs.modal', function() {
            $('#notificationFormAllEmployees').attr('action', '/superadmin/send-notification/all-employees');
        });
    </script>
@endsection
