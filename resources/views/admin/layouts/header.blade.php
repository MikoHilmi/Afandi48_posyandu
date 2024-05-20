<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            {{-- <img src="assets/img/logo.png" alt=""> --}}
            <span class="d-none d-lg-block">{{ $title->title }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
                    <span class="icon" style="font-size: 28px;"><i class="bi bi-person"></i></span>
                    {{-- <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('admin')->user()->name }}</span> --}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::guard('admin')->user()->name }}</h6>
                        <span>{{ Auth::guard('admin')->user()->email }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
