<!-- Authenticated Dashboard Top Navigation Bar -->
<header
    class="rms-dashboard-header sticky-top bg-white border-bottom shadow-sm px-3 px-lg-4 py-2.5 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2.5">
        <!-- Sidebar Toggle Button (Mobile & Desktop) -->
        <button type="button"
            class="btn btn-light border rounded-xl p-2 d-flex align-items-center justify-content-center shadow-sm"
            id="toggleSidebarBtn" aria-label="Toggle Sidebar">
            <i class="bi bi-list fs-5 text-slate-700"></i>
        </button>

        <!-- Current Dashboard Context Breadcrumb -->
        <div class="d-none d-sm-flex align-items-center gap-2 text-muted small" style="font-size: 0.82rem;">
            <a href="{{ route('front-page') }}" class="text-decoration-none text-muted hover:text-dark">
                <i class="bi bi-house-door"></i>
            </a>
            <span class="opacity-50">/</span>
            <span class="fw-semibold text-slate-800">
                @if (auth()->user()?->role_id == 1)
                    Admin Workspace
                @elseif(auth()->user()?->role_id == 2)
                    Employer Workspace
                @else
                    Candidate Portal
                @endif
            </span>
        </div>
    </div>

    <!-- Header Actions & User Profile Dropdown -->
    <div class="d-flex align-items-center gap-2.5">
        @if (auth()->user()?->role_id == 2)
            <a href="{{ route('vacancy.create') }}"
                class="btn btn-sm btn-dark rounded-pill px-3 py-1.5 font-semibold text-xs d-none d-md-inline-flex align-items-center gap-1.5 shadow-sm">
                <i class="bi bi-plus-circle"></i>
                <span>Post Vacancy</span>
            </a>
        @elseif(auth()->user()?->role_id == 3)
            <a href="{{ route('view-jobs') }}"
                class="btn btn-sm btn-dark rounded-pill px-3 py-1.5 font-semibold text-xs d-none d-md-inline-flex align-items-center gap-1.5 shadow-sm">
                <i class="bi bi-search"></i>
                <span>Browse Vacancies</span>
            </a>
        @endif

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button
                class="btn btn-light border rounded-pill px-2.5 py-1 d-flex align-items-center gap-2 dropdown-toggle shadow-sm"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-avatar-badge"
                    style="background-color: {{ auth()->user()?->role_id == 1 ? '#7c3aed' : (auth()->user()?->role_id == 2 ? '#0284c7' : '#10b981') }}; width: 26px; height: 26px; font-size: 0.75rem;">
                    {{ strtoupper(substr(auth()->user()?->name ?? (auth()->user()?->username ?? 'U'), 0, 1)) }}
                </span>
                <span
                    class="fw-semibold text-dark small me-1 d-none d-sm-inline">{{ auth()->user()?->name ?? (auth()->user()?->username ?? 'User') }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 p-0 overflow-hidden"
                style="min-width: 230px;">
                <li class="px-3 py-2.5 bg-light border-bottom">
                    <span class="d-block text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">
                        @if (auth()->user()?->role_id == 1)
                            System Administrator
                        @elseif(auth()->user()?->role_id == 2)
                            Corporate Employer
                        @else
                            Candidate Account
                        @endif
                    </span>
                    <span
                        class="fw-bold text-dark small d-block text-truncate">{{ auth()->user()?->name ?? auth()->user()?->username }}</span>
                    <div class="text-muted extra-small text-truncate">{{ auth()->user()?->email }}</div>
                </li>
                <li class="p-1">
                    @if (auth()->user()?->role_id == 1)
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('dashboard.index') }}">
                            <i class="bi bi-speedometer2 text-purple-600"></i> Admin Console
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('users.index') }}">
                            <i class="bi bi-people text-secondary"></i> Manage Users
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('reports.index') }}">
                            <i class="bi bi-file-earmark-bar-graph text-primary"></i> System Reports
                        </a>
                    @elseif(auth()->user()?->role_id == 2)
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('employer-profile') }}">
                            <i class="bi bi-building-gear text-primary"></i> Company Profile
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('vacancy.index') }}">
                            <i class="bi bi-briefcase text-secondary"></i> Manage Vacancies
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('reports.index') }}">
                            <i class="bi bi-file-earmark-bar-graph text-info"></i> Analytics
                        </a>
                    @else
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('account-profile') }}">
                            <i class="bi bi-person-circle text-primary"></i> Profile & Portfolio
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('applicant-dashboard') }}">
                            <i class="bi bi-journal-check text-success"></i> Applied Jobs Tracker
                        </a>
                        <a class="dropdown-item rounded-2 py-2 d-flex align-items-center gap-2 small"
                            href="{{ route('view-jobs') }}">
                            <i class="bi bi-search text-info"></i> Browse Vacancies
                        </a>
                    @endif
                    <hr class="dropdown-divider my-1">
                    <a class="dropdown-item text-danger rounded-2 py-2 d-flex align-items-center gap-2 fw-medium small"
                        href="{{ route('logout.perform') }}">
                        <i class="bi bi-box-arrow-right fs-6"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
