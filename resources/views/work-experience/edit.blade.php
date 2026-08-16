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
                        <i class="bi bi-briefcase-fill"></i>
                        <span>Career Record</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Edit Work Experience</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">{{ $job_experience->job_title }} at {{ $job_experience->company_name }}</p>
                </div>
                <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" href="{{ route('job-experience.index') }}">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('job-experience.update', $job_experience->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Job Title / Role <span class="text-rose-500">*</span></label>
                        <input type="text" name="job_title" value="{{ old('job_title', $job_experience->job_title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Company / Organization <span class="text-rose-500">*</span></label>
                        <input type="text" name="company_name" value="{{ old('company_name', $job_experience->company_name) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" required>
                    </div>

                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Work Experience / Duration <span class="text-rose-500">*</span></label>
                        <select name="period_employed" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" required>
                            @php $p = $job_experience->period_employed; @endphp
                            <option value="Less than 1 year" {{ $p == 'Less than 1 year' ? 'selected' : '' }}>Less than 1 year</option>
                            <option value="1 year" {{ $p == '1 year' ? 'selected' : '' }}>1 year</option>
                            <option value="2 years" {{ $p == '2 years' ? 'selected' : '' }}>2 years</option>
                            <option value="3 years" {{ $p == '3 years' ? 'selected' : '' }}>3 years</option>
                            <option value="4 years" {{ $p == '4 years' ? 'selected' : '' }}>4 years</option>
                            <option value="5 years" {{ $p == '5 years' ? 'selected' : '' }}>5 years</option>
                            <option value="6 years" {{ $p == '6 years' ? 'selected' : '' }}>6 years</option>
                            <option value="7 years" {{ $p == '7 years' ? 'selected' : '' }}>7 years</option>
                            <option value="8 years" {{ $p == '8 years' ? 'selected' : '' }}>8 years</option>
                            <option value="9 years" {{ $p == '9 years' ? 'selected' : '' }}>9 years</option>
                            <option value="10+ years" {{ $p == '10+ years' ? 'selected' : '' }}>10+ years</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Responsibilities & Key Achievements</label>
                        <textarea name="achievements" rows="5" class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none">{{ old('achievements', $job_experience->achievements) }}</textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    <a href="{{ route('job-experience.index') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Update Experience
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
