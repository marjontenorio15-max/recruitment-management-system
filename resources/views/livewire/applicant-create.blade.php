@php use App\Models\Applicant; @endphp

<form class="frmEditProfile" action="" method="post" enctype="multipart/form-data">
    @csrf

    <input type="hidden" wire:model="app_id">
    <input type="hidden" wire:model="job_id">

    @php
        $applicants_info = DB::table('applicants')
            ->where('applicants.applicant_id', auth()->user()->id)->first();
    @endphp

    <!-- Personal Profile Section -->
    <div class="mb-4">
        <h5 class="fw-bold text-dark fs-6 mb-3 d-flex align-items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
            <span>Identity & Personal Details</span>
        </h5>

        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="first_name">First Name *</label>
                    <input class="form-control rounded-xl text-sm" id="first_name"
                           placeholder="First Name" type="text" wire:model="first_name" name="first_name"
                           value="{{ $applicants_info?->first_name ?? '' }}" required>
                    @error('first_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="middle_name">Middle Name</label>
                    <input class="form-control rounded-xl text-sm" id="middle_name"
                           placeholder="Middle Name" type="text" wire:model="middle_name" name="middle_name"
                           value="{{ $applicants_info?->middle_name ?? '' }}">
                    @error('middle_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="last_name">Last Name *</label>
                    <input class="form-control rounded-xl text-sm" id="last_name"
                           placeholder="Last Name" type="text" wire:model="last_name" name="last_name"
                           value="{{ $applicants_info?->last_name ?? '' }}" required>
                    @error('last_name') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="birth_date">Date of Birth</label>
                    <input class="form-control rounded-xl text-sm" id="birth_date"
                           type="date" name="birth_date"
                           value="{{ $applicants_info?->birth_date ?? '' }}">
                    @error('birth_date') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="sex">Sex</label>
                    <select class="form-select rounded-xl text-sm" name="sex" id="sex" wire:model="sex">
                        <option value="Male" {{ ($applicants_info?->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($applicants_info?->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="civil_status">Civil Status</label>
                    <select class="form-select rounded-xl text-sm" id="civil_status" name="civil_status" wire:model="civil_status">
                        <option value="Single" {{ ($applicants_info?->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ ($applicants_info?->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widow" {{ ($applicants_info?->civil_status ?? '') == 'Widow' ? 'selected' : '' }}>Widow</option>
                    </select>
                    @error('civil_status') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="degree">Primary Academic Degree</label>
                    <select class="form-select rounded-xl text-sm" name="degree" id="degree" wire:model="degree">
                        @php
                            $degrees = [
                                "Elementary Diploma",
                                "High School Diploma",
                                "Associate of Applied Science (AAS)",
                                "Associate of Arts (AA)",
                                "Associate of Science (AS)",
                                "Bachelor of Applied Science (BAS)",
                                "Bachelor of Architecture (B.Arch.)",
                                "Bachelor of Science (BS)",
                                "Bachelor of Business Administration (BBA)",
                                "Bachelor of Fine Arts (BFA)",
                                "Master's Degree"
                            ];
                            $userDeg = $applicants_info?->degree ?? '';
                        @endphp
                        @foreach($degrees as $deg)
                            <option value="{{ $deg }}" {{ $userDeg == $deg ? 'selected' : '' }}>{{ $deg }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="birth_place">Place of Birth</label>
                    <input class="form-control rounded-xl text-sm" id="birth_place"
                           placeholder="City / Municipality, Province" type="text" name="birth_place"
                           wire:model="birth_place" value="{{ $applicants_info?->birth_place ?? '' }}">
                    @error('birth_place') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4 text-slate-200">

    <!-- Contact & Address Section -->
    <div class="mb-4">
        <h5 class="fw-bold text-dark fs-6 mb-3 d-flex align-items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
            <span>Contact Information & Location</span>
        </h5>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="contact_no">Contact Number *</label>
                    <input class="form-control rounded-xl text-sm" id="contact_no"
                           placeholder="e.g. 09123456789" type="text" wire:model="contact_no" name="contact_no"
                           value="{{ $applicants_info?->contact_no ?? '' }}" required>
                    @error('contact_no') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="street_address">Street Address</label>
                    <input class="form-control rounded-xl text-sm" id="street_address"
                           placeholder="House No., Street Name" type="text" wire:model="street_address" name="street_address"
                           value="{{ $applicants_info?->address ?? '' }}">
                    @error('street_address') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="city">City / Municipality</label>
                    <input class="form-control rounded-xl text-sm" id="city"
                           placeholder="City" type="text" wire:model="city" name="city"
                           value="{{ $applicants_info?->city ?? '' }}">
                    @error('city') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="state">State / Province</label>
                    <input class="form-control rounded-xl text-sm" id="state"
                           placeholder="Province / Region" type="text" wire:model="state" name="state"
                           value="{{ $applicants_info?->state ?? '' }}">
                    @error('state') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label class="form-label text-xs fw-semibold text-slate-600 uppercase mb-1" for="zipcode">Zip Code</label>
                    <input class="form-control rounded-xl text-sm" id="zipcode"
                           placeholder="Zip Code" type="text" wire:model="zipcode" name="zipcode"
                           value="{{ $applicants_info?->zipcode ?? '' }}">
                    @error('zipcode') <span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <input class="form-control input-sm" id="email_address"
                   type="hidden" name="email" wire:model="email_address">
        </div>
    </div>

    <hr class="my-4 text-slate-200">

    <!-- Resume Document Attachment -->
    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-pdf text-rose-500 fs-5"></i>
                    <span>Official Resume File (PDF)</span>
                </h6>
                <p class="text-muted small mb-0">Upload your curriculum vitae or resume in PDF format.</p>
            </div>
            @if($applicants_info?->file_attachment != null)
                <a href="{{ asset("storage/uploads/{$applicants_info->file_attachment}") }}"
                   target="_blank"
                   class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 small fw-semibold d-inline-flex align-items-center gap-1.5 shadow-sm">
                    <i class="bi bi-download"></i>
                    <span>View Resume</span>
                </a>
            @endif
        </div>

        <input class="form-control rounded-xl bg-white text-sm" name="myfile" type="file"
               accept="application/pdf" wire:model="file_attachment">
        @error('file_attachment') <span class="text-danger small mt-1.5 d-block">{{ $message }}</span>@enderror
    </div>

    <!-- Submit Action -->
    <div class="d-flex align-items-center justify-content-end pt-2">
        <button type="submit" class="btn btn-dark rounded-pill px-4 py-2.5 small fw-semibold shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-check2-circle fs-6"></i>
            <span>Save Profile Details</span>
        </button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('.frmEditProfile').submit(function(e){
            e.preventDefault();
            EditProfile();
        });
    });

    function EditProfile() {
        $.ajax({
            url: "{{ url('/edit_profile') }}",
            data: new FormData($('.frmEditProfile')[0]),
            type : 'POST',
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data){
                if(data.result == 1) {
                    if (typeof showRmsToast === 'function') {
                        showRmsToast('Profile saved successfully!', 'success');
                    } else {
                        alert('Successfully Saved!');
                    }
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                }
                else{
                    if (typeof showRmsToast === 'function') {
                        showRmsToast('Saving failed. Please check the inputs.', 'error');
                    } else {
                        alert('Saving failed!');
                    }
                }
            }
        });
    }
</script>

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

<script type="text/javascript">
    $(document).ready(function(){
        $('.frmEditProfile').submit(function(e){
            e.preventDefault();
            EditProfile();
        });
    });

    function EditProfile() {
        $.ajax({
            url: "{{ url('/edit_profile') }}",
            data: new FormData($('.frmEditProfile')[0]),
            type : 'POST',
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data){
                if(data.result == 1) {
                    alert('Successfully Saved!');
                    window.location.reload();
                }
                else{
                    alert('Saving failed!');
                }
            }
        });
    }
</script>
