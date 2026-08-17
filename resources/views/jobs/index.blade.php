@php use App\Models\Vacancy; use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .job-portal-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0284c7 100%);
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">
    <!-- Dedicated Job Search Header Banner -->
    <div class="job-portal-header rounded-3xl p-4 p-md-5 text-white mb-4 shadow-sm position-relative overflow-hidden">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-3 position-relative z-1">
            <ol class="breadcrumb mb-0 align-items-center bg-white bg-opacity-10 px-3 py-1.5 rounded-pill border border-white border-opacity-15 small" style="width: fit-content; font-size: 0.78rem;">
                <li class="breadcrumb-item">
                    <a href="{{ route('front-page') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>
                @auth
                    @if(auth()->user()->role_id == 3)
                        <li class="breadcrumb-item">
                            <a href="{{ route('applicant-dashboard') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                                Candidate Portal
                            </a>
                        </li>
                    @elseif(auth()->user()->role_id == 2)
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                                Employer Portal
                            </a>
                        </li>
                    @endif
                @endauth
                <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                    Browse Vacancies
                </li>
            </ol>
        </nav>

        <div class="position-relative z-1 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="max-w-2xl">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-20 text-white-50 text-xs uppercase font-bold tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Job Openings Directory</span>
                </div>
                <h1 class="h2 fw-bold text-white mb-2" style="letter-spacing: -0.02em;">Find Your Dream Job Today</h1>
                <p class="text-white-50 small mb-0 fs-6">
                    Explore verified job postings, compare compensation packages, and apply directly to leading companies across the region.
                </p>
            </div>

            @auth
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 text-white px-3 py-2 rounded-pill small fw-semibold shadow-sm">
                        <i class="bi bi-person-badge me-1"></i> {{ auth()->user()->name ?? (auth()->user()->username ?? 'User') }}
                    </span>
                    <a href="{{ route('logout.perform') }}" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white rounded-pill px-3 py-2 small fw-semibold shadow-sm border-0 d-inline-flex align-items-center gap-1.5 transition-all">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Interactive Job Search & Application Workspace -->
    @include('jobs.public-list')
</div>
@endsection

