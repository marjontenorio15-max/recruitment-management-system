@php use App\Models\Applicant; @endphp
@extends('layouts.app-master')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
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
                    <div class="d-flex flex-column gap-4">

                        <!-- Photo Upload Section -->
                        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                            <div class="d-flex align-items-center gap-2.5 pb-3 mb-3 border-b border-slate-100">
                                <div class="rounded-xl bg-sky-50 text-sky-600 p-2 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-camera fs-5"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Profile Avatar Photo</h4>
                                    <p class="text-slate-500 text-xs mb-0">Upload or change your official account profile image.</p>
                                </div>
                            </div>
                            @include('media.image-form')
                        </div>

                        <!-- Recommended Jobs Section -->
                        @php
                            $applicant_degree = DB::table('educational_background')
                                ->where('applicant_id', auth()->user()->id)
                                ->value('degree');

                            $vacancies = DB::table('tbl_job_list')
                                ->select(
                                    'tbl_job_list.id as id',
                                    'tbl_job_list.title',
                                    'tbl_job_list.location',
                                    'tbl_job_list.degree',
                                    'tbl_job_list.sex',
                                    'tbl_job_list.status',
                                    'tbl_job_list.work_exp',
                                    'tbl_job_list.salary',
                                    'tbl_job_list.created_at',
                                    'users.username as created_by',
                                    'companies.company_name'
                                )
                                ->leftJoin('users', 'tbl_job_list.created_by', '=', 'users.id')
                                ->leftJoin('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
                                ->where('tbl_job_list.status', 1)
                                ->when($applicant_degree, function ($q, $deg) {
                                    return $q->where('tbl_job_list.degree', 'like', "%{$deg}%");
                                })
                                ->latest('tbl_job_list.created_at')
                                ->paginate(5);
                        @endphp

                        @if(auth()->user()->role_id == 3 && $vacancies->count() > 0)
                            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                                <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-b border-slate-100">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="rounded-xl bg-emerald-50 text-emerald-600 p-2 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-stars fs-5"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Recommended Job Vacancies</h4>
                                            <p class="text-slate-500 text-xs mb-0">Matched according to your educational background and career profile.</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-emerald-100 text-emerald-800 rounded-pill px-3 py-1 text-xs fw-semibold">
                                        {{ $vacancies->total() }} Matches
                                    </span>
                                </div>

                                @if(session()->has('message'))
                                    <div class="alert alert-danger d-flex alert-dismissible fade show align-items-center gap-2 rounded-2xl p-3 mb-3" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <span class="small">{{ session('message') }}</span>
                                        <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="table-responsive rounded-2xl border border-slate-200 overflow-hidden mb-3">
                                    @include('jobs.vacancy-list')
                                </div>
                                <div class="d-flex justify-content-end">
                                    <span class="float-end shadow-sm">{!! $vacancies->links() !!}</span>
                                </div>
                            </div>
                        @endif

                        @if(auth()->user()->role_id == 3)
                            <!-- Personal Information -->
                            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                                <div class="d-flex align-items-center gap-2.5 pb-3 mb-4 border-b border-slate-100">
                                    <div class="rounded-xl bg-indigo-50 text-indigo-600 p-2 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-vcard fs-5"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Personal Information & Contacts</h4>
                                        <p class="text-slate-500 text-xs mb-0">Update your core personal details, address, and primary contact information.</p>
                                    </div>
                                </div>

                                @include('livewire.applicant-create')
                            </div>

                            <!-- Educational Background -->
                            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                                <div class="d-flex align-items-center gap-2.5 pb-3 mb-4 border-b border-slate-100">
                                    <div class="rounded-xl bg-purple-50 text-purple-600 p-2 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-mortarboard fs-5"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Educational Background</h4>
                                        <p class="text-slate-500 text-xs mb-0">List your academic degrees, certifications, and educational milestones.</p>
                                    </div>
                                </div>

                                @include('fragments.educational-background')
                            </div>

                            <!-- Work Experience -->
                            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                                <div class="d-flex align-items-center gap-2.5 pb-3 mb-4 border-b border-slate-100">
                                    <div class="rounded-xl bg-amber-50 text-amber-600 p-2 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-briefcase fs-5"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Work Experience & Achievements</h4>
                                        <p class="text-slate-500 text-xs mb-0">Highlight your past employers, key roles, responsibilities, and certificates.</p>
                                    </div>
                                </div>

                                @include('fragments.work_experience')
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

