@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        @auth()
            @if(in_array(auth()->user()->role_id, [1, 2]))
                {{-- Header --}}
                <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Recruitment Candidate Pipeline</span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Applicant Submissions</h2>
                            <p class="text-slate-300 text-xs sm:text-sm mb-0">Review candidates, examine resumes, and update recruitment remarks.</p>
                        </div>

                        {{-- Search Input --}}
                        <div class="relative w-full sm:w-72">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                                <i class="bi bi-search text-xs"></i>
                            </span>
                            <input type="text" id="searchAll" onkeyup="myFunctionSearch()" placeholder="Search candidates, jobs..." class="w-full pl-9 pr-4 py-2 rounded-pill text-xs bg-white text-slate-900 placeholder-slate-400 shadow-sm outline-none border-0">
                        </div>
                    </div>
                </div>

                @php
                    $applicants = DB::table('apply')
                        ->when(auth()->user()->role_id != 1, function($q) {
                            return $q->where('tbl_job_list.company_id', auth()->user()->id);
                        })
                        ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                        ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                        ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                        ->select(
                            'apply.remarks',
                            'apply.id',
                            'applicants.file_attachment',
                            'apply.created_at',
                            'tbl_job_list.title',
                            'companies.company_name',
                            'applicants.first_name',
                            'applicants.last_name',
                            'applicants.middle_name',
                            'apply.description'
                        )
                        ->orderBy('apply.created_at', 'desc')
                        ->simplePaginate(10);
                @endphp

                {{-- Table --}}
                <div class="p-4 p-md-5">
                    <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-4">
                        <table class="table align-middle mb-0 text-sm" id="myTable">
                            <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="py-3 px-4">Candidate Name</th>
                                    <th class="py-3 px-4">Position Title</th>
                                    <th class="py-3 px-4">Company</th>
                                    <th class="py-3 px-4">Applied Date</th>
                                    <th class="py-3 px-4">Resume</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4">Employer Notes</th>
                                    <th class="py-3 px-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse($applicants as $applicant)
                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                        <td class="py-3.5 px-4">
                                            <div class="font-bold text-slate-900 text-sm">
                                                {{ trim("{$applicant->first_name} {$applicant->middle_name} {$applicant->last_name}") ?: 'Candidate' }}
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 font-medium text-slate-800">{{ $applicant->title }}</td>
                                        <td class="py-3.5 px-4 text-slate-600 text-xs">{{ $applicant->company_name }}</td>
                                        <td class="py-3.5 px-4 text-slate-500 text-xs">
                                            {{ $applicant->created_at ? \Carbon\Carbon::parse($applicant->created_at)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="py-3.5 px-4">
                                            @if($applicant->file_attachment)
                                                <a href="{{ asset('storage/uploads/'.$applicant->file_attachment) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold text-decoration-none transition-colors">
                                                    <i class="bi bi-file-earmark-pdf-fill text-rose-500"></i>
                                                    <span>Resume</span>
                                                </a>
                                            @else
                                                <span class="text-xs text-slate-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4">
                                            @php $rem = trim($applicant->remarks ?? 'Pending'); @endphp
                                            @if(strcasecmp($rem, 'Hired') === 0)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">Hired</span>
                                            @elseif(strcasecmp($rem, 'For Interview') === 0)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-xs font-semibold">For Interview</span>
                                            @elseif(strcasecmp($rem, 'Reject') === 0 || strcasecmp($rem, 'Rejected') === 0)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-xs font-semibold">Declined</span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold">Pending</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-500 text-xs max-w-xs">{{ $applicant->description ?: '—' }}</td>
                                        <td class="py-3.5 px-4 text-center">
                                            <div class="btn-group shadow-xs">
                                                <a href="{{ route('employer_remarks.edit', $applicant->id) }}" class="btn btn-sm btn-outline-primary" title="Update Remarks">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteApplicant{{ $applicant->id }}" title="Delete Application">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            {{-- Delete Confirmation Modal --}}
                                            <div id="modalDeleteApplicant{{ $applicant->id }}" class="modal fade" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content rounded-4 border-0 p-3 shadow-lg">
                                                        <div class="modal-header border-0 pb-0">
                                                            <h5 class="modal-title fw-bold text-dark">Delete Application</h5>
                                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-slate-600 text-sm py-3 text-start">
                                                            Are you sure you want to remove this applicant record? This action cannot be undone.
                                                        </div>
                                                        <div class="modal-footer border-0 pt-0 d-flex justify-content-end gap-2">
                                                            <button type="button" class="btn btn-light rounded-pill px-3.5 text-xs font-semibold" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('employer_remarks.destroy', $applicant->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger rounded-pill px-4 text-xs font-semibold">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-8 text-center text-slate-400">
                                            <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-50"></i>
                                            <p class="mb-0 font-semibold text-slate-600">No applicant records found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        {!! $applicants->links() !!}
                    </div>
                </div>
            @endif
        @endauth
    </div>

</div>

@push('scripts')
<script>
    function myFunctionSearch() {
        var input = document.getElementById("searchAll");
        var filter = input.value.toUpperCase();
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var rowText = tr[i].textContent || tr[i].innerText;
            if (rowText.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endpush
@endsection


