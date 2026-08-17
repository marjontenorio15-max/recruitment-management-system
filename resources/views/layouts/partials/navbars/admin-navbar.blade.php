<!-- Admin Dedicated Corporate Navbar (Role 1) -->
<header class="navbar navbar-expand-lg navbar-light rms-navbar sticky-top bg-white border-bottom shadow-sm">
    <div class="container-fluid px-lg-4">

        <!-- Brand / Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-1" href="{{ route('dashboard.index') }}">
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
                    style="font-size: 0.65rem; color: #7c3aed !important; letter-spacing: 0.05em;">Admin Console</span>
            </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & Admin Actions -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            @php
                $navItems = [
                    [
                        'label' => 'Dashboard',
                        'route' => 'dashboard.index',
                        'active' => 'dashboard.index',
                        'icon' => 'bi-speedometer2 text-purple-600',
                    ],
                    [
                        'label' => 'Vacancies',
                        'route' => 'vacancy.index',
                        'active' => 'vacancy.*',
                        'icon' => 'bi-briefcase',
                    ],
                    [
                        'label' => 'Companies',
                        'route' => 'company.index',
                        'active' => 'company.*',
                        'icon' => 'bi-building',
                    ],
                    ['label' => 'Users', 'route' => 'users.index', 'active' => 'users.index', 'icon' => 'bi-people'],
                    [
                        'label' => 'Applicants',
                        'route' => 'apply.index',
                        'active' => 'apply.index',
                        'icon' => 'bi-person-lines-fill',
                    ],
                    [
                        'label' => 'Reports',
                        'route' => 'reports.index',
                        'active' => 'reports.index',
                        'icon' => 'bi-file-earmark-bar-graph',
                    ],
                ];
            @endphp
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                @foreach ($navItems as $item)
                    <li class="nav-item">
                        <a class="nav-link rms-nav-link {{ request()->routeIs($item['active']) ? 'active' : '' }}"
                            href="{{ route($item['route']) }}">
                            <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Admin Profile Dropdown -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                <div class="dropdown">
                    <button
                        class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle shadow-sm"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-avatar-badge" style="background-color: #7c3aed;">
                            {{ strtoupper(substr(auth()->user()?->name ?? (auth()->user()?->username ?? 'A'), 0, 1)) }}
                        </span>
                        <span
                            class="fw-semibold text-dark small me-1">{{ auth()->user()?->name ?? (auth()->user()?->username ?? 'Administrator') }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 p-0 overflow-hidden"
                        style="min-width: 230px;">
                        <li class="px-3 py-2.5 bg-light border-bottom">
                            <span class="d-block text-muted text-uppercase fw-bold" style="font-size: 0.65rem;">System
                                Administrator</span>
                            <span
                                class="fw-bold text-dark small d-block text-truncate">{{ auth()->user()?->name ?? (auth()->user()?->username ?? 'Administrator') }}</span>
                            <div class="text-muted extra-small text-truncate">{{ auth()->user()?->email }}</div>
                            <span class="badge bg-purple-100 text-purple-700 border border-purple-200 rounded-pill mt-1"
                                style="font-size: 0.65rem;">
                                Level 1 Root Access
                            </span>
                        </li>
                        <li class="p-1">
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
