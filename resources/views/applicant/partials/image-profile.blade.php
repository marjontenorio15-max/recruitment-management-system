@php
    $image = DB::table('image')->where('image.applicant_id', auth()->user()->id)->get();
    $applicants = DB::table('applicants')->where('applicants.applicant_id', auth()->user()->id)->get();
    $data = DB::table('apply')
        ->where('apply.applicant_id', auth()->user()->id)
        ->simplePaginate(100);
@endphp

<div class="card border border-slate-200/90 shadow-sm rounded-3xl overflow-hidden bg-white mb-4">
    <!-- Profile Photo / Avatar -->
    <div class="p-4 text-center bg-gradient-to-b from-slate-50 to-white border-b border-slate-100">
        <div class="position-relative d-inline-block mx-auto mb-3">
            @if($image->count() > 0)
                @foreach($image as $images)
                    <img class="rounded-3xl shadow-sm border border-slate-200 object-cover mx-auto"
                         src="{{ asset("imageUpload/$images->file_path") }}"
                         alt="{{ $images->file_path }}"
                         style="width: 100%; max-width: 200px; height: 200px; object-fit: cover;">
                @endforeach
            @else
                <div class="rounded-3xl bg-slate-900 text-white d-flex align-items-center justify-content-center mx-auto shadow-sm"
                     style="width: 140px; height: 140px; font-size: 3rem; font-weight: 700;">
                    {{ strtoupper(substr(auth()->user()?->name ?? (auth()->user()?->username ?? 'U'), 0, 1)) }}
                </div>
            @endif
        </div>

        @if(auth()->user()->role_id == 3)
            @forelse($applicants as $applicant)
                <h5 class="fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">
                    {{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->last_name }}
                </h5>
            @empty
                <h5 class="fw-bold text-dark mb-1">
                    {{ auth()->user()?->name ?? auth()->user()?->username }}
                </h5>
            @endforelse
            <div class="text-muted small mb-2">{{ auth()->user()?->email }}</div>
            <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-pill px-3 py-1 font-semibold text-xs">
                <i class="bi bi-patch-check-fill me-1"></i> Jobseeker Account
            </span>
        @elseif(auth()->user()->role_id == 2)
            <h5 class="fw-bold text-dark mb-1">{{ auth()->user()?->name }}</h5>
            <div class="text-muted small mb-2">{{ auth()->user()?->email }}</div>
            <span class="badge bg-sky-50 text-sky-700 border border-sky-200 rounded-pill px-3 py-1 font-semibold text-xs">
                <i class="bi bi-building me-1"></i> Corporate Employer
            </span>
        @else
            <h5 class="fw-bold text-dark mb-1">{{ auth()->user()?->name ?? auth()->user()?->username }}</h5>
            <span class="badge bg-purple-50 text-purple-700 border border-purple-200 rounded-pill px-3 py-1 font-semibold text-xs">
                Administrator
            </span>
        @endif
    </div>

    <!-- Navigation Actions -->
    <div class="card-body p-3 p-md-4">
        <div class="d-flex flex-column gap-2">
            @if(auth()->user()->role_id == 3)
                <a href="{{ route('applicant-dashboard') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all {{ request()->routeIs('applicant-dashboard') ? 'bg-slate-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-journal-check fs-6 {{ request()->routeIs('applicant-dashboard') ? 'text-white' : 'text-emerald-600' }}"></i>
                        <span>Applied Jobs</span>
                    </span>
                    <i class="bi bi-chevron-right small opacity-50"></i>
                </a>

                <a href="{{ route('account-profile') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all {{ request()->routeIs('account-profile') ? 'bg-slate-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-person-lines-fill fs-6 {{ request()->routeIs('account-profile') ? 'text-white' : 'text-sky-600' }}"></i>
                        <span>My Profile & Resume</span>
                    </span>
                    <i class="bi bi-chevron-right small opacity-50"></i>
                </a>

                <a href="{{ route('view-jobs') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all bg-slate-50 text-slate-700 hover:bg-slate-100">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-search fs-6 text-slate-500"></i>
                        <span>Browse Vacancies</span>
                    </span>
                    <i class="bi bi-chevron-right small opacity-50"></i>
                </a>

                <hr class="my-1 border-slate-200">

                <a href="{{ route('logout.perform') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200/70">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-box-arrow-right fs-6 text-rose-600"></i>
                        <span>Log Out</span>
                    </span>
                    <i class="bi bi-power small opacity-60"></i>
                </a>
            @elseif(auth()->user()->role_id == 2)
                <a href="{{ route('account-profile') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all {{ request()->routeIs('account-profile') ? 'bg-slate-900 text-white shadow-sm' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-building fs-6 text-sky-600"></i>
                        <span>Company Profile</span>
                    </span>
                    <i class="bi bi-chevron-right small opacity-50"></i>
                </a>

                <hr class="my-1 border-slate-200">

                <a href="{{ route('logout.perform') }}"
                   class="btn d-flex align-items-center justify-content-between p-2.5 rounded-2xl text-decoration-none fw-semibold small transition-all text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200/70">
                    <span class="d-flex align-items-center gap-2.5">
                        <i class="bi bi-box-arrow-right fs-6 text-rose-600"></i>
                        <span>Log Out</span>
                    </span>
                    <i class="bi bi-power small opacity-60"></i>
                </a>
            @endif
        </div>
    </div>
</div>

