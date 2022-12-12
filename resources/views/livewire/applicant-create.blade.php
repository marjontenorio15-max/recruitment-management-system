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

                <form action="" method="get" enctype="multipart/form-data" xmlns:wire="http://www.w3.org/1999/xhtml">

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
            <h3>Personal Information</h3>
            <input type="hidden" wire:model="app_id">

            <input type="hidden" wire:model="job_id">



            <div class="row">
{{--                {{ $vacancies->title }}--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label" for="first_name">First Name:</label>
                        <input class="form-control input-sm" id="first_name"
                               placeholder="First Name" type="text" wire:model="first_name">
                        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="middle_name">Middle Name:</label>
                        <input class="form-control input-sm" id="middle_name"
                               placeholder="Middle Name" type="text" wire:model="middle_name">
                        @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="last_name">Last Name:</label>
                        <input class="form-control input-sm" id="last_name"
                               placeholder="Last Name" type="text" wire:model="last_name">
                        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group form-floating">
                        <input class="form-control" id="birth_date"
                               placeholder="Date of Birth" type="date" wire:model="birth_date" >
                        <label for="birth_date">Date of Birth:</label>
                        @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="sex">Sex:</label>
                        <select class="form-control" name="sex" id="sex" wire:model="sex">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label" for="civil_status">Civil Status:</label>
                        <select class="form-control input-sm" id="civil_status" name="civil_status"
                                wire:model="civil_status">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widow">Widow</option>
                        </select>
                        @error('civil_status') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="degree">Academic Degree:</label>
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
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="birth_place">Place of Birth:</label>
                        <textarea class="form-control" id="birth_place" rows="8"
                                  placeholder="Place of birth" type="text" name="birth_place"
                                  wire:model="birth_place"></textarea>
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
                               placeholder="ContactNo" type="number" wire:model="contact_no">
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
                    <div class="form-group">
                        <form action="{{route('save-file')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header bg-info text-white text-center m-3">
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
                    <div class="form-group">
                        <label class="col-form-label" for="street_address">Street Address:</label>
                        <input class="form-control input-sm" id="street_address"
                               placeholder="Street Address:" type="text" wire:model="street_address">
                        @error('street_address') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="city">City:</label>
                        <input class="form-control input-sm" id="city"
                               placeholder="City:" type="text" wire:model="city">
                        @error('city') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="state">State/province/area:</label>
                        <input class="form-control input-sm" id="state"
                               placeholder="State:" type="text" wire:model="state">
                        @error('state') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="zipcode">Zip Code:</label>
                        <input class="form-control input-sm" id="zipcode"
                               placeholder="Street Address:" type="text" wire:model="zipcode">
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
                    <a type="button" href="{{route('view-jobs')}}" class="btn btn-secondary icon-cancel-circled" > Close</a>
                    <div class="form-group">
                        <a wire:click.prevent="store()" href="{{route('success')}}" type="submit"
                           class="btn btn-success float-right icon-ok shadow">
                            Submit
                        </a>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <a wire:click.prevent="store()" href="{{route('success')}}" type="submit"
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
