<div class="position-relative overflow-hidden p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0284c7 100%); border-radius: 1rem 1rem 0 0;">
    <!-- Decorative background glow -->
    <div class="position-absolute top-0 end-0 p-5 opacity-10 pointer-events-none" style="transform: translate(30%, -30%);">
        <svg width="260" height="260" viewBox="0 0 200 200" fill="currentColor">
            <circle cx="100" cy="100" r="100" />
        </svg>
    </div>

    <!-- Dynamic Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mb-3 position-relative z-1">
        <ol class="breadcrumb mb-0 align-items-center bg-white bg-opacity-10 px-3 py-1.5 rounded-pill border border-white border-opacity-15 small" style="width: fit-content; font-size: 0.78rem;">
            <li class="breadcrumb-item">
                <a href="{{ route('front-page') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                    <i class="bi bi-house-door me-1"></i>Home
                </a>
            </li>
            @if(auth()->user()?->role_id == 3)
                <li class="breadcrumb-item">
                    <a href="{{ route('applicant-dashboard') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                        Candidate Portal
                    </a>
                </li>
                <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                    @if(request()->routeIs('applicant-dashboard'))
                        Applied Jobs
                    @elseif(request()->routeIs('account-profile'))
                        Profile & Portfolio
                    @elseif(request()->routeIs('edit_applicant_account') || request()->routeIs('edit-profile'))
                        Edit Profile
                    @elseif(request()->routeIs('applicant-application-form') || request()->routeIs('application-form'))
                        Application Form
                    @elseif(request()->routeIs('view-jobs'))
                        Browse Vacancies
                    @else
                        {{ ucfirst(str_replace(['.', '-', '_'], ' ', request()->route()?->getName() ?? 'Dashboard')) }}
                    @endif
                </li>
            @elseif(auth()->user()?->role_id == 2)
                <li class="breadcrumb-item">
                    <a href="{{ route('account-profile') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                        Employer Portal
                    </a>
                </li>
                <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                    Company Profile
                </li>
            @else
                <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                    Admin Console
                </li>
            @endif
        </ol>
    </nav>

    <div class="position-relative z-1 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-2.5 py-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-20 text-white-50 small mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
                <span class="d-inline-block rounded-circle bg-emerald-400" style="width: 6px; height: 6px;"></span>
                @if(auth()->user()?->role_id == 1)
                    <span>Root Console</span>
                @elseif(auth()->user()?->role_id == 2)
                    <span>Corporate Recruiter</span>
                @else
                    <span>Verified Candidate</span>
                @endif
            </div>

            <h1 class="h3 fw-bold text-white mb-1" style="letter-spacing: -0.02em;">
                @if(auth()->user()?->role_id == 1)
                    System Administrator Profile
                @elseif(auth()->user()?->role_id == 2)
                    Employer Corporate Profile
                @else
                    Candidate Profile & Portfolio
                @endif
            </h1>
            <p class="text-white-50 small mb-0">
                Manage your personal credentials, career records, resume documents, and job recommendations.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 text-white px-3 py-2 rounded-pill small fw-semibold shadow-sm">
                <i class="bi bi-person-badge me-1"></i> {{ auth()->user()?->name ?? (auth()->user()?->username ?? 'User') }}
            </span>
            <a href="{{ route('logout.perform') }}" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white rounded-pill px-3 py-2 small fw-semibold shadow-sm border-0 d-inline-flex align-items-center gap-1.5 transition-all">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</div>
