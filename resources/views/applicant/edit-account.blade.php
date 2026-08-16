@extends('layouts.app-master')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header bg-info text-white text-center" style="font-size: 70px">
                <span>Profile</span>
            </div>
            <div class="body p-3 m-3">
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            @php
                                $image = DB::table('image')->select('image.name', 'image.file_path', 'users.id', 'image.applicant_id as user.id')
                                ->join('users', 'users.id', 'image.applicant_id')->get();
//                                     $image = DB::table('image')->get();
                            @endphp
                            @foreach($image as $images)
                                <img class="card-img-top" src="{{asset("imageUpload/$images->file_path")}}" alt="{{ $images->file_path }}" style="width:100%">
                                {{--                                    <img class="card-img-top" src="{{asset('imageUpload/'.$images->file_path)}}" style="width:100%">--}}
                            @endforeach
                            <div class="card-body">
                                <h4 class="card-title">Username: {{auth()->user()->username}}</h4>
                                <hr>
                                <a href="{{route('applicant-dashboard')}}" class="btn btn-primary form-control">Applied Jobs</a>
                                <a href="{{route('account-profile')}}" class="btn btn-info form-control">Accounts</a>
                                <a href="#" class="btn btn-success form-control">Message</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        @php
                            $applicants = \App\Models\Applicant::where('applicant_id', auth()->user()->id)->get();
                        @endphp
                        @foreach($applicants as $applicant)

                        <form action="{{ route('applicant.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" wire:model="applicant_id">
{{--                            <h4>Login Account</h4>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-form-label" for="user_name">User Name:</label>--}}
{{--                                        <input class="form-control input-sm" id="user_name" value="{{$applicant->user_name}}"--}}
{{--                                               placeholder="Username" type="text" wire:model="user_name">--}}
{{--                                        @error('user_name') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="col-form-label" for="password">Password:</label>--}}
{{--                                        <input class="form-control input-sm" id="password" value="{{$applicant->password  }}"--}}
{{--                                               placeholder="Password" type="password" name="password" wire:model="password" required>--}}
{{--                                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <hr>--}}

                            <h3>Personal Info</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="first_name">First Name:</label>
                                        <input class="form-control input-sm" id="id" value="{{$applicant->id}}"
                                               placeholder="ID" type="text" wire:model="id" style="display: none;">
                                        <input class="form-control input-sm" id="first_name" value="{{$applicant->first_name}}"
                                               placeholder="First Name" type="text" wire:model="first_name">
                                        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="last_name">Last Name:</label>
                                        <input class="form-control input-sm" id="last_name" value="{{$applicant->last_name}}"
                                               placeholder="Last Name" type="text" wire:model="last_name">
                                        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="middle_name">Middle Name:</label>
                                        <input class="form-control input-sm" id="middle_name" value="{{$applicant->middle_name}}"
                                               placeholder="Middle Name" type="text" wire:model="middle_name">
                                        @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="birth_date">Date of Birth:</label>
                                        <input class="form-control" id="birth_date" value="{{$applicant->birth_place}}"
                                               placeholder="Date of Birth" type="date" wire:model="birth_date">
                                        @error('birth_date') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>



                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-form-label" for="sex">Sex:</label>
                                        <select class="form-control" name="sex" id="sex" value="{{$applicant->sex}}" wire:model="sex"  required>
                                            <option selected>Select Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="age">Age:</label>
                                        <input class="form-control input-sm" id="age" value="{{$applicant->age}}"
                                               placeholder="Age" type="number"  wire:model="age">
                                        @error('age') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="birth_place">Place of Birth:</label>
                                        <textarea class="form-control" id="birth_place" rows="6" value="{{$applicant->birth_place}}"
                                                  placeholder="Place of birth" type="text" name="birth_place" wire:model="birth_place"></textarea>
                                        @error('birth_place') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                            </div>

                            <hr/>

                            <h4 class="mb-3">Contacts</h4>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-form-label" for="contact_no">Contact No.:</label>
                                        <input class="form-control input-sm" id="contact_no" value="{{$applicant->contact_no}}"
                                               placeholder="ContactNo" type="number" wire:model="contact_no">
                                        @error('contact_no') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="email_address">Email Address:</label>
                                        <input class="form-control input-sm" id="email_address" value="{{$applicant->email_address}}"
                                               placeholder="Email Address" type="email" name="email" wire:model="email_address" required>
                                        @error('email_address') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="address">Address:</label>
                                        <textarea class="form-control input-sm" id="address" rows="4" value="{{$applicant->address}}"
                                                  placeholder="Address" type="text" wire:model="address"></textarea>
                                        @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-form-label" for="civil_status">Civil Status:</label>
                                        <select class="form-control input-sm" id="civil_status" name="civil_status"
                                                value="{{$applicant->civil_status}}" wire:model="civil_status" required>
                                            <option value="none">Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Window</option>
                                        </select>
                                        @error('civil_status') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="degree">Educational Attainment:</label>
                                        <input class="form-control input-sm" id="degree" value="{{$applicant->degree}}"
                                               placeholder="Educational Attainment" type="text" wire:model="degree">
                                        @error('degree') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label" for="term"></label>
                                        <input type="checkbox" id="term"> By Sign up you are agree with our
                                        <a href="{{route('term')}}">terms and condition</a>
                                    </div>

                                </div>
                            </div>
                            {{--            <form action="{{route('save-file')}}" method="post" enctype="multipart/form-data">--}}
                            {{--                @csrf--}}
                            <div class="card">
                                <div class="card-header">
                                    File Upload
                                </div>
                                <div class="card-body">
                                    <div class="form-control">
                                        <input type="file" class="form-control shadow" name="myfile" wire:model="file_attachment" value="{{$applicant->file_attachment}}">
                                    </div>
                                </div>
                                {{--                    <div class="card-footer">--}}
                                {{--                        <button class="btn btn-primary">save</button>--}}
                                {{--                    </div>--}}
                            </div>
                            {{--            </form>--}}
                            <div class="form-group m-3 p-3">

                                {{--        <a href="{{route('view-jobs')}}" class="btn btn-info float-left">--}}
                                {{--            <span class="icon-back"></span>--}}
                                {{--            &nbsp;<strong>Back</strong>--}}
                                {{--        </a>--}}
                                <button wire:click.prevent="update()" class="btn btn-dark shadow icon-arrows-cw">Update</button>
                                <button wire:click.prevent="cancel()" class="btn btn-danger shadow  icon-cancel-circle">Cancel</button>
                            </div>




                        </form>
                        @endforeach





                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

