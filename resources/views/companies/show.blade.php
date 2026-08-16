@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-4xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-white text-primary font-extrabold text-2xl d-flex align-items-center justify-content-center shadow-md">
                        {{ strtoupper(substr($company->company_name ?? 'C', 0, 1)) }}
                    </div>
                    <div>
                        <span class="badge bg-white/20 text-white rounded-pill text-[0.65rem] font-bold uppercase tracking-wider mb-1">Company Profile</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-0">{{ $company->company_name }}</h2>
                    </div>
                </div>
                <div class="d-flex gap-2 self-start sm:self-auto">
                    <a class="btn btn-light rounded-pill px-3.5 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5" href="{{ route('company.edit', $company->id) }}">
                        <i class="bi bi-pencil"></i>
                        <span>Edit</span>
                    </a>
                    <a class="btn btn-outline-light rounded-pill px-3.5 py-2 font-semibold text-xs d-inline-flex align-items-center gap-1.5" href="{{ route('company.index') }}">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Details Body --}}
        <div class="p-4 p-md-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Company Name</span>
                    <div class="font-bold text-slate-900 text-base">{{ $company->company_name }}</div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Contact Phone</span>
                    <div class="font-bold text-slate-900 text-base flex items-center gap-1.5">
                        <i class="bi bi-telephone text-primary"></i>
                        <span>{{ $company->contact_no ?: 'N/A' }}</span>
                    </div>
                </div>

                <div class="col-span-1 sm:col-span-2 p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Office Location / Address</span>
                    <div class="font-bold text-slate-900 text-base flex items-center gap-1.5">
                        <i class="bi bi-geo-alt text-rose-500"></i>
                        <span>{{ $company->address ?: 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
