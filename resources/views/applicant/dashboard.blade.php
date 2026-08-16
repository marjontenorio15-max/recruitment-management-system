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
                                <select id="myInput" onchange="myFunction()" class="text-xs py-2 px-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-slate-900 outline-none">
                                    <option value="" selected="selected">All Statuses</option>
                                    <option>Pending</option>
                                    <option>Hired</option>
                                    <option>For Interview</option>
                                    <option>Reject</option>
                                </select>

                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                                        <i class="bi bi-search text-xs"></i>
                                    </span>
                                    <input class="pl-8 pr-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-slate-900 outline-none w-44 sm:w-56" onkeyup="myFunction()" id="searchInput" placeholder="Search" type="text">
                                </div>
                            </div>
                        </div>

                        @php
                            $data = DB::table('apply')
                                ->where('apply.applicant_id', auth()->user()->id)
                                ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                                ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                                ->select('apply.remarks as remarks','tbl_job_list.title as title', 'companies.company_name',
                                'tbl_job_list.location', 'apply.description', 'apply.id')
                                ->orderBy('apply.created_at', 'desc')
                                ->simplePaginate(10);
                        @endphp

                        <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-4">
                            <table class="table align-middle mb-0 text-sm" id="myTable">
                                <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                                    <tr class="header">
                                        <th class="py-3 px-4">Job Title</th>
                                        <th class="py-3 px-4">Company</th>
                                        <th class="py-3 px-4">Location</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4">Description</th>
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
                                            <td class="py-3.5 px-4 text-slate-500 text-xs max-w-xs">{{$applicant->description ?: 'No notes provided yet.'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <span class="float-end shadow-sm">{!! $data->links() !!}</span>
                        </div>
                    </div>
                </div>

              </div>
          </div>
      </div>
  </div>

    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            // for (i = 0; i < tr.length; i++) {
            //     td = tsr[i].getElementsByTagName("td")[0];
            //     if (td) {
            //         txtValue = td.textContent || td.innerText;
            //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //             tr[i].style.display = "";
            //         } else {
            //             tr[i].style.display = "none";
            //
            //         }
            //     }
            // }
            for (i = 1; i < tr.length; i++) {
                // Hide the row initially.
                tr[i].style.display = "none";

                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    cell = tr[i].getElementsByTagName("td")[j];
                    if (cell) {
                        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

    </script>

@endsection
