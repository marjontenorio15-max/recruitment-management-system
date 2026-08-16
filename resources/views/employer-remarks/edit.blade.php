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
                        <i class="bi bi-pencil-square"></i>
                        <span>Recruitment Evaluation</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Update Applicant Remarks</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Modify candidate status and provide employer feedback notes.</p>
                </div>
                <div>
                    @if(auth()->user()->role_id == 2)
                        <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5" href="{{ route('employer-applicant-table-record') }}">
                            <i class="bi bi-arrow-left"></i>
                            <span>Back to Pipeline</span>
                        </a>
                    @else
                        <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-1.5" href="{{ route('apply.index') }}">
                            <i class="bi bi-arrow-left"></i>
                            <span>Back to Applications</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Validation Alerts --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-0 border-0 m-0 p-4 bg-rose-50 text-rose-800" role="alert">
                <div class="font-bold text-sm mb-1 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-octagon-fill text-rose-600"></i>
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="mb-0 text-xs list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form Body --}}
        <div class="p-4 p-md-5">
            <form action="{{ route('employer_remarks.update', $employer_remark->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Application Status <span class="text-rose-500">*</span></label>
                    <select name="remarks" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none">
                        <option value="Pending" {{ $employer_remark->remarks == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="For Interview" {{ $employer_remark->remarks == 'For Interview' ? 'selected' : '' }}>For Interview</option>
                        <option value="Hired" {{ $employer_remark->remarks == 'Hired' ? 'selected' : '' }}>Hired</option>
                        <option value="Reject" {{ ($employer_remark->remarks == 'Reject' || $employer_remark->remarks == 'Rejected') ? 'selected' : '' }}>Reject</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Feedback & Evaluation Notes</label>
                    <textarea name="description" rows="6" class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:bg-white focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 outline-none" placeholder="Add interview feedback, scheduled time, or hiring remarks here...">{{ old('description', $employer_remark->description) }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 d-flex justify-content-end gap-3">
                    @if(auth()->user()->role_id == 2)
                        <a href="{{ route('employer-applicant-table-record') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    @else
                        <a href="{{ route('apply.index') }}" class="btn btn-light rounded-pill px-4 text-xs font-semibold">Cancel</a>
                    @endif
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-xs font-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Save Remarks
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>
@endsection

