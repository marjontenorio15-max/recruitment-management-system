<!-- Employer Dedicated Corporate Navbar (Role 2) -->
<header class="navbar navbar-expand-lg navbar-light rms-navbar sticky-top bg-white border-bottom shadow-sm">
    <div class="container-fluid px-lg-4">

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-1" href="{{ route('home') }}">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="d-inline-block align-text-top">
                <rect width="36" height="36" rx="8" fill="#0f172a" />
                <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="#0284c7" />
                <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M18 11L25 18L18 25" stroke="#0284c7" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>

            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-dark fs-5 tracking-tight" style="color: #0f172a !important;">RMS</span>
                <span class="fw-bold text-uppercase"
                    style="font-size: 0.65rem; color: #0284c7 !important; letter-spacing: 0.05em;">Employer
                    Portal</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#employerNavbar" aria-controls="employerNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & Employer Actions -->
        <div class="collapse navbar-collapse" id="employerNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('home*') ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <i class="bi bi-house-door text-sky-600"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('vacancy.*') ? 'active' : '' }}"
                        href="{{ route('vacancy.index') }}">
                        <i class="bi bi-briefcase"></i> Postings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('employer-applicant-table-record') ? 'active' : '' }}"
                        href="{{ route('employer-applicant-table-record') }}">
                        <i class="bi bi-person-lines-fill"></i> Candidates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}"
                        href="{{ route('reports.index') }}">
                        <i class="bi bi-file-earmark-bar-graph"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rms-nav-link {{ request()->routeIs('employer-profile') ? 'active' : '' }}"
                        href="{{ route('employer-profile') }}">
                        <i class="bi bi-building-gear"></i> Company Profile
                    </a>
                </li>
            </ul>

            <!-- Employer Profile Dropdown -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <a href="{{ route('vacancy.create') }}"
                    class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 font-semibold text-xs d-none d-sm-inline-flex align-items-center gap-1.5">
                    <i class="bi bi-plus-circle"></i>
                    <span>Post Vacancy</span>
                </a>

                <div class="dropdown">
                    <button
                        class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle shadow-sm"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-avatar-badge" style="background-color: #0284c7;">
                            {{ strtoupper(substr(auth()->user()->username ?? (auth()->user()->name ?? 'E'), 0, 1)) }}
                        </span>
                        <span
                            class="fw-semibold text-dark small me-1">{{ auth()->user()->username ?? (auth()->user()->name ?? 'Employer') }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 p-0 overflow-hidden"
                        style="min-width: 230px;">
                        <li class="px-3 py-2.5 bg-light border-bottom">
                            <span class="d-block text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">Employer
                                Account</span>
                            <span
                                class="fw-bold text-dark small d-block text-truncate">{{ auth()->user()->name ?? auth()->user()->username }}</span>
                            <div class="text-muted extra-small text-truncate">{{ auth()->user()->email }}</div>
                            <span class="badge bg-sky-100 text-sky-700 border border-sky-200 rounded-pill mt-1"
                                style="font-size: 0.65rem;">
                                Corporate Recruiter
                            </span>
                        </li>
                        <li class="p-1">
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('employer-profile') }}">
                                <i class="bi bi-person-gear text-primary"></i> Company Profile
                            </a>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('vacancy.index') }}">
                                <i class="bi bi-briefcase text-secondary"></i> Manage Vacancies
                            </a>
                            <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                                href="{{ route('employer-applicant-table-record') }}">
                                <i class="bi bi-people text-info"></i> Candidate Submissions
                            </a>
                            <hr class="dropdown-divider my-1">
                            <a class="dropdown-item text-danger rounded-2 py-2 d-flex align-items-center gap-2 fw-medium small"
                                href="{{ route('logout.perform') }}">
                                <i class="bi bi-box-arrow-right fs-6"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
