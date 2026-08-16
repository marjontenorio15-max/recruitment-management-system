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
{{-- Custom Modern SaaS Styling --}}
<style>
    :root {
        --brand-navy: #0f172a;
        --brand-navy-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --brand-accent: #e31837;
        --card-bg: #ffffff;
        --border-subtle: #e2e8f0;
    }

    .hero-portal {
        background: var(--brand-navy-gradient);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.3);
    }

    .hero-portal::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(227, 24, 55, 0.25) 0%, rgba(227, 24, 55, 0) 70%);
        filter: blur(40px);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-portal::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: 20%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(56, 189, 248, 0) 70%);
        filter: blur(50px);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Modern Metric Cards */
    .metric-card {
        background: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 14px;
        padding: 1.25rem;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px -8px rgba(15, 23, 42, 0.08);
        border-color: #cbd5e1;
    }

    .metric-card .icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        margin-bottom: 0.875rem;
        transition: transform 0.2s ease;
    }

    .metric-card:hover .icon-wrapper {
        transform: scale(1.05);
    }

    .metric-card .metric-val {
        font-size: 1.875rem;
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -0.03em;
        color: #0f172a;
    }

    .metric-card .metric-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.35rem;
    }

    /* Accent themes for cards */
    .metric-total .icon-wrapper { background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; }
    .metric-pending .icon-wrapper { background: #fffbebf5; color: #d97706; border: 1px solid #fef3c7; }
    .metric-interview .icon-wrapper { background: #f0f9ff; color: #0284c7; border: 1px solid #e0f2fe; }
    .metric-hired .icon-wrapper { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
    .metric-reject .icon-wrapper { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }

    .section-title {
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .glass-badge {
        background: rgba(227, 24, 55, 0.15);
        color: #ff4d6d;
        border: 1px solid rgba(227, 24, 55, 0.3);
        backdrop-filter: blur(4px);
    }

    .dashboard-panel {
        background: #ffffff;
        border: 1px solid var(--border-subtle);
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
    }
</style>

<div class="container py-4">

    {{-- Hero Section for Visitors & Applicants --}}
    <div class="hero-portal p-4 p-md-5 mb-4">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-lg-8">
                <span class="badge glass-badge text-uppercase px-3 py-2 fw-semibold mb-3 rounded-pill" style="letter-spacing: 0.08em; font-size: 0.68rem;">
                    <i class="bi bi-stars me-1"></i> Career Portal
                </span>
                <h1 class="display-6 fw-bold mb-2 text-white" style="letter-spacing: -0.025em;">Find Your Next Opportunity</h1>
                <p class="text-white-50 fs-6 mb-0 fw-normal" style="max-width: 580px; line-height: 1.6;">
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
                    <a href="{{ route('applicant-dashboard') }}" class="btn btn-sm btn-outline-dark fw-semibold rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-1">
                        <span>View Full Dashboard</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-5">

                    <!-- Total Applied -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-total h-100">
                                <div>
                                    <div class="icon-wrapper">
                                        <i class="bi bi-folder-check"></i>
                                    </div>
                                    <div class="metric-val">{{ $counts->total ?? 0 }}</div>
                                </div>
                                <div class="metric-label">Total Applied</div>
                            </div>
                        </a>
                    </div>

                    <!-- Under Review -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-pending h-100">
                                <div>
                                    <div class="icon-wrapper">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>
                                    <div class="metric-val text-warning">{{ $counts->pending ?? 0 }}</div>
                                </div>
                                <div class="metric-label">Under Review</div>
                            </div>
                        </a>
                    </div>

                    <!-- Interviews -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-interview h-100">
                                <div>
                                    <div class="icon-wrapper">
                                        <i class="bi bi-calendar2-event"></i>
                                    </div>
                                    <div class="metric-val text-info">{{ $counts->interview ?? 0 }}</div>
                                </div>
                                <div class="metric-label">Interviews</div>
                            </div>
                        </a>
                    </div>

                    <!-- Hired -->
                    <div class="col">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-hired h-100">
                                <div>
                                    <div class="icon-wrapper">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="metric-val text-success">{{ $counts->hired ?? 0 }}</div>
                                </div>
                                <div class="metric-label">Hired</div>
                            </div>
                        </a>
                    </div>

                    <!-- Unsuccessful -->
                    <div class="col-12 col-md-4 col-lg">
                        <a href="{{ route('applicant-dashboard') }}" class="text-decoration-none">
                            <div class="metric-card metric-reject h-100">
                                <div>
                                    <div class="icon-wrapper">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div class="metric-val text-danger">{{ $counts->reject ?? 0 }}</div>
                                </div>
                                <div class="metric-label">Unsuccessful</div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        @endif
    @endauth

    {{-- Job Openings Section --}}
    <div class="dashboard-panel p-4">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
            <div>
                <h4 class="section-title mb-1">Open Positions</h4>
                <p class="text-muted small mb-0">Browse through available career opportunities</p>
            </div>
            <span class="badge bg-slate-50 text-dark border px-3 py-2 fw-semibold rounded-pill d-inline-flex align-items-center gap-1">
                <i class="bi bi-record-fill text-success small"></i> Live Postings
            </span>
        </div>

        {{-- Public Job List Blade Include --}}
        @include('jobs.public-list')
    </div>

</div>
@endsection

