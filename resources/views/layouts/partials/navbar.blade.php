<!-- RMS Header Navbar -->
<header class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container-fluid px-lg-4">
        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('front-page') }}">
            <img src="{{ asset('assets/img/rms1.png') }}" alt="RMS Logo" width="38" height="38" class="d-inline-block align-text-top">
            <span class="fw-bold text-dark fs-5">RMS</span>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & User Actions -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                @auth
                    @if(auth()->user()->role_id == 1)
                        <!-- Admin Links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reports.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('reports.index') }}">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('company.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('company.index') }}">Companies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vacancy.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('vacancy.index') }}">Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('apply.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('apply.index') }}">Applicants</a>
                        </li>

                    @elseif(auth()->user()->role_id == 2)
                        <!-- Employer Links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('reports.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('reports.index') }}">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vacancy.index') ? 'active fw-bold text-primary' : '' }}" href="{{ route('vacancy.index') }}">Post Job</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('employer-applicant-table-record') ? 'active fw-bold text-primary' : '' }}" href="{{ route('employer-applicant-table-record') }}">Applicants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('account-profile') ? 'active fw-bold text-primary' : '' }}" href="{{ route('account-profile') }}">Profile</a>
                        </li>

                    @else
                        <!-- Applicant Links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('front-page') ? 'active fw-bold text-primary' : '' }}" href="{{ route('front-page') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('view-jobs') ? 'active fw-bold text-primary' : '' }}" href="{{ route('view-jobs') }}">Browse Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('applicant-dashboard') ? 'active fw-bold text-primary' : '' }}" href="{{ route('applicant-dashboard') }}">Applied Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('account-profile') ? 'active fw-bold text-primary' : '' }}" href="{{ route('account-profile') }}">Account</a>
                        </li>
                    @endif
                @endauth

                @guest
                    <!-- Guest Links -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front-page') ? 'active fw-bold text-primary' : '' }}" href="{{ route('front-page') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('view-jobs') ? 'active fw-bold text-primary' : '' }}" href="{{ route('view-jobs') }}">Browse Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold text-primary' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacts') ? 'active fw-bold text-primary' : '' }}" href="{{ route('contacts') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('term') ? 'active fw-bold text-primary' : '' }}" href="{{ route('term') }}">Terms</a>
                    </li>
                @endguest
            </ul>

            <!-- Authentication Actions -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 26px; height: 26px; font-size: 0.75rem;">
                                {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
                            </span>
                            <span class="fw-semibold text-dark small">{{ auth()->user()->username }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            <li class="px-3 py-2 border-bottom">
                                <span class="d-block text-muted small" style="font-size: 0.75rem;">Signed in as</span>
                                <span class="fw-bold text-dark small">{{ auth()->user()->username }}</span>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger py-2 d-flex align-items-center gap-2" href="{{ route('logout.perform') }}">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Log In</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-primary btn-sm rounded-pill px-3">Register</a>
                @endguest
            </div>
        </div>
    </div>
</header>
