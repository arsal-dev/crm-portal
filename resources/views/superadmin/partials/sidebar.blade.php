<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->role->name }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <a href="{{ route('projects.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a
                    project</a>
            </span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('superadmin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('superadmin.admins') }}">Admins</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('superadmin.employees') }}">Employees</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('superadmin.clients') }}">Clients</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('superadmin.admins.add') }}">Add User</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-project" aria-expanded="false"
                aria-controls="ui-project">
                <span class="menu-title">Projects</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-flask-outline menu-icon"></i>
            </a>
            <div class="collapse" id="ui-project">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('projects.all') }}">All</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('projects.create') }}">Create</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-inventory" aria-expanded="false"
                aria-controls="ui-inventory">
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="ui-inventory">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('inventory.all') }}">All</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('inventory.create') }}">Create</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-agreement" aria-expanded="false"
                aria-controls="ui-agreement">
                <span class="menu-title">Agreements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-document menu-icon"></i>
            </a>
            <div class="collapse" id="ui-agreement">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('agreement.all') }}">All</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('agreement.create') }}">Create</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">New Leads</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
