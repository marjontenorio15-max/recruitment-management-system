@php use App\Models\Vacancy; use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .applied-card-interactive {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
</style>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
        @include('applicant.partials.profile')

        <div class="p-4 p-md-5 bg-slate-50 border-top border-slate-100">
            <div class="row g-4">
                <div class="col-lg-3">
                    @include('applicant.partials.image-profile')
                </div>
                <div class="col-lg-9">
                    @php
                        $data = DB::table('apply')
                            ->where('apply.applicant_id', auth()->user()->id)
                            ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                            ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                            ->select('apply.remarks as remarks','tbl_job_list.title as title', 'companies.company_name',
                            'tbl_job_list.location', 'apply.description', 'apply.id', 'apply.created_at')
                            ->orderBy('apply.created_at', 'desc')
                            ->simplePaginate(10);

                        $allApplies = DB::table('apply')->where('applicant_id', auth()->user()->id)->get();
                        $totalCount = $allApplies->count();
                        $hiredCount = $allApplies->filter(fn($a) => strcasecmp(trim($a->remarks ?? ''), 'Hired') === 0)->count();
                        $interviewCount = $allApplies->filter(fn($a) => strcasecmp(trim($a->remarks ?? ''), 'For Interview') === 0)->count();
                        $pendingCount = $totalCount - $hiredCount - $interviewCount;
                    @endphp

                    <!-- Summary Metric Badges -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-white rounded-2xl border border-slate-200/90 shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-xl bg-slate-100 text-slate-800 p-2.5 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-text fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-semibold">Total Sent</div>
                                    <div class="fs-5 fw-bold text-dark">{{ $totalCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-white rounded-2xl border border-slate-200/90 shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-xl bg-sky-50 text-sky-700 p-2.5 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-event fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-semibold">Interviews</div>
                                    <div class="fs-5 fw-bold text-sky-700">{{ $interviewCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-white rounded-2xl border border-slate-200/90 shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-xl bg-emerald-50 text-emerald-700 p-2.5 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-check-circle-fill fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-semibold">Hired</div>
                                    <div class="fs-5 fw-bold text-emerald-700">{{ $hiredCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-3 bg-white rounded-2xl border border-slate-200/90 shadow-sm d-flex align-items-center gap-3">
                                <div class="rounded-xl bg-amber-50 text-amber-700 p-2.5 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-hourglass-split fs-5"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-semibold">In Review</div>
                                    <div class="fs-5 fw-bold text-amber-700">{{ $pendingCount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pb-4 mb-4 border-b border-slate-100">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                    <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-0">Applied Jobs History</h3>
                                </div>
                                <p class="text-slate-500 text-xs sm:text-sm mb-0 mt-0.5">Track your submitted job applications and employer status updates.</p>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <select id="myInput" onchange="filterAppliedJobs()" class="text-xs py-2 px-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-slate-900 outline-none">
                                    <option value="" selected="selected">All Statuses</option>
                                    <option value="Pending">Under Review</option>
                                    <option value="Hired">Hired</option>
                                    <option value="For Interview">For Interview</option>
                                    <option value="Reject">Unsuccessful</option>
                                </select>

                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                                        <i class="bi bi-search text-xs"></i>
                                    </span>
                                    <input class="pl-8 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-slate-900 outline-none w-44 sm:w-56" onkeyup="filterAppliedJobs()" id="searchInput" placeholder="Search title or company..." type="text">
                                </div>
                            </div>
                        </div>

                        @if($data->count() > 0)
                            <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-4">
                                <table class="table align-middle mb-0 text-sm" id="myTable">
                                    <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                                        <tr class="header">
                                            <th class="py-3 px-4">Job Title</th>
                                            <th class="py-3 px-4">Company</th>
                                            <th class="py-3 px-4">Location</th>
                                            <th class="py-3 px-4">Status</th>
                                            <th class="py-3 px-4">Feedback / Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach ($data as $applicant)
                                            <tr class="hover:bg-slate-50/80 transition-colors">
                                                <td class="py-3.5 px-4 font-bold text-slate-900">{{$applicant->title}}</td>
                                                <td class="py-3.5 px-4 font-medium text-slate-700">{{$applicant->company_name}}</td>
                                                <td class="py-3.5 px-4 text-slate-500"><i class="bi bi-geo-alt me-1 text-slate-400"></i>{{$applicant->location}}</td>
                                                <td class="py-3.5 px-4">
                                                    @php $rem = trim($applicant->remarks ?? 'Pending'); @endphp
                                                    @if(strcasecmp($rem, 'Hired') === 0)
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                                            <i class="bi bi-check-circle-fill text-xs"></i> Hired
                                                        </span>
                                                    @elseif(strcasecmp($rem, 'For Interview') === 0)
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-xs font-semibold">
                                                            <i class="bi bi-calendar-event text-xs"></i> For Interview
                                                        </span>
                                                    @elseif(strcasecmp($rem, 'Reject') === 0 || strcasecmp($rem, 'Rejected') === 0)
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">
                                                            <i class="bi bi-x-circle text-xs"></i> Unsuccessful
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">
                                                            <i class="bi bi-hourglass-split text-xs"></i> Under Review
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-500 text-xs max-w-xs">{{$applicant->description ?: 'No employer notes provided yet.'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <span class="float-end shadow-sm">{!! $data->links() !!}</span>
                            </div>
                        @else
                            <div class="text-center py-5 px-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <div class="rounded-circle bg-slate-100 text-slate-400 d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                                    <i class="bi bi-inbox fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">No Applications Submitted Yet</h5>
                                <p class="text-muted small mb-3">Explore thousands of open vacancies and submit your career applications today.</p>
                                <a href="{{ route('view-jobs') }}" class="btn btn-dark rounded-pill px-4 py-2 small fw-semibold shadow-sm">
                                    <i class="bi bi-search me-1"></i> Browse Open Positions
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterAppliedJobs() {
        var statusFilter = (document.getElementById("myInput").value || "").toUpperCase().trim();
        var textFilter = (document.getElementById("searchInput").value || "").toUpperCase().trim();
        var table = document.getElementById("myTable");
        if (!table) return;
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var rowText = (tr[i].textContent || tr[i].innerText || "").toUpperCase();
            var matchesText = !textFilter || rowText.indexOf(textFilter) > -1;
            var matchesStatus = true;

            if (statusFilter) {
                var statusCell = tr[i].getElementsByTagName("td")[3];
                var statusText = statusCell ? (statusCell.textContent || statusCell.innerText || "").toUpperCase() : "";
                matchesStatus = statusText.indexOf(statusFilter) > -1;
            }

            if (matchesText && matchesStatus) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endsection
