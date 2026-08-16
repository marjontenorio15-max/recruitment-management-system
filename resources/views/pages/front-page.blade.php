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
{{-- Custom Modern Styling --}}
<style>
    :root {
        --brand-navy: #002855;
        --brand-accent: #e31837;
        --card-bg: #ffffff;
        --soft-bg: #f8fafc;
    }

    .hero-portal {
        background: linear-gradient(135deg, #002855 0%, #001a38 100%);
        border-radius: 16px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .hero-portal::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(227, 24, 55, 0.15);
        filter: blur(80px);
        border-radius: 50%;
    }

    /* Modern Metric Cards */
    .metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -6px rgba(0, 40, 85, 0.12);
        border-color: #cbd5e1;
    }

    .metric-card .icon-wrapper {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }

    .metric-card .metric-val {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .metric-card .metric-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    /* Accent themes for cards */
    .metric-total .icon-wrapper { background: #e2e8f0; color: #1e293b; }
    .metric-pending .icon-wrapper { background: #fef3c7; color: #d97706; }
    .metric-interview .icon-wrapper { background: #e0f2fe; color: #0284c7; }
    .metric-hired .icon-wrapper { background: #dcfce7; color: #16a34a; }
    .metric-reject .icon-wrapper { background: #fee2e2; color: #dc2626; }

    .section-title {
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.02em;
    }
</style>

<div class="container py-4">

    {{-- Hero Section for Visitors & Applicants --}}
    <div class="hero-portal p-4 p-md-5 mb-4 shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-danger text-uppercase px-3 py-2 fw-bold mb-3" style="letter-spacing: 0.08em; font-size: 0.7rem;">
                    Career Portal
                </span>
                <h1 class="display-6 fw-bold mb-2">Find Your Next Opportunity</h1>
                <p class="text-white-50 fs-6 mb-0" style="max-width: 580px;">
                    Explore current openings, apply for roles, and track your active application status in real-time.
                </p>
            </div>
        </div>
    </div>

    {{-- Applicant Tracker Dashboard Widget --}}
    @auth
        @if(auth()->user()->role_id == 3)
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h4 class="section-title mb-1">Application Tracker</h4>
                        <p class="text-muted small mb-0">Overview of your submitted application progress</p>
                    </div>
                    <a href="{{ route('applicant-dashboard') }}" class="btn btn-sm btn-outline-dark fw-semibold rounded-pill px-3">
                        View Full Dashboard <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-5">

                    <!-- Total Applied -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-total h-100">
                                <div class="icon-wrapper">
                                    <i class="bi bi-folder-check"></i>
                                </div>
                                <div class="metric-val text-dark">{{ $counts->total ?? 0 }}</div>
                                <div class="metric-label">Total Applied</div>
                            </div>
                        </a>
                    </div>

                    <!-- Under Review -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-pending h-100">
                                <div class="icon-wrapper">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div class="metric-val text-warning">{{ $counts->pending ?? 0 }}</div>
                                <div class="metric-label">Under Review</div>
                            </div>
                        </a>
                    </div>

                    <!-- Interviews -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-interview h-100">
                                <div class="icon-wrapper">
                                    <i class="bi bi-calendar2-event"></i>
                                </div>
                                <div class="metric-val text-info">{{ $counts->interview ?? 0 }}</div>
                                <div class="metric-label">Interviews</div>
                            </div>
                        </a>
                    </div>

                    <!-- Hired -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-hired h-100">
                                <div class="icon-wrapper">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="metric-val text-success">{{ $counts->hired ?? 0 }}</div>
                                <div class="metric-label">Hired</div>
                            </div>
                        </a>
                    </div>

                    <!-- Unsuccessful -->
                    <div class="col-12 col-md-4 col-lg">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-reject h-100">
                                <div class="icon-wrapper">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="metric-val text-danger">{{ $counts->reject ?? 0 }}</div>
                                <div class="metric-label">Unsuccessful</div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        @endif
    @endauth

    {{-- Job Openings Section --}}
    <div class="bg-white border rounded-3 p-4 shadow-sm">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <div>
                <h4 class="section-title mb-1">Open Positions</h4>
                <p class="text-muted small mb-0">Browse through available career opportunities</p>
            </div>
            <span class="badge bg-light text-dark border px-3 py-2 fw-semibold">
                <i class="bi bi-briefcase me-1 text-primary"></i> Live Postings
            </span>
        </div>

        {{-- Public Job List Blade Include --}}
        @include('jobs.public-list')
    </div>

</div>
@endsection
