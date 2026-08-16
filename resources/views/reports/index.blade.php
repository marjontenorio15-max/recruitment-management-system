@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    @media print {
        body { background: #ffffff !important; }
        .no-print, nav, header, footer, .btn-print-wrapper { display: none !important; }
        .print-only { display: block !important; }
        .report-card { border: none !important; box-shadow: none !important; }
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white report-card">

        {{-- Header & Filters --}}
        <div class="p-4 p-md-5 bg-gradient text-white no-print" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <span>Recruitment Analytics</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Applicant Reports</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Generate, filter, and print applicant recruitment reports.</p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-3">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('reports.index') }}" id="filterForm" class="d-flex align-items-center gap-2">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Status:</span>
                        <select name="remarks" class="form-select form-select-sm rounded-pill text-xs px-3 py-1.5 border-0 shadow-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="All" {{ ($selectedRemark ?? 'All') == 'All' ? 'selected' : '' }}>All Applicants</option>
                            <option value="Pending" {{ ($selectedRemark ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="For Interview" {{ ($selectedRemark ?? '') == 'For Interview' ? 'selected' : '' }}>For Interview</option>
                            <option value="Reject" {{ ($selectedRemark ?? '') == 'Reject' ? 'selected' : '' }}>Reject</option>
                            <option value="Hired" {{ ($selectedRemark ?? '') == 'Hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                    </form>

                    <button class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 hover:bg-white" type="button" onclick="window.print()">
                        <i class="bi bi-printer-fill text-primary"></i>
                        <span>Print Report</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Report Body --}}
        <div class="p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-b border-slate-100">
                <div>
                    <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Generated Applicants List</h4>
                    <span class="text-xs text-slate-500">Filter applied: <strong class="text-slate-700">{{ $selectedRemark ?? 'All' }}</strong></span>
                </div>
                <span class="badge bg-slate-100 text-slate-700 border rounded-pill px-3 py-1.5 text-xs font-semibold">
                    Total Records: {{ count($applicants) }}
                </span>
            </div>

            <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden">
                <table class="table align-middle mb-0 text-sm tblApplicants">
                    <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="py-3 px-3">Applicant Name</th>
                            <th class="py-3 px-3">Job Title</th>
                            <th class="py-3 px-3">Contact & Email</th>
                            <th class="py-3 px-3">Location</th>
                            <th class="py-3 px-3">Company</th>
                            <th class="py-3 px-3">Degree</th>
                            <th class="py-3 px-3">Date Applied</th>
                            <th class="py-3 px-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($applicants as $app)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-3 font-bold text-slate-900">
                                    {{ trim("{$app->first_name} {$app->middle_name} {$app->last_name}") ?: 'N/A' }}
                                </td>
                                <td class="py-3 px-3 font-medium text-slate-800">{{ $app->title }}</td>
                                <td class="py-3 px-3 text-xs text-slate-600">
                                    <div><i class="bi bi-envelope me-1 text-slate-400"></i>{{ $app->email_address }}</div>
                                    @if($app->contact_no)
                                        <div class="text-slate-400 mt-0.5"><i class="bi bi-telephone me-1"></i>{{ $app->contact_no }}</div>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-xs text-slate-500">
                                    {{ implode(', ', array_filter([$app->address, $app->city, $app->state, $app->zipcode])) ?: 'N/A' }}
                                </td>
                                <td class="py-3 px-3 font-medium text-slate-700">{{ $app->company_name }}</td>
                                <td class="py-3 px-3 text-xs text-slate-600">{{ $app->degree ?: 'N/A' }}</td>
                                <td class="py-3 px-3 text-xs text-slate-500">
                                    {{ $app->created_at ? \Carbon\Carbon::parse($app->created_at)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="py-3 px-3">
                                    @php $rem = trim($app->remarks ?? 'Pending'); @endphp
                                    @if(strcasecmp($rem, 'Hired') === 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                            Hired
                                        </span>
                                    @elseif(strcasecmp($rem, 'For Interview') === 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-xs font-semibold">
                                            For Interview
                                        </span>
                                    @elseif(strcasecmp($rem, 'Reject') === 0 || strcasecmp($rem, 'Rejected') === 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                                            Unsuccessful
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-slate-400">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0 font-semibold text-slate-600">No applicants found matching this criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection


