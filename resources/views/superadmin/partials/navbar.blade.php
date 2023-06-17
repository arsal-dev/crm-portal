<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/">CRM Portal</a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-mini.svg') }}"
                alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            {{-- <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form> --}}
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count-symbol bg-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <a class="dropdown-item preview-item" data-bs-toggle="modal" data-bs-target="#notificationModal"
                            onclick="openNotificationModal({{ json_encode($notification) }})">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-calendar"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">{{ $notification->data['heading'] }}
                                </h6>
                                <p class="text-gray ellipsis mb-0">{{ $notification->data['notification'] }}</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @empty
                        <a class="dropdown-item preview-item">
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <p class="text-muted mb-0">No unread notifications</p>
                            </div>
                        </a>
                    @endforelse
                    <h6 class="p-3 mb-0 text-center"><a href="{{ route('notifications.all-notifications') }}">See all
                            notifications</a></h6>
                </div>
            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/user/profile" target="_blank">
                        <i class="mdi mdi-cached me-2 text-success"></i> Profile </a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="POST" id="signout" style="display: none;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.querySelector('#signout').submit();">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                    </a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
