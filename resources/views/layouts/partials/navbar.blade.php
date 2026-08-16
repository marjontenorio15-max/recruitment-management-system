<!-- Custom CSS for RMS Corporate Navbar -->
<style>
    .rms-navbar {
        background-color: #ffffff;
        border-bottom: 3px solid var(--ae-red, #e31837) !important;
        box-shadow: 0 4px 12px rgba(0, 40, 85, 0.06);
    }
    .rms-nav-link {
        color: #475569 !important;
        font-weight: 500;
        font-size: 0.925rem;
        padding: 0.5rem 0.85rem !important;
        border-radius: 6px;
        transition: all 0.15s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }
    .rms-nav-link:hover {
        color: var(--ae-navy, #002855) !important;
        background-color: #f1f5f9;
    }
    .rms-nav-link.active {
        color: var(--ae-navy, #002855) !important;
        font-weight: 700 !important;
        background-color: #e8f1f8;
    }
    .btn-rms-primary {
        background-color: var(--ae-navy, #002855);
        border-color: var(--ae-navy, #002855);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.4rem 1rem;
        transition: all 0.2s ease;
    }
    .btn-rms-primary:hover {
        background-color: var(--ae-navy-dark, #001a38);
        border-color: var(--ae-navy-dark, #001a38);
        color: #ffffff;
    }
    .btn-rms-outline {
        border: 1px solid var(--ae-navy, #002855);
        color: var(--ae-navy, #002855);
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.4rem 1rem;
        transition: all 0.2s ease;
    }
    .btn-rms-outline:hover {
        background-color: var(--ae-navy, #002855);
        color: #ffffff;
    }
    .user-avatar-badge {
        background-color: var(--ae-navy, #002855);
        color: #ffffff;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- RMS Header Navbar -->
<header class="navbar navbar-expand-lg navbar-light rms-navbar sticky-top">
    <div class="container-fluid px-lg-4">

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-1" href="{{ route('front-page') }}">
            <img src="{{ asset('assets/img/rms1.png') }}" alt="RMS Logo" width="36" height="36" class="d-inline-block align-text-top">
            <div class="d-flex flex-column leading-none">
                <span class="fw-extrabold text-dark fs-5 tracking-tight lh-1" style="color: var(--ae-navy, #002855) !important;">RMS</span>
                <span class="text-muted fw-bold extra-small tracking-wider text-uppercase" style="font-size: 0.65rem; color: var(--ae-red, #e31837) !important;">Recruitment Portal</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & User Actions -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                @auth
                    @if(auth()->user()->role_id == 1)
                        <!-- Admin Links -->
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-file-earmark-bar-graph"></i> Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('company.index') ? 'active' : '' }}" href="{{ route('company.index') }}">
                                <i class="bi bi-building"></i> Companies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('vacancy.index') ? 'active' : '' }}" href="{{ route('vacancy.index') }}">
                                <i class="bi bi-briefcase"></i> Vacancies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i class="bi bi-people"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('apply.index') ? 'active' : '' }}" href="{{ route('apply.index') }}">
                                <i class="bi bi-person-badge"></i> Applicants
                            </a>
                        </li>

                    @elseif(auth()->user()->role_id == 2)
                        <!-- Employer Links -->
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                <i class="bi bi-file-earmark-bar-graph"></i> Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('vacancy.index') ? 'active' : '' }}" href="{{ route('vacancy.index') }}">
                                <i class="bi bi-plus-circle"></i> Post Job
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('employer-applicant-table-record') ? 'active' : '' }}" href="{{ route('employer-applicant-table-record') }}">
                                <i class="bi bi-person-lines-fill"></i> Applicants
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('account-profile') ? 'active' : '' }}" href="{{ route('account-profile') }}">
                                <i class="bi bi-person-gear"></i> Profile
                            </a>
                        </li>

                    @else
                        <!-- Applicant Links -->
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('front-page') ? 'active' : '' }}" href="{{ route('front-page') }}">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('view-jobs') ? 'active' : '' }}" href="{{ route('view-jobs') }}">
                                <i class="bi bi-search"></i> Browse Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('applicant-dashboard') ? 'active' : '' }}" href="{{ route('applicant-dashboard') }}">
                                <i class="bi bi-journal-check"></i> Applied Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rms-nav-link {{ request()->routeIs('account-profile') ? 'active' : '' }}" href="{{ route('account-profile') }}">
                                <i class="bi bi-person-circle"></i> Account
                            </a>
                        </li>
                    @endif
                @endauth

                @guest
                    <!-- Guest Links -->
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs('front-page') ? 'active' : '' }}" href="{{ route('front-page') }}">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs('view-jobs') ? 'active' : '' }}" href="{{ route('view-jobs') }}">
                            <i class="bi bi-search"></i> Browse Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-info-circle"></i> About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('contacts') }}">
                            <i class="bi bi-envelope"></i> Contact Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs('term') ? 'active' : '' }}" href="{{ route('term') }}">
                            <i class="bi bi-shield-check"></i> Terms
                        </a>
                    </li>
                @endguest
            </ul>

            <!-- Authentication Actions -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light border rounded-pill px-3 py-1.5 d-flex align-items-center gap-2 dropdown-toggle shadow-2xs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="user-avatar-badge">
                                {{ strtoupper(substr(auth()->user()->username ?? 'U', 0, 1)) }}
                            </span>
                            <span class="fw-semibold text-dark small me-1">{{ auth()->user()->username }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-3 mt-2 p-0 overflow-hidden" style="min-width: 200px;">
                            <li class="px-3 py-2.5 bg-light border-bottom">
                                <span class="d-block text-muted extra-small text-uppercase fw-bold">Signed in as</span>
                                <span class="fw-bold text-dark small d-block text-truncate">{{ auth()->user()->username }}</span>
                                <span class="badge bg-secondary-subtle text-secondary border rounded-pill extra-small mt-1">
                                    @if(auth()->user()->role_id == 1) Admin
                                    @elseif(auth()->user()->role_id == 2) Employer
                                    @else Applicant @endif
                                </span>
                            </li>
                            <li class="p-1">
                                <a class="dropdown-item text-danger rounded-2 py-2 d-flex align-items-center gap-2 fw-medium small" href="{{ route('logout.perform') }}">
                                    <i class="bi bi-box-arrow-right fs-6"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login.perform') }}" class="btn btn-rms-outline rounded-pill px-3">Log In</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-rms-primary rounded-pill px-3">Register</a>
                @endguest
            </div>
        </div>
    </div>
</header>
