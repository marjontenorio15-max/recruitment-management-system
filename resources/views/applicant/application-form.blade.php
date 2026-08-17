@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-5xl mx-auto">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
        <!-- Header Banner -->
        <div class="position-relative overflow-hidden p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0284c7 100%);">
            <!-- Dynamic Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-3 position-relative z-1">
                <ol class="breadcrumb mb-0 align-items-center bg-white bg-opacity-10 px-3 py-1.5 rounded-pill border border-white border-opacity-15 small" style="width: fit-content; font-size: 0.78rem;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('front-page') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('applicant-dashboard') }}" class="text-white text-opacity-75 text-decoration-none hover:text-white transition-colors">
                            Candidate Portal
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                        Application Form
                    </li>
                </ol>
            </nav>

            <div class="position-relative z-1 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-inline-flex align-items-center gap-2 px-2.5 py-1 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-20 text-white-50 small mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
                        <span class="d-inline-block rounded-circle bg-emerald-400" style="width: 6px; height: 6px;"></span>
                        <span>Application Portal</span>
                    </div>
                    <h1 class="h3 fw-bold text-white mb-1" style="letter-spacing: -0.02em;">Applicant Profile Information</h1>
                    <p class="text-white-50 small mb-0">Complete your profile details, career background, and qualifications to apply for open positions.</p>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('logout.perform') }}" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white rounded-pill px-3 py-2 small fw-semibold shadow-sm border-0 d-inline-flex align-items-center gap-1.5 transition-all">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="p-4 p-md-5 bg-slate-50 border-top border-slate-100">
            @if (session()->has('message'))
                <div class="alert alert-success d-flex align-items-center gap-2 rounded-2xl p-3 mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span class="small">{{ session('message') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                @livewire('applicants')
            </div>
        </div>
    </div>
</div>
@endsection
