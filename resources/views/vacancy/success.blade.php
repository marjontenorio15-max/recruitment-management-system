@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-8 max-w-2xl mx-auto text-center">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-6 p-md-8">

        {{-- Success Animation / Icon --}}
        <div class="w-20 h-20 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-4xl mb-4 border border-emerald-100 shadow-sm">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold uppercase tracking-wider mx-auto mb-3">
            Application Submitted
        </span>

        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
            Application Received, {{ auth()->user()->name ?? auth()->user()->username }}!
        </h2>

        <p class="text-slate-500 text-sm max-w-md mx-auto leading-relaxed mb-6">
            Your application has been delivered to the employer. You can track your screening status and interview invitations directly in your candidate dashboard.
        </p>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-left mb-6 max-w-md mx-auto">
            <div class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                <i class="bi bi-info-circle text-primary"></i>
                <span>What Happens Next?</span>
            </div>
            <ul class="text-xs text-slate-600 space-y-1.5 mb-0 list-disc list-inside">
                <li>Employer reviews your submitted qualifications and resume.</li>
                <li>Status will transition to <strong class="text-slate-800">For Interview</strong> or <strong class="text-slate-800">Hired</strong> upon evaluation.</li>
                <li>You can check real-time updates under your Applied Jobs tab.</li>
            </ul>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('applicant-dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5">
                <i class="bi bi-journal-check"></i>
                <span>View Applied Jobs</span>
            </a>
            <a href="{{ route('view-jobs') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 font-semibold text-xs d-inline-flex align-items-center gap-1.5">
                <i class="bi bi-search"></i>
                <span>Browse More Openings</span>
            </a>
        </div>

    </div>

</div>
@endsection

