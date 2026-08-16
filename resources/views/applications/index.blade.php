@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<div class="container-xl px-3 px-md-4 py-4 max-w-7xl mx-auto">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        {{-- Header --}}
        <div class="p-4 p-md-5 bg-gradient text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-md mb-2 text-xs font-semibold uppercase text-rose-300">
                        <i class="bi bi-person-check-fill"></i>
                        <span>Application Records</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Applicant Submissions</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Overview of all candidate applications across posted vacancies.</p>
                </div>
                <button class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2 self-start sm:self-auto" type="button" onclick="window.print()">
                    <i class="bi bi-printer-fill text-primary"></i>
                    <span>Print Records</span>
                </button>
            </div>
        </div>

        {{-- Alerts --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-0 border-0 m-0 p-3.5 d-flex align-items-center gap-2 bg-emerald-50 text-emerald-800" role="alert">
                <i class="bi bi-check-circle-fill text-emerald-600"></i>
                <div class="fw-medium text-xs">{{ $message }}</div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="p-4 p-md-5">
            <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-4">
                <table class="table align-middle mb-0 text-sm">
                    <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Applicant Name</th>
                            <th class="py-3 px-4">Job Title</th>
                            <th class="py-3 px-4">Company</th>
                            <th class="py-3 px-4">Date Applied</th>
                            <th class="py-3 px-4">Resume</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($data as $key => $value)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4 font-bold text-slate-400 text-xs">{{ ++$i }}</td>
                                <td class="py-3.5 px-4 font-bold text-slate-900">
                                    {{ trim("{$value->first_name} {$value->middle_name} {$value->last_name}") ?: 'Applicant' }}
                                </td>
                                <td class="py-3.5 px-4 font-medium text-slate-800">{{ $value->title }}</td>
                                <td class="py-3.5 px-4 text-slate-600 text-xs">{{ $value->company_name }}</td>
                                <td class="py-3.5 px-4 text-slate-500 text-xs">
                                    {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($value->file_attachment)
                                        <a href="{{ url('/download/'.$value->file_attachment) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold text-decoration-none transition-colors">
                                            <i class="bi bi-file-earmark-pdf-fill text-rose-500"></i>
                                            <span>Resume</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400">N/A</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4">
                                    @php $rem = trim($value->remarks ?? 'Pending'); @endphp
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
                                <td class="py-3.5 px-4 text-center">
                                    <div class="btn-group shadow-xs">
                                        <a href="{{ route('employer_remarks.show', $value->id)}}" class="btn btn-sm btn-outline-secondary" title="View Remarks">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('employer_remarks.edit', $value->id)}}" class="btn btn-sm btn-outline-primary" title="Edit Remarks">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteApply{{ $value->id }}" title="Delete Application">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    {{-- Delete Confirmation Modal --}}
                                    <div id="modalDeleteApply{{ $value->id }}" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 p-3 shadow-lg">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold text-dark">Confirm Delete</h5>
                                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-slate-600 text-sm py-3 text-start">
                                                    Are you sure you want to remove this application record? This process cannot be undone.
                                                </div>
                                                <div class="modal-footer border-0 pt-0 d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-light rounded-pill px-3.5 text-xs font-semibold" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('employer_remarks.destroy', $value->id) }}" method="POST">
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
                                    <p class="mb-0 font-semibold text-slate-600">No applications found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {!! $data->links() !!}
            </div>
        </div>

    </div>

</div>
@endsection

