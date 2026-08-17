@extends('layouts.app-master')

@section('content')
<div class="container-xl py-4">
    <!-- Hero Banner -->
    <div class="hero-banner rounded-3 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #002855 0%, #004080 100%);">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 bg-white bg-opacity-10 px-3 py-1.5 rounded-pill small d-inline-flex border border-white border-opacity-20 text-white-50">
                <li class="breadcrumb-item"><a href="{{ route('front-page') }}" class="text-white text-decoration-none"><i class="bi bi-house-door me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ auth()->user()?->role_id == 1 ? route('dashboard.index') : route('home') }}" class="text-white text-decoration-none">{{ auth()->user()?->role_id == 1 ? 'Admin Console' : 'Employer Portal' }}</a></li>
                <li class="breadcrumb-item active text-white fw-semibold" aria-current="page">Job Vacancies</li>
            </ol>
        </nav>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-danger bg-opacity-75 mb-2 px-3 py-1 text-uppercase tracking-wider small">Recruitment Management</span>
                <h1 class="fw-bold display-6 mb-1 text-white">Job Vacancies & Postings</h1>
                <p class="text-white-50 small mb-0">Manage active corporate job postings, applicant requirements, and publishing status.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button type="button" onclick="createPDF()" class="btn btn-light fw-semibold text-dark btn-sm px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-printer"></i> Export PDF
                </button>
                <a href="{{ route('vacancy.create') }}" class="btn btn-danger fw-semibold btn-sm px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Post New Vacancy
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>
            <div class="small fw-medium">{{ $message }}</div>
        </div>
    @endif

    @if (session()->has('msg'))
        <div class="alert alert-info d-flex align-items-center gap-2 shadow-sm mb-4" role="alert">
            <i class="bi bi-info-circle-fill flex-shrink-0"></i>
            <div class="small fw-medium">{{ session('msg') }}</div>
        </div>
    @endif

    <!-- Vacancies Card Container -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pb-3 mb-3 border-bottom">
            <div>
                <h2 class="h5 fw-bold text-dark mb-0">Active Job Postings</h2>
                <p class="text-muted small mb-0 mt-1">Total of {{ $vacancies->total() }} vacancies listed in the system.</p>
            </div>
            <div class="input-group input-group-sm" style="max-width: 280px;">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="search" id="vacancySearchInput" onkeyup="filterVacancyTable()" class="form-control bg-light border-start-0" placeholder="Search title or location...">
            </div>
        </div>

        @if($vacancies->count() > 0)
            <div class="table-responsive mb-3">
                <table class="table table-hover align-middle border" id="vacancyTable">
                    <thead class="table-light text-uppercase fs-7 fw-bold text-secondary">
                        <tr>
                            <th class="py-3 px-3">#</th>
                            <th class="py-3 px-3">Job Title</th>
                            <th class="py-3 px-3">Company Name</th>
                            <th class="py-3 px-3">Location</th>
                            <th class="py-3 px-3">Date Posted</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach ($vacancies as $key => $vacancy)
                            <tr>
                                <td class="fw-bold text-secondary small px-3">{{ ++$i }}</td>
                                <td class="px-3">
                                    <div class="fw-bold text-dark">{{ $vacancy->title }}</div>
                                    <div class="text-muted small">Salary: {{ $vacancy->salary ?: 'Competitive' }}</div>
                                </td>
                                <td class="fw-semibold text-secondary small px-3">
                                    {{ $vacancy->company_name ?? $vacancy->created_by ?? 'N/A' }}
                                </td>
                                <td class="text-secondary small px-3">
                                    <i class="bi bi-geo-alt text-muted me-1"></i>{{ $vacancy->location }}
                                </td>
                                <td class="text-muted small px-3">
                                    {{ $vacancy->created_at ? \Carbon\Carbon::parse($vacancy->created_at)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-3">
                                    @if($vacancy->status == '1' || $vacancy->status == 1)
                                        <a href="{{ url('/status-update', $vacancy->id) }}" class="badge bg-success bg-opacity-10 text-success text-decoration-none px-3 py-1.5 fw-semibold border border-success border-opacity-25" title="Click to Deactivate">
                                            <i class="bi bi-toggle-on me-1"></i> Active
                                        </a>
                                    @else
                                        <a href="{{ url('/status-update', $vacancy->id) }}" class="badge bg-secondary bg-opacity-10 text-secondary text-decoration-none px-3 py-1.5 fw-semibold border" title="Click to Activate">
                                            <i class="bi bi-toggle-off text-danger me-1"></i> Inactive
                                        </a>
                                    @endif
                                </td>
                                <td class="text-end px-3">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        <a href="{{ route('vacancy.show', $vacancy->id) }}" class="btn btn-outline-secondary px-2" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('vacancy.edit', $vacancy->id) }}" class="btn btn-outline-secondary px-2" title="Edit Vacancy">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-primary px-2 aBestApplicant" job-id="{{ $vacancy->id }}" title="View Best Applicants">
                                            <i class="bi bi-award"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger px-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $vacancy->id }}" title="Delete Vacancy">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Bootstrap Delete Modals -->
            @foreach ($vacancies as $vacancy)
                <div class="modal fade" id="deleteModal{{ $vacancy->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content text-center p-3 rounded-4 shadow">
                            <div class="modal-body">
                                <div class="text-danger mb-2">
                                    <i class="bi bi-exclamation-triangle fs-1"></i>
                                </div>
                                <h5 class="fw-bold mb-1">Delete Vacancy?</h5>
                                <p class="text-muted small mb-3">Are you sure you want to delete <strong>{{ $vacancy->title }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('vacancy.destroy', $vacancy->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-3 rounded-pill">Confirm Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-end mt-3">
                {!! $vacancies->links() !!}
            </div>
        @else
            <div class="text-center py-5 px-3 bg-light rounded-4 border border-dashed">
                <div class="text-muted mb-2">
                    <i class="bi bi-briefcase fs-1"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">No Vacancies Found</h5>
                <p class="text-muted small mb-3">You haven't posted any job vacancies yet.</p>
                <a href="{{ route('vacancy.create') }}" class="btn btn-dark btn-sm px-4 fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Post First Vacancy
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Bootstrap Best Applicant Ranking Modal -->
<div class="modal fade" id="mdlBestApplicant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-dark text-white px-4 py-3">
                <h5 class="modal-title fs-6 fw-bold d-flex align-items-center gap-2 mb-0">
                    <i class="bi bi-award text-warning"></i> Best Matching Applicants
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="table-responsive bg-white rounded-3 border">
                    <table class="table table-hover mb-0 tblBestApplicants">
                        <thead class="table-light fs-7 text-uppercase text-secondary">
                            <tr>
                                <th class="py-2.5 px-3" style="width: 100px;">Rank</th>
                                <th class="py-2.5 px-3">Applicant Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted small">Loading candidates...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-white border-top px-4 py-3">
                <button type="button" class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

