@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-3xl mx-auto">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                        <i class="bi bi-person-check-fill"></i>
                        <span>Direct Application</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Submit Job Application</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Apply for position vacancy.</p>
                </div>
                <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" href="{{ route('apply.index') }}">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('apply.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="job_id" value="{{ $vacancy->id ?? '' }}">
                <input type="hidden" name="applicant_id" value="{{ auth()->id() }}">

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Applying As</span>
                    <div class="font-bold text-slate-900 text-sm">{{ auth()->user()->name }} ({{ auth()->user()->email }})</div>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    <a href="{{ route('apply.index') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-send-fill me-1"></i> Submit Application
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
