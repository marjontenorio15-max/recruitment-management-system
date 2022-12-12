
<form enctype="multipart/form-data">
    <input type="hidden" wire:model="applicant_id">
{{--    <h4>Login Account</h4>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-6">--}}

{{--            <div class="form-group">--}}
{{--                <label class="col-form-label" for="user_name">User Name:</label>--}}
{{--                <input class="form-control input-sm" id="user_name"--}}
{{--                       placeholder="Username" type="text" wire:model="user_name">--}}
{{--                @error('user_name') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                <label class="col-form-label" for="password">Password:</label>--}}
{{--                <input class="form-control input-sm" id="password"--}}
{{--                       placeholder="Password" type="password" name="password" wire:model="password" required>--}}
{{--                @error('password') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <hr>

    <h3>Personal Information</h3>

    <div class="row">
        {{--                {{ $vacancies->title }}--}}
        <div class="col-md-6">
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="first_name"
                       placeholder="First Name" type="text" wire:model="first_name">
                <label class="col-form-label" for="first_name">First Name:</label>
                @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="middle_name"
                       placeholder="Middle Name" type="text" wire:model="middle_name">
                <label class="col-form-label" for="middle_name">Middle Name:</label>
                @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="last_name"
                       placeholder="Last Name" type="text" wire:model="last_name">
                <label class="col-form-label" for="last_name">Last Name:</label>
                @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control" id="birth_date"
                       placeholder="Date of Birth" type="date" wire:model="birth_date" >
                <label for="birth_date">Date of Birth:</label>
                @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <select class="form-control" name="sex" id="sex" wire:model="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <label class="col-form-label" for="sex">Sex:</label>
                @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-floating">
                <select class="form-control input-sm" id="civil_status" name="civil_status"
                        wire:model="civil_status">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widow">Widow</option>
                </select>
                <label class="col-form-label" for="civil_status">Civil Status:</label>
                @error('civil_status') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">

                <select class="form-control" name="degree" id="degree" wire:model="degree">
                    <option value="Elementary Diploma">Elementary Diploma</option>
                    <option value="High School Diploma">High School Diploma</option>
                    <option value="Associate of Applied Science">Associate of Applied Science (AAS)</option>
                    <option value="Associate of Arts">Associate of Arts (AA)</option>
                    <option value="Associate of Science">Associate of Science (AS)</option>
                    <option value="Bachelor of Applied Science">Bachelor of Applied Science (BAS)</option>
                    <option value="Bachelor of Arts">Bachelor of Architecture (B.Arch.)</option>
                    <option value="Bachelor of Science">Bachelor of Science (BS)</option>
                    <option value="Bachelor of Business Administration">Bachelor of Business Administration (BBA)</option>
                    <option value="Bachelor of Fine Arts (BFA)">Bachelor of Fine Arts (BFA)</option>
                    <option value="Master's Degree">Master's Degree</option>

                </select>
                <label for="degree">Academic Degree:</label>
            </div>
            <div class="form-group form-floating">
                <textarea class="form-control" id="birth_place" rows="8"
                          placeholder="Place of birth" type="text" name="birth_place"
                          wire:model="birth_place" style="height: 205px"></textarea>
                <label class="col-form-label" for="birth_place">Place of Birth:</label>
                @error('birth_place') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                {{--                        <label class="col-form-label" for="age">Age:</label>--}}
                <input class="form-control input-sm" id="age"
                       placeholder="Age" type="hidden" wire:model="age" disabled >
                {{--                    @error('age') <span class="text-danger">{{ $message }}</span>@enderror--}}
            </div>
        </div>

    </div>

    <hr>

    <h4 class="mb-3">Contacts</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="contact_no"
                       placeholder="ContactNo" type="number" wire:model="contact_no">
                <label class="col-form-label" for="contact_no">Contact No.:</label>
                @error('contact_no') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            {{--                    <div class="form-group">--}}
            {{--                        <label class="col-form-label" for="degree">Educational Attainment:</label>--}}
            {{--                        <input class="form-control input-sm" id="degree"--}}
            {{--                               placeholder="Educational Attainment" type="text" wire:model="degree">--}}
            {{--                        @error('degree') <span class="text-danger">{{ $message }}</span>@enderror--}}
            {{--                    </div>--}}


            {{--                    <div class="form-group">--}}
            {{--                        <label class="col-form-label" for="term"></label>--}}
            {{--                        <input type="checkbox" id="term"> By Sign up you are agree with our--}}
            {{--                        <a href="{{route('term')}}">terms and condition</a>--}}
            {{--                    </div>--}}
            <div class="form-group form-floating">
                <form action="{{route('save-file')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card"  style="height: 208px">
                        <div class="card-header bg-info text-white text-center">
                            Upload Resume
                        </div>
                        <div class="card-body">
                            <div class="form-control">
                                <input class="form-control shadow" name="myfile" type="file"
                                       accept="application/pdf"
                                       wire:model="file_attachment" required>
                                @error('file_attachment') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-md-6">
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="street_address"
                       placeholder="Street Address:" type="text" wire:model="street_address">
                <label class="col-form-label" for="street_address">Street Address:</label>
                @error('street_address') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="city"
                       placeholder="City:" type="text" wire:model="city">
                <label class="col-form-label" for="city">City:</label>
                @error('city') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="state"
                       placeholder="State:" type="text" wire:model="state">
                <label class="col-form-label" for="state">State/province/area:</label>
                @error('state') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-floating">
                <input class="form-control input-sm" id="zipcode"
                       placeholder="Street Address:" type="text" wire:model="zipcode">
                <label class="col-form-label" for="zipcode">Zip Code:</label>
                @error('zipcode') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            {{--                        <label class="col-form-label" for="email_address">Email Address:</label>--}}
            <input class="form-control form-floating input-sm" id="email_address"
                   placeholder="" type="hidden" name="email"
                   wire:model="email_address">
            @error('email_address') <span class="text-danger">{{ $message }}</span>@enderror
            {{--                    <div class="form-group">--}}
            {{--                        <label class="col-form-label" for="address">Address:</label>--}}
            {{--                        <textarea class="form-control input-sm" id="address" rows="6"--}}
            {{--                                  placeholder="Address" type="text" wire:model="address"></textarea>--}}
            {{--                        @error('address') <span class="text-danger">{{ $message }}</span>@enderror--}}
            {{--                    </div>--}}

        </div>

    </div>
    {{--            <form action="{{route('save-file')}}" method="post" enctype="multipart/form-data">--}}
    {{--                @csrf--}}

    {{--            </form>--}}
    <div class="form-group m-3 p-3 float-end">

{{--        <a href="{{route('view-jobs')}}" class="btn btn-info float-left">--}}
{{--            <span class="icon-back"></span>--}}
{{--            &nbsp;<strong>Back</strong>--}}
{{--        </a>--}}
        <button wire:click.prevent="update()" class="btn btn-dark shadow icon-arrows-cw">Update</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger shadow  icon-cancel-circle">Cancel</button>
    </div>




</form>


