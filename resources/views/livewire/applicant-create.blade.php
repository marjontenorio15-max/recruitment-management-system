@php use App\Models\Applicant; @endphp
{{--@extends('layouts.app-master')--}}
{{--@section('content')--}}
{{--<link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">--}}
{{--<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">--}}
{{--<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<div class="container container-fluid">--}}
{{--    <div class="card mt-5 mb-5">--}}
{{--        <div class="card-header bg-primary">--}}
{{--            <span class="card-title font-weight-bolder h4 text-white">Applicant Information</span>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            @if (session()->has('message'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    {{ session('message') }}--}}
{{--                </div>--}}
{{--            @endif--}}

                <form class="frmEditProfile" action="" method="post" enctype="multipart/form-data" xmlns:wire="http://www.w3.org/1999/xhtml">
                    @csrf
{{--        <h4>Login Account</h4>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}

{{--                <div class="form-group">--}}
{{--                    <label class="col-form-label" for="user_name">User Name:</label>--}}
{{--                    <input class="form-control input-sm" id="user_name"--}}
{{--                           placeholder="Username" type="text" value="{{auth()->user()->username}}" wire:model="user_name">--}}
{{--                    @error('user_name') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="form-group">--}}
{{--                    <label class="col-form-label" for="password">Password:</label>--}}
{{--                    <input class="form-control input-sm" id="password"--}}
{{--                           placeholder="Password" type="password" name="password"--}}
{{--                           value="{{auth()->user()->password}}" wire:model="password" >--}}
{{--                    @error('password') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <hr>--}}

{{--    {{ $_GET['jobs_id'] }}--}}
{{--    {{$applicants->jobs_id}}--}}
    @csrf

{{--    @foreach($vacancy as $vacancies)--}}
{{--{{$applicants->id}}--}}
        <div>
            <!-- <h3>Personal Information</h3> -->
            <input type="hidden" wire:model="app_id">

            <input type="hidden" wire:model="job_id">


            @php
                $applicants_info = DB::table('applicants')
                   ->where('applicants.applicant_id', auth()->user()->id)->first();
            @endphp

            <div class="row">
{{--                {{ $vacancies->title }}--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label" for="first_name">First Name:</label>
                        <input class="form-control input-sm" id="first_name"
                               placeholder="First Name" type="text" wire:model="first_name" name="first_name" value="{{ $applicants_info->first_name }}">
                        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="middle_name">Middle Name:</label>
                        <input class="form-control input-sm" id="middle_name"
                               placeholder="Middle Name" type="text" wire:model="middle_name" name="middle_name" value="{{ $applicants_info->middle_name }}">
                        @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="last_name">Last Name:</label>
                        <input class="form-control input-sm" id="last_name"
                               placeholder="Last Name" type="text" wire:model="last_name" name="last_name" value="{{ $applicants_info->last_name }}">
                        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group form-floating">
                        <input class="form-control" id="birth_date"
                               placeholder="Date of Birth" type="date" readonly="true" value="{{ $applicants_info->birth_date }}">
                        <label for="birth_date">Date of Birth:</label>
                        @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label" for="sex">Sex:</label>
                        <select class="form-control" name="sex" id="sex" wire:model="sex">
                            @if($applicants_info->sex == "Male")
                                <option value="Male" selected>Male</option>
                            @else
                                <option value="Male">Male</option>
                            @endif
                            @if($applicants_info->sex == "Female")
                                <option value="Female" selected>Female</option>
                            @else
                                <option value="Female">Female</option>
                            @endif
                        </select>
                        @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="civil_status">Civil Status:</label>
                        <select class="form-control input-sm" id="civil_status" name="civil_status"
                                wire:model="civil_status" value="{{ $applicants_info->civil_status }}">
                            @if($applicants_info->civil_status == "Single")
                                <option value="Single" selected>Single</option>
                            @else
                                <option value="Single">Single</option>
                            @endif
                            @if($applicants_info->civil_status == "Married")
                                <option value="Married" selected>Married</option>
                            @else
                                <option value="Married">Married</option>
                            @endif
                            @if($applicants_info->civil_status == "Widow")
                                <option value="Widow" selected>Widow</option>
                            @else
                                <option value="Widow">Widow</option>
                            @endif
                        </select>
                        @error('civil_status') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="degree">Academic Degree:</label>
                        <select class="form-control" name="degree" id="degree" wire:model="degree">
                            @if($applicants_info->degree == "Elementary Diploma")
                                <option value="Elementary Diploma" selected>Elementary Diploma</option>
                            @else
                                <option value="Elementary Diploma">Elementary Diploma</option>
                            @endif
                            @if($applicants_info->degree == "High School Diploma")
                                <option value="High School Diploma" selected>High School Diploma</option>
                            @else
                                <option value="High School Diploma">High School Diploma</option>
                            @endif
                            @if($applicants_info->degree == "Associate of Applied Science (AAS)")
                                <option value="Associate of Applied Science (AAS)" selected>Associate of Applied Science (AAS)</option>
                            @else
                                <option value="Associate of Applied Science (AAS)">Associate of Applied Science (AAS)</option>
                            @endif
                            @if($applicants_info->degree == "Associate of Arts (AA)")
                                <option value="Associate of Arts (AA)" selected>Associate of Arts (AA)</option>
                            @else
                                <option value="Associate of Arts (AA)">Associate of Arts (AA)</option>
                            @endif
                            @if($applicants_info->degree == "Associate of Science (AS)")
                                <option value="Associate of Science (AS)" selected>Associate of Science (AS)</option>
                            @else
                                <option value="Associate of Science (AS)">Associate of Science (AS)</option>
                            @endif
                            @if($applicants_info->degree == "Bachelor of Applied Science (BAS)")
                                <option value="Bachelor of Applied Science (BAS)" selected>Bachelor of Applied Science (BAS)</option>
                            @else
                                <option value="Bachelor of Applied Science (BAS)">Bachelor of Applied Science (BAS)</option>
                            @endif
                            @if($applicants_info->degree == "Bachelor of Architecture (B.Arch.)")
                                <option value="Bachelor of Architecture (B.Arch.)" selected>Bachelor of Architecture (B.Arch.)</option>
                            @else
                                <option value="Bachelor of Architecture (B.Arch.)">Bachelor of Architecture (B.Arch.)</option>
                            @endif
                            @if($applicants_info->degree == "Bachelor of Science (BS)")
                                <option value="Bachelor of Science (BS)" selected>Bachelor of Science (BS)</option>
                            @else
                                <option value="Bachelor of Science (BS)">Bachelor of Science (BS)</option>
                            @endif
                            @if($applicants_info->degree == "Bachelor of Business Administration (BBA)")
                                <option value="Bachelor of Business Administration (BBA)" selected>Bachelor of Business Administration (BBA)</option>
                            @else
                                <option value="Bachelor of Business Administration (BBA)">Bachelor of Business Administration (BBA)</option>
                            @endif
                            @if($applicants_info->degree == "Bachelor of Fine Arts (BFA)")
                                <option value="Bachelor of Fine Arts (BFA)" selected>Bachelor of Fine Arts (BFA)</option>
                            @else
                                <option value="Bachelor of Fine Arts (BFA)">Bachelor of Fine Arts (BFA)</option>
                            @endif
                            @if($applicants_info->degree == "Master's Degree")
                                <option value="Master's Degree" selected>Master's Degree</option>
                            @else
                                <option value="Master's Degree">Master's Degree</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="birth_place">Place of Birth:</label>
                        <textarea class="form-control" id="birth_place" rows="2"
                                  placeholder="Place of birth" type="text" name="birth_place"
                                  wire:model="birth_place">{{ $applicants_info->birth_place }}</textarea>
                        @error('birth_place') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <label class="col-form-label" for="contact_no">Contact No.:</label>
                        <input class="form-control input-sm" id="contact_no"
                               placeholder="ContactNo" type="number" wire:model="contact_no" name="contact_no" value="{{ $applicants_info->contact_no }}">
                        @error('contact_no') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <label class="col-form-label" for="degree">Educational Attainment:</label>--}}
                    {{--                        <input class="form-control input-sm" id="degree"--}}
                    {{--                               placeholder="Educational Attainment" type="text" wire:model="degree" name="degree">--}}
                    {{--                        @error('degree') <span class="text-danger">{{ $message }}</span>@enderror--}}
                    {{--                    </div>--}}


                    {{--                    <div class="form-group">--}}
                    {{--                        <label class="col-form-label" for="term"></label>--}}
                    {{--                        <input type="checkbox" id="term"> By Sign up you are agree with our--}}
                    {{--                        <a href="{{route('term')}}">terms and condition</a>--}}
                    {{--                    </div>--}}
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header bg-info text-white text-center m-3">
                                Upload Resume
                            </div>
                            <div class="card-body">
                                <div class="form-control">
                                    <input class="form-control shadow" name="myfile" type="file"
                                           accept="application/pdf"
                                           wire:model="file_attachment">
                                    @error('file_attachment') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <br>
                                @if($applicants_info?->file_attachment != null)
                                    <a href='<?php echo asset("storage/uploads/{$applicants_info->file_attachment}")?>' target="_blank" style="color: blue;"><span class="icon-download"></span> Uploaded Resume</a>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label" for="street_address">Street Address:</label>
                        <input class="form-control input-sm" id="street_address"
                               placeholder="Street Address:" type="text" wire:model="street_address" name="street_address" value="{{ $applicants_info?->address ?? '' }}">
                        @error('street_address') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="city">City:</label>
                        <input class="form-control input-sm" id="city"
                               placeholder="City:" type="text" wire:model="city" name="city" value="{{ $applicants_info?->city ?? '' }}">
                        @error('city') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="state">State/province/area:</label>
                        <input class="form-control input-sm" id="state"
                               placeholder="State:" type="text" wire:model="state" name="state" value="{{ $applicants_info?->state ?? '' }}">
                        @error('state') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="zipcode">Zip Code:</label>
                        <input class="form-control input-sm" id="zipcode"
                               placeholder="Street Address:" type="text" wire:model="zipcode" name="zipcode" value="{{ $applicants_info?->zipcode ?? '' }}">
                        @error('zipcode') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    {{--                        <label class="col-form-label" for="email_address">Email Address:</label>--}}
                    <input class="form-control input-sm" id="email_address"
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
            @if(auth()->user()->role_id == 3)
                <div class="modal-footer">
<!--                     <a type="button" href="{{route('view-jobs')}}" class="btn btn-secondary icon-cancel-circled" > Close</a> -->
                    <div class="form-group">
                        <!-- <a wire:click.prevent="store()" href="{{route('success')}}" type="submit"
                           class="btn btn-success float-right icon-ok shadow">
                            Submit
                        </a> -->
                        <button type="submit"
                           class="btn btn-success float-right icon-ok shadow">
                            Submit
                        </button>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <a wire:click.prevent="store()"  type="submit"
                       class="btn btn-success float-right icon-ok shadow">
                        Submit
                    </a>
                    {{--                <a wire:click.prevent="store()" type="submit"--}}
                    {{--                   class="btn btn-success float-right icon-ok shadow">--}}
                    {{--                    Submit--}}
                    {{--                </a>--}}
                </div>
            @endif

        </div>
{{--    @endforeach--}}
</form>

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
