@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    rmsNavy: {
                        900: '#0a0f1d',
                        800: '#0f172a',
                        700: '#1e293b',
                    },
                    rmsRed: {
                        DEFAULT: '#e31837',
                        hover: '#c4122d',
                        light: '#fff1f2',
                    }
                }
            }
        }
    }
</script>
<style>
    .home-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .home-card-interactive:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08);
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    {{-- Breadcrumb & Title --}}
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-6">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 text-xs">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-900 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-slate-800 fw-semibold" aria-current="page">Analytics & Overview</li>
                </ol>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-0">Employer Overview</h1>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('vacancy.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-medium text-xs shadow-sm hover:shadow transition-all text-decoration-none">
                <i class="bi bi-plus-circle"></i>
                <span>Post Vacancy</span>
            </a>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-medium text-xs shadow-sm transition-all text-decoration-none">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Reports</span>
            </a>
        </div>
    </div>

    @php
        $companyId = auth()->user()->id;

        $totalCount = DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->when(auth()->user()->role_id != 1, function($q) use ($companyId) {
                return $q->where('tbl_job_list.company_id', $companyId);
            })
            ->count();

        $hiredCount = DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->when(auth()->user()->role_id != 1, function($q) use ($companyId) {
                return $q->where('tbl_job_list.company_id', $companyId);
            })
            ->where('apply.remarks', 'Hired')
            ->count();

        $interviewCount = DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->when(auth()->user()->role_id != 1, function($q) use ($companyId) {
                return $q->where('tbl_job_list.company_id', $companyId);
            })
            ->where('apply.remarks', 'For Interview')
            ->count();

        $pendingCount = DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->when(auth()->user()->role_id != 1, function($q) use ($companyId) {
                return $q->where('tbl_job_list.company_id', $companyId);
            })
            ->where('apply.remarks', 'Pending')
            ->count();

        $rejectCount = DB::table('apply')
            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
            ->when(auth()->user()->role_id != 1, function($q) use ($companyId) {
                return $q->where('tbl_job_list.company_id', $companyId);
            })
            ->where('apply.remarks', 'Reject')
            ->count();
    @endphp

    {{-- Metrics Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">

        <!-- Total Applicants -->
        <div class="home-card-interactive p-5 rounded-3xl flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-800 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-slate-400 uppercase tracking-widest">Pipeline</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-900 tracking-tight leading-none mb-1">{{ $totalCount }}</div>
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Total Applicants</div>
                <a href="{{ route('employer-applicant-table-record') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-700 hover:text-slate-900 text-decoration-none">
                    <span>Manage List</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="home-card-interactive p-5 rounded-3xl bg-gradient-to-br from-amber-50/40 to-white border-amber-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-amber-500 uppercase tracking-widest">Pending</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-amber-600 tracking-tight leading-none mb-1">{{ $pendingCount }}</div>
                <div class="text-xs font-semibold text-amber-700/80 uppercase tracking-wider mb-4">Under Review</div>
                <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-700 hover:text-amber-900 text-decoration-none">
                    <span>View Pending</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Interviews -->
        <div class="home-card-interactive p-5 rounded-3xl bg-gradient-to-br from-sky-50/40 to-white border-sky-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-calendar2-check"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-sky-500 uppercase tracking-widest">Interview</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-sky-600 tracking-tight leading-none mb-1">{{ $interviewCount }}</div>
                <div class="text-xs font-semibold text-sky-700/80 uppercase tracking-wider mb-4">Scheduled</div>
                <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-sky-700 hover:text-sky-900 text-decoration-none">
                    <span>Interview List</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Hired -->
        <div class="home-card-interactive p-5 rounded-3xl bg-gradient-to-br from-emerald-50/40 to-white border-emerald-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-emerald-500 uppercase tracking-widest">Hired</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-emerald-600 tracking-tight leading-none mb-1">{{ $hiredCount }}</div>
                <div class="text-xs font-semibold text-emerald-700/80 uppercase tracking-wider mb-4">Successful Placements</div>
                <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 hover:text-emerald-900 text-decoration-none">
                    <span>Hired Details</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Rejected -->
        <div class="home-card-interactive p-5 rounded-3xl bg-gradient-to-br from-rose-50/40 to-white border-rose-200/80 flex flex-col justify-between">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-700 flex items-center justify-center text-xl shadow-xs">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <span class="text-[0.65rem] font-bold text-rose-500 uppercase tracking-widest">Declined</span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-rose-600 tracking-tight leading-none mb-1">{{ $rejectCount }}</div>
                <div class="text-xs font-semibold text-rose-700/80 uppercase tracking-wider mb-4">Unsuccessful</div>
                <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-700 hover:text-rose-900 text-decoration-none">
                    <span>Archive Details</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection


