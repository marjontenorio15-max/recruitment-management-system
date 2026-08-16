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
                        <i class="bi bi-chat-left-quote-fill"></i>
                        <span>Recruitment Feedback</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Add Candidate Remarks</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Record remarks and evaluation notes for candidate applications.</p>
                </div>
                <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" href="{{ route('employer-applicant-table-record') }}">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('employer_remarks.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Applicant ID <span class="text-rose-500">*</span></label>
                        <input type="number" id="applicant_id" name="applicant_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="Applicant ID" required>
                    </div>

                    <div class="col-md-6">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status / Remarks <span class="text-rose-500">*</span></label>
                        <select name="remarks" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" required>
                            <option value="Pending">Pending</option>
                            <option value="For Interview">For Interview</option>
                            <option value="Hired">Hired</option>
                            <option value="Reject">Reject</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Evaluation Notes</label>
                        <textarea name="description" rows="5" class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 outline-none" placeholder="Add candidate feedback or scheduling notes..."></textarea>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    <a href="{{ route('employer-applicant-table-record') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Submit Remarks
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
