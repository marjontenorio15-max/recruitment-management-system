<!-- Guest Dedicated Corporate Navbar -->
<header class="navbar navbar-expand-lg navbar-light rms-navbar sticky-top bg-white border-bottom shadow-sm">
    <div class="container-fluid px-lg-4">

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-1" href="{{ route('front-page') }}">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="d-inline-block align-text-top">
                <rect width="36" height="36" rx="8" fill="#0f172a" />
                <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="#e31837" />
                <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M18 11L25 18L18 25" stroke="#e31837" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>

            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-dark fs-5 tracking-tight" style="color: #0f172a !important;">RMS</span>
                <span class="fw-bold text-uppercase"
                    style="font-size: 0.65rem; color: #e31837 !important; letter-spacing: 0.05em;">Career Portal</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#guestNavbar" aria-controls="guestNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & Guest Actions -->
        <div class="collapse navbar-collapse" id="guestNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('front-page') ? 'active' : '' }}"
                        href="{{ route('front-page') }}">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('view-jobs') ? 'active' : '' }}"
                        href="{{ route('view-jobs') }}">
                        <i class="bi bi-search"></i> Browse Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">
                        <i class="bi bi-info-circle"></i> About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}"
                        href="{{ route('contacts') }}">
                        <i class="bi bi-envelope"></i> Contact Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('term') ? 'active' : '' }}"
                        href="{{ route('term') }}">
                        <i class="bi bi-shield-check"></i> Terms
                    </a>
                </li>
            </ul>

            <!-- Authentication Actions -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <a href="{{ route('login.show') }}"
                    class="btn btn-outline-dark rounded-pill px-3.5 py-1.5 font-semibold text-xs">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Log In
                </a>
                <a href="{{ route('register.show') }}"
                    class="btn btn-danger rounded-pill px-3.5 py-1.5 font-semibold text-xs shadow-sm">
                    <i class="bi bi-person-plus-fill me-1"></i> Register
                </a>
            </div>
        </div>
    </div>
</header>
