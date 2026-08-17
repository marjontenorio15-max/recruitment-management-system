<!-- Applicant Dedicated Corporate Navbar (Role 3) -->
<header class="navbar navbar-expand-lg navbar-light rms-navbar sticky-top bg-white border-bottom shadow-sm">
    <div class="container-fluid px-lg-4">

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-1" href="{{ route('front-page') }}">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="d-inline-block align-text-top">
                <rect width="36" height="36" rx="8" fill="#0f172a" />
                <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="#10b981" />
                <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M18 11L25 18L18 25" stroke="#10b981" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>

            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-dark fs-5 tracking-tight" style="color: #0f172a !important;">RMS</span>
                <span class="fw-bold text-uppercase"
                    style="font-size: 0.65rem; color: #10b981 !important; letter-spacing: 0.05em;">Jobseeker
                    Portal</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#applicantNavbar" aria-controls="applicantNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & Applicant Actions -->
        <div class="collapse navbar-collapse" id="applicantNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('front-page') ? 'active' : '' }}"
                        href="{{ route('front-page') }}">
                        <i class="bi bi-house-door text-emerald-600"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('view-jobs') ? 'active' : '' }}"
                        href="{{ route('view-jobs') }}">
                        <i class="bi bi-search text-emerald-600"></i> Find Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('applicant-dashboard') ? 'active' : '' }}"
                        href="{{ route('applicant-dashboard') }}">
                        <i class="bi bi-journal-check text-emerald-600"></i> Applied Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('account-profile') ? 'active' : '' }}"
                        href="{{ route('account-profile') }}">
                        <i class="bi bi-person-circle text-emerald-600"></i> My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">
                        <i class="bi bi-info-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}"
                        href="{{ route('contacts') }}">
                        <i class="bi bi-envelope"></i> Contact
                    </a>
                </li>
            </ul>

            <!-- Applicant Profile Dropdown & Quick Actions -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <div class="dropdown">
                    <button
                        class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle shadow-sm"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-avatar-badge" style="background-color: #10b981;">
                            {{ strtoupper(substr(auth()->user()?->name ?? (auth()->user()?->username ?? 'U'), 0, 1)) }}
                        </span>
                        <span
                            class="fw-semibold text-dark small me-1">{{ auth()->user()?->name ?? (auth()->user()?->username ?? 'Jobseeker') }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 p-0 overflow-hidden"
                        style="min-width: 230px;">
                        <li class="px-3 py-2.5 bg-light border-bottom">
                            <span class="d-block text-muted text-uppercase fw-bold"
                                style="font-size: 0.65rem;">Candidate Account</span>
                            <span
                                class="fw-bold text-dark small d-block text-truncate">{{ auth()->user()?->name ?? (auth()->user()?->username ?? 'Jobseeker') }}</span>
                            <div class="text-muted extra-small text-truncate">{{ auth()->user()?->email }}</div>
                            <span
                                class="badge bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-pill mt-1"
                                style="font-size: 0.65rem;">
                                Verified Applicant
                            </span>
                        </li>
                        <li class="p-1">
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('account-profile') }}">
                                <i class="bi bi-person-circle text-primary"></i> Personal Profile & Resume
                            </a>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('applicant-dashboard') }}">
                                <i class="bi bi-journal-check text-success"></i> Applied Jobs Tracker
                            </a>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('view-jobs') }}">
                                <i class="bi bi-search text-info"></i> Browse Job Vacancies
                            </a>
                            <hr class="dropdown-divider my-1">
                            <a class="dropdown-item text-danger rounded-2 py-2 d-flex align-items-center gap-2 fw-medium small"
                                href="{{ route('logout.perform') }}">
                                <i class="bi bi-box-arrow-right fs-6"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('logout.perform') }}"
                   class="btn btn-outline-danger btn-sm rounded-pill px-2.5 py-1.5 d-none d-md-inline-flex align-items-center gap-1 shadow-sm"
                   title="Sign Out">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="small fw-semibold">Exit</span>
                </a>
            </div>
        </div>
    </div>
</header>
