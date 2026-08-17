<!-- Unified Dashboard Enterprise Sidebar -->
<aside id="rmsAppSidebar" class="rms-dashboard-sidebar d-flex flex-column flex-shrink-0 bg-white border-end shadow-sm">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand-wrapper px-4 py-3.5 border-bottom d-flex align-items-center justify-content-between">
        <a href="{{ route('front-page') }}" class="d-flex align-items-center gap-2.5 text-decoration-none">
            <svg width="34" height="34" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="rounded-2">
                <rect width="36" height="36" rx="8" fill="#0f172a" />
                <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="{{ (auth()->user()?->role_id == 1) ? '#7c3aed' : ((auth()->user()?->role_id == 2) ? '#0284c7' : '#10b981') }}" />
                <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M18 11L25 18L18 25" stroke="{{ (auth()->user()?->role_id == 1) ? '#7c3aed' : ((auth()->user()?->role_id == 2) ? '#0284c7' : '#10b981') }}" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold fs-5 text-slate-900" style="letter-spacing: -0.03em; color: #0f172a;">RMS</span>
                <span class="fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.08em; color: {{ (auth()->user()?->role_id == 1) ? '#7c3aed' : ((auth()->user()?->role_id == 2) ? '#0284c7' : '#10b981') }};">
                    @if(auth()->user()?->role_id == 1)
                        Admin Console
                    @elseif(auth()->user()?->role_id == 2)
                        Employer Portal
                    @else
                        Candidate Portal
                    @endif
                </span>
            </div>
        </a>
        <button type="button" class="btn-close d-lg-none shadow-none text-muted" id="closeSidebarBtn" aria-label="Close"></button>
    </div>

    <!-- Sidebar Navigation Menu -->
    <div class="sidebar-nav-scroll flex-grow-1 px-3 py-3 overflow-y-auto">
        @if(auth()->user()?->role_id == 1)
            <!-- Admin Navigation -->
            <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Core Management</div>
            <ul class="nav nav-pills flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="bi bi-speedometer2 text-purple-600"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('vacancy.*') ? 'active' : '' }}" href="{{ route('vacancy.index') }}">
                        <i class="bi bi-briefcase text-slate-600"></i>
                        <span>Job Vacancies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('company.*') ? 'active' : '' }}" href="{{ route('company.index') }}">
                        <i class="bi bi-building text-slate-600"></i>
                        <span>Companies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people text-slate-600"></i>
                        <span>System Users</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Applications & Data</div>
            <ul class="nav nav-pills flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('apply.*') ? 'active' : '' }}" href="{{ route('apply.index') }}">
                        <i class="bi bi-person-lines-fill text-slate-600"></i>
                        <span>Applicants Pipeline</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                        <i class="bi bi-file-earmark-bar-graph text-slate-600"></i>
                        <span>System Reports</span>
                    </a>
                </li>
            </ul>

        @elseif(auth()->user()?->role_id == 2)
            <!-- Employer Navigation -->
            <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Recruitment Desk</div>
            <ul class="nav nav-pills flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('home*') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-speedometer2 text-sky-600"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('vacancy.create') ? 'active' : '' }}" href="{{ route('vacancy.create') }}">
                        <i class="bi bi-plus-circle text-sky-600"></i>
                        <span>Post New Vacancy</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('vacancy.index') ? 'active' : '' }}" href="{{ route('vacancy.index') }}">
                        <i class="bi bi-briefcase text-slate-600"></i>
                        <span>Manage Postings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('employer-applicant-table-record') ? 'active' : '' }}" href="{{ route('employer-applicant-table-record') }}">
                        <i class="bi bi-person-lines-fill text-slate-600"></i>
                        <span>Candidate Submissions</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Company & Analytics</div>
            <ul class="nav nav-pills flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('employer-profile') || request()->routeIs('account-profile') ? 'active' : '' }}" href="{{ route('employer-profile') }}">
                        <i class="bi bi-building-gear text-slate-600"></i>
                        <span>Company Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                        <i class="bi bi-file-earmark-bar-graph text-slate-600"></i>
                        <span>Reports & Analytics</span>
                    </a>
                </li>
            </ul>

        @else
            <!-- Applicant Navigation -->
            <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Career & Applications</div>
            <ul class="nav nav-pills flex-column gap-1 mb-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('applicant-dashboard') ? 'active' : '' }}" href="{{ route('applicant-dashboard') }}">
                        <i class="bi bi-journal-check text-emerald-600"></i>
                        <span>Applied Jobs Tracker</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('account-profile') || request()->routeIs('edit-profile') ? 'active' : '' }}" href="{{ route('account-profile') }}">
                        <i class="bi bi-person-vcard text-sky-600"></i>
                        <span>Profile & Portfolio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('view-jobs') ? 'active' : '' }}" href="{{ route('view-jobs') }}">
                        <i class="bi bi-search text-slate-600"></i>
                        <span>Browse Job Vacancies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-link {{ request()->routeIs('applicant-application-form') ? 'active' : '' }}"
                        href="{{ route('applicant-application-form') }}">
                        <i class="bi bi-file-earmark-text text-slate-600"></i>
                        <span>Application Form</span>
                    </a>
                </li>
            </ul>
        @endif

        <div class="sidebar-group-label text-uppercase fw-bold text-muted px-2.5 mb-1.5" style="font-size: 0.65rem; letter-spacing: 0.08em;">Explore</div>
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="{{ route('front-page') }}">
                    <i class="bi bi-globe text-slate-500"></i>
                    <span>Portal Frontpage</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Bottom User Profile Card -->
    <div class="sidebar-user-footer p-3 border-top bg-slate-50">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2.5 overflow-hidden me-2">
                <div class="user-avatar-badge flex-shrink-0" style="background-color: {{ (auth()->user()?->role_id == 1) ? '#7c3aed' : ((auth()->user()?->role_id == 2) ? '#0284c7' : '#10b981') }}; width: 34px; height: 34px; font-size: 0.85rem;">
                    {{ strtoupper(substr(auth()->user()?->name ?? (auth()->user()?->username ?? 'U'), 0, 1)) }}
                </div>
                <div class="d-flex flex-column lh-sm overflow-hidden">
                    <span class="fw-bold text-dark text-truncate small" style="font-size: 0.82rem;">{{ auth()->user()?->name ?? auth()->user()?->username }}</span>
                    <span class="text-muted text-truncate" style="font-size: 0.72rem;">{{ auth()->user()?->email }}</span>
                </div>
            </div>

            <a href="{{ route('logout.perform') }}" class="btn btn-light btn-sm rounded-circle p-2 text-rose-600 hover:bg-rose-50 border border-slate-200 shadow-sm flex-shrink-0" title="Sign Out">
                <i class="bi bi-box-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</aside>
