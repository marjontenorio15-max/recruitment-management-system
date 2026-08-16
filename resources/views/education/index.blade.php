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
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>Academic Credentials</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-1">Educational Background</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-0">Record of degrees, institutions, fields of study, and graduation dates.</p>
                </div>
                <div class="d-flex gap-2 self-start sm:self-auto">
                    <a class="btn btn-light rounded-pill px-4 py-2 font-semibold text-xs shadow-sm d-inline-flex align-items-center gap-2" href="{{ route('educational_background.create') }}">
                        <i class="bi bi-plus-circle-fill text-primary"></i>
                        <span>Add Education</span>
                    </a>
                    <a class="btn btn-outline-light rounded-pill px-4 py-2 font-semibold text-xs d-inline-flex align-items-center gap-2" href="{{ route('account-profile') }}">
                        <i class="bi bi-arrow-left"></i>
                        <span>Profile</span>
                    </a>
                </div>
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
                            <th class="py-3 px-4">School / Institution</th>
                            <th class="py-3 px-4">Location</th>
                            <th class="py-3 px-4">Degree Attained</th>
                            <th class="py-3 px-4">Field of Study</th>
                            <th class="py-3 px-4">Graduation Date</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($data as $key => $value)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4 font-bold text-slate-400 text-xs">{{ ++$i }}</td>
                                <td class="py-3.5 px-4 font-bold text-slate-900">{{ $value->school_name }}</td>
                                <td class="py-3.5 px-4 text-slate-500 text-xs">{{ $value->school_location }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border">
                                        {{ $value->degree }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-slate-600 text-xs">{{ $value->field_of_study }}</td>
                                <td class="py-3.5 px-4 text-slate-500 text-xs">
                                    {{ $value->month_graduate }} {{ $value->year_graduate }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="btn-group shadow-xs">
                                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('educational_background.show',$value->id) }}" title="View Record">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('educational_background.edit',$value->id) }}" title="Edit Record">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteEB{{ $value->id }}" title="Delete Record">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    {{-- Individual Delete Modal --}}
                                    <div id="modalDeleteEB{{ $value->id }}" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 p-3 shadow-lg">
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold text-dark">Confirm Delete</h5>
                                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-slate-600 text-sm py-3 text-start">
                                                    Are you sure you want to delete this educational background entry?
                                                </div>
                                                <div class="modal-footer border-0 pt-0 d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-light rounded-pill px-3.5 text-xs font-semibold" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('educational_background.destroy',$value->id) }}" method="POST">
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
                                <td colspan="7" class="py-8 text-center text-slate-400">
                                    <i class="bi bi-mortarboard fs-1 d-block mb-2 opacity-50"></i>
                                    <p class="mb-0 font-semibold text-slate-600">No educational background records found.</p>
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
