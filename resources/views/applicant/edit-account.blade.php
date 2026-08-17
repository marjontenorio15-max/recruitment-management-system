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
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm p-4 sm:p-6">
                        <div class="d-flex align-items-center gap-2.5 pb-3 mb-4 border-b border-slate-100">
                            <div class="rounded-xl bg-indigo-50 text-indigo-600 p-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-pencil-square fs-5"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 tracking-tight mb-0">Edit Candidate Profile</h4>
                                <p class="text-slate-500 text-xs mb-0">Update your complete personal information, contact methods, and resume attachment.</p>
                            </div>
                        </div>

                        @php
                            $applicants = \App\Models\Applicant::where('applicant_id', auth()->user()->id)->get();
                        @endphp

                        @foreach($applicants as $applicant)
                        <form action="{{ route('applicant.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" wire:model="applicant_id">

                            <!-- Personal Details Section -->
                            <div class="mb-4">
                                <h5 class="fw-bold text-dark fs-6 mb-3 d-flex align-items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                    <span>Personal Information</span>
                                </h5>

                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="first_name">First Name *</label>
                                            <input class="form-control rounded-xl text-sm" id="id" value="{{$applicant->id}}"
                                                   type="hidden" wire:model="id">
                                            <input class="form-control rounded-xl text-sm" id="first_name" value="{{$applicant->first_name}}"
                                                   placeholder="First Name" type="text" wire:model="first_name" required>
                                            @error('first_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="middle_name">Middle Name</label>
                                            <input class="form-control rounded-xl text-sm" id="middle_name" value="{{$applicant->middle_name}}"
                                                   placeholder="Middle Name" type="text" wire:model="middle_name">
                                            @error('middle_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="last_name">Last Name *</label>
                                            <input class="form-control rounded-xl text-sm" id="last_name" value="{{$applicant->last_name}}"
                                                   placeholder="Last Name" type="text" wire:model="last_name" required>
                                            @error('last_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="birth_date">Date of Birth</label>
                                            <input class="form-control rounded-xl text-sm" id="birth_date" value="{{$applicant->birth_place}}"
                                                   type="date" wire:model="birth_date">
                                            @error('birth_date') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="sex">Sex</label>
                                            <select class="form-select rounded-xl text-sm" name="sex" id="sex" wire:model="sex" required>
                                                <option value="" disabled>Select Sex</option>
                                                <option value="Male" {{ $applicant->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $applicant->sex == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @error('sex') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="age">Age</label>
                                            <input class="form-control rounded-xl text-sm" id="age" value="{{$applicant->age}}"
                                                   placeholder="Age" type="number" wire:model="age">
                                            @error('age') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="birth_place">Place of Birth</label>
                                            <textarea class="form-control rounded-xl text-sm" id="birth_place" rows="2"
                                                      placeholder="Place of birth" name="birth_place" wire:model="birth_place">{{$applicant->birth_place}}</textarea>
                                            @error('birth_place') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-slate-200">

                            <!-- Contacts & Address Section -->
                            <div class="mb-4">
                                <h5 class="fw-bold text-dark fs-6 mb-3 d-flex align-items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                                    <span>Contact & Educational Information</span>
                                </h5>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="contact_no">Contact Number</label>
                                            <input class="form-control rounded-xl text-sm" id="contact_no" value="{{$applicant->contact_no}}"
                                                   placeholder="e.g. 09123456789" type="text" wire:model="contact_no">
                                            @error('contact_no') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="email_address">Email Address *</label>
                                            <input class="form-control rounded-xl text-sm" id="email_address" value="{{$applicant->email_address}}"
                                                   placeholder="Email Address" type="email" name="email" wire:model="email_address" required>
                                            @error('email_address') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="civil_status">Civil Status</label>
                                            <select class="form-select rounded-xl text-sm" id="civil_status" name="civil_status"
                                                    wire:model="civil_status" required>
                                                <option value="none">Select Status</option>
                                                <option value="Single" {{ $applicant->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                                <option value="Married" {{ $applicant->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                                <option value="Widow" {{ $applicant->civil_status == 'Widow' ? 'selected' : '' }}>Widow</option>
                                            </select>
                                            @error('civil_status') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="degree">Educational Attainment</label>
                                            <input class="form-control rounded-xl text-sm" id="degree" value="{{$applicant->degree}}"
                                                   placeholder="Degree / Qualification" type="text" wire:model="degree">
                                            @error('degree') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label text-xs fw-semibold text-slate-600 uppercase" for="address">Full Address</label>
                                            <textarea class="form-control rounded-xl text-sm" id="address" rows="3"
                                                      placeholder="Street, Barangay, City, Province" wire:model="address">{{$applicant->address}}</textarea>
                                            @error('address') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-slate-200">

                            <!-- File Upload Section -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 mb-4">
                                <h6 class="fw-bold text-dark mb-2 d-flex align-items-center gap-2">
                                    <i class="bi bi-paperclip text-slate-500"></i>
                                    <span>Resume / Document Attachment</span>
                                </h6>
                                <p class="text-muted small mb-3">Upload your latest PDF resume or portfolio file.</p>
                                <input type="file" class="form-control rounded-xl bg-white text-sm" name="myfile" wire:model="file_attachment">
                            </div>

                            <div class="d-flex align-items-center gap-2 justify-content-end pt-2">
                                <button wire:click.prevent="cancel()" type="button" class="btn btn-light rounded-pill px-4 py-2 small fw-semibold">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                                <button wire:click.prevent="update()" type="button" class="btn btn-dark rounded-pill px-4 py-2 small fw-semibold shadow-sm">
                                    <i class="bi bi-check2-circle me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

