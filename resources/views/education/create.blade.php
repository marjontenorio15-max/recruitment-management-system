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
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>Academic Record</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Add Educational Background</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Record of degree, school, and graduation year.</p>
                </div>
                <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" href="{{ route('educational_background.index') }}">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('educational_background.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="applicant_id" value="{{ auth()->id() }}">

                <div class="row g-3">
                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">School / University Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="school_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="e.g. University of the Philippines" required>
                    </div>

                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">School Location <span class="text-rose-500">*</span></label>
                        <input type="text" name="school_location" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="City, Province" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Degree Attained <span class="text-rose-500">*</span></label>
                        <select name="degree" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" required>
                            <option value="Elementary Diploma">Elementary Diploma</option>
                            <option value="High School Diploma">High School Diploma</option>
                            <option value="Associate of Applied Science (AAS)">Associate of Applied Science (AAS)</option>
                            <option value="Associate of Arts (AA)">Associate of Arts (AA)</option>
                            <option value="Associate of Science (AS)">Associate of Science (AS)</option>
                            <option value="Bachelor of Applied Science (BAS)">Bachelor of Applied Science (BAS)</option>
                            <option value="Bachelor of Architecture (B.Arch.)">Bachelor of Architecture (B.Arch.)</option>
                            <option value="Bachelor of Science (BS)">Bachelor of Science (BS)</option>
                            <option value="Bachelor of Business Administration (BBA)">Bachelor of Business Administration (BBA)</option>
                            <option value="Bachelor of Fine Arts (BFA)">Bachelor of Fine Arts (BFA)</option>
                            <option value="Master's Degree">Master's Degree</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Field of Study / Major <span class="text-rose-500">*</span></label>
                        <input type="text" name="field_of_study" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="e.g. Computer Science" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Month Graduated</label>
                        <input type="text" name="month_graduate" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="e.g. March" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Year Graduated</label>
                        <input type="number" name="year_graduate" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="e.g. 2022" required>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    <a href="{{ route('educational_background.index') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Save Education
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
