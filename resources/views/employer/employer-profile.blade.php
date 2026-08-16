@extends('layouts.app-master')

@section('content')
<div class="container py-4">
    @php
        $company = \App\Models\Company::where('company_id', auth()->id())->first();
        $vacanciesCount = \App\Models\Vacancy::where('company_id', auth()->id())->count();
        $activeVacancies = \App\Models\Vacancy::where('company_id', auth()->id())->where('status', 1)->count();
        $applicationsCount = \Illuminate\Support\Facades\DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', '=', 'tbl_job_list.id')
            ->where('tbl_job_list.company_id', auth()->id())
            ->count();
        $recentVacancies = \App\Models\Vacancy::where('company_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    @endphp

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Profile Banner Header --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
        <div class="p-4 p-md-5 bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="row align-items-center position-relative z-1">
                <div class="col-auto">
                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow-lg" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 700;">
                        {{ strtoupper(substr($company->company_name ?? auth()->user()->name ?? 'E', 0, 1)) }}
                    </div>
                </div>
                <div class="col">
                    <h3 class="fw-bold mb-1 text-white">{{ $company->company_name ?? 'Company Profile' }}</h3>
                    <p class="mb-0 text-white-50 small">
                        <i class="bi bi-person-badge me-1"></i> {{ auth()->user()->name }}
                        <span class="mx-2">•</span>
                        <i class="bi bi-envelope me-1"></i> {{ auth()->user()->email }}
                    </p>
                </div>
                <div class="col-auto mt-3 mt-md-0">
                    <a href="{{ route('vacancy.create') }}" class="btn btn-light rounded-pill px-3 shadow-sm fw-semibold">
                        <i class="bi bi-plus-circle me-1 text-primary"></i> Post New Job
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Overview Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-primary-subtle text-primary rounded-3">
                        <i class="bi bi-briefcase fs-3"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-medium d-block">Total Job Openings</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $vacanciesCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-success-subtle text-success rounded-3">
                        <i class="bi bi-check2-circle fs-3"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-medium d-block">Active Vacancies</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $activeVacancies }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-info-subtle text-info rounded-3">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-medium d-block">Total Applicants</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ $applicationsCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Company Details Form --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold text-dark mb-1"><i class="bi bi-building me-2 text-primary"></i>Company Information</h5>
                    <p class="text-muted extra-small">Update your organization's contact info and corporate address.</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('employer-profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Company / Organization Name</label>
                            <input type="text" name="company_name" class="form-control rounded-3" value="{{ old('company_name', $company->company_name ?? '') }}" placeholder="e.g. Acme Corporation" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Contact Person / Representative</label>
                            <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', auth()->user()->name) }}" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Contact Number</label>
                            <input type="number" name="contact_no" class="form-control rounded-3" value="{{ old('contact_no', $company->contact_no ?? '') }}" placeholder="e.g. 09123456789" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-dark">Corporate Address / Office Location</label>
                            <textarea name="address" class="form-control rounded-3" rows="3" placeholder="Street, City, State/Province" required>{{ old('address', $company->address ?? '') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">
                                <i class="bi bi-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Recent Vacancies --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 bg-white h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-dark mb-1"><i class="bi bi-list-task me-2 text-primary"></i>Recent Job Postings</h5>
                        <p class="text-muted extra-small mb-0">Overview of your latest vacancies.</p>
                    </div>
                    <a href="{{ route('vacancy.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 extra-small">View All</a>
                </div>
                <div class="card-body p-4">
                    @if($recentVacancies->count() > 0)
                        <div class="list-group list-group-flush gap-2">
                            @foreach($recentVacancies as $v)
                                <div class="list-group-item rounded-3 border p-3 bg-light d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">{{ $v->title }}</h6>
                                        <span class="text-muted extra-small">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $v->location }}
                                            <span class="mx-1">•</span>
                                            <i class="bi bi-cash me-1"></i>₱{{ number_format((float)$v->salary) }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($v->status == 1)
                                            <span class="badge bg-success-subtle text-success border rounded-pill px-2.5 py-1 extra-small">Active</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2.5 py-1 extra-small">Inactive</span>
                                        @endif
                                        <a href="{{ route('vacancy.show', $v->id) }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-briefcase text-muted fs-1 mb-2 opacity-50"></i>
                            <h6 class="fw-bold text-dark">No vacancies posted yet</h6>
                            <p class="text-muted extra-small mb-3">Create your first job posting to start receiving applications.</p>
                            <a href="{{ route('vacancy.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                <i class="bi bi-plus-circle me-1"></i> Create Vacancy
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
