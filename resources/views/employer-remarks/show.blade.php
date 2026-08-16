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
                        <i class="bi bi-chat-left-quote-fill"></i>
                    </div>
                    <div>
                        <span class="badge bg-white/20 text-white rounded-pill text-[0.65rem] font-bold uppercase tracking-wider mb-1">Evaluation Details</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-0">Candidate Remarks</h2>
                    </div>
                </div>
                <div class="d-flex gap-2 self-start sm:self-auto">
                    @if(in_array(auth()->user()->role_id, [1, 2]))
                        <a class="btn btn-light rounded-pill px-3.5 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5" href="{{ route('employer_remarks.edit', $employer_remark->id) }}">
                            <i class="bi bi-pencil"></i>
                            <span>Edit</span>
                        </a>
                        <a class="btn btn-outline-light rounded-pill px-3.5 py-2 font-semibold text-xs d-inline-flex align-items-center gap-1.5" href="{{ route('employer-applicant-table-record') }}">
                            <i class="bi bi-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    @else
                        <a class="btn btn-outline-light rounded-pill px-3.5 py-2 font-semibold text-xs d-inline-flex align-items-center gap-1.5" href="{{ route('applicant-dashboard') }}">
                            <i class="bi bi-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-4 p-md-5">
            <div class="grid grid-cols-1 gap-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Status / Remarks</span>
                    <div class="font-bold text-slate-900 text-base">
                        @php $rem = trim($employer_remark->remarks ?? 'Pending'); @endphp
                        @if(strcasecmp($rem, 'Hired') === 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                <i class="bi bi-check-circle-fill"></i> Hired
                            </span>
                        @elseif(strcasecmp($rem, 'For Interview') === 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-xs font-semibold">
                                <i class="bi bi-calendar-event"></i> For Interview
                            </span>
                        @elseif(strcasecmp($rem, 'Reject') === 0 || strcasecmp($rem, 'Rejected') === 0)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                                <i class="bi bi-x-circle"></i> Unsuccessful
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">
                                <i class="bi bi-hourglass-split"></i> Pending Review
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider d-block mb-1">Employer Notes & Feedback</span>
                    <div class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $employer_remark->description ?: 'No detailed notes provided.' }}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
