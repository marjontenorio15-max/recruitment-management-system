@php
    use Illuminate\Support\Facades\DB;

    // Fallback query if $counts isn't provided directly by the controller
    if (!isset($counts) && auth()->check() && auth()->user()->role_id == 3) {
        $counts = DB::table('apply')
            ->where('applicant_id', auth()->id())
            ->selectRaw("
                COUNT(*) as total,
                COUNT(CASE WHEN remarks = 'Pending' THEN 1 END) as pending,
                COUNT(CASE WHEN remarks = 'Hired' THEN 1 END) as hired,
                COUNT(CASE WHEN remarks = 'For Interview' THEN 1 END) as interview,
                COUNT(CASE WHEN remarks = 'Reject' THEN 1 END) as reject
            ")
            ->first();
    }
@endphp

@extends('layouts.app-master')

@section('content')
<div class="container py-4">

    {{-- Applicant Application Metrics --}}
    @auth
        @if(auth()->user()->role_id == 3)
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold mb-0">Application Tracker</h5>
                    <a href="{{ route('applicant-dashboard') }}" class="btn btn-sm btn-outline-primary">
                        View Dashboard <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-3">
                    <!-- Total Applied -->
                    <div class="col-6 col-md">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="card border shadow-sm text-center p-3 h-100">
                                <span class="fs-3 fw-bold text-dark">{{ $counts->total ?? 0 }}</span>
                                <span class="text-muted small fw-semibold">Total Applied</span>
                            </div>
                        </a>
                    </div>

                    <!-- Under Review -->
                    <div class="col-6 col-md">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="card border shadow-sm text-center p-3 h-100">
                                <span class="fs-3 fw-bold text-warning">{{ $counts->pending ?? 0 }}</span>
                                <span class="text-muted small fw-semibold">Under Review</span>
                            </div>
                        </a>
                    </div>

                    <!-- Interviews -->
                    <div class="col-6 col-md">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="card border shadow-sm text-center p-3 h-100">
                                <span class="fs-3 fw-bold text-info">{{ $counts->interview ?? 0 }}</span>
                                <span class="text-muted small fw-semibold">Interviews</span>
                            </div>
                        </a>
                    </div>

                    <!-- Hired -->
                    <div class="col-6 col-md">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="card border shadow-sm text-center p-3 h-100">
                                <span class="fs-3 fw-bold text-success">{{ $counts->hired ?? 0 }}</span>
                                <span class="text-muted small fw-semibold">Hired</span>
                            </div>
                        </a>
                    </div>

                    <!-- Unsuccessful -->
                    <div class="col-6 col-md">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="card border shadow-sm text-center p-3 h-100">
                                <span class="fs-3 fw-bold text-danger">{{ $counts->reject ?? 0 }}</span>
                                <span class="text-muted small fw-semibold">Unsuccessful</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4 text-muted">
        @endif
    @endauth

    {{-- Job Openings Section --}}
    <div class="row">
        <div class="col-12">
            <h4 class="fw-bold mb-3">Open Positions</h4>
            @include('jobs.public-list')
        </div>
    </div>

</div>
@endsection
