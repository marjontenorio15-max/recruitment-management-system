@extends('layouts.app-master')
@section('content')
    <div class="container">

        <div class="card shadow m-3">
            <div class="card-header bg-primary text-center">
                <h3 class="text-white">JOB DETAILS</h3>
                <h5 class="text-white">Date Posted {{date_format(new DateTime($vacancy->created_at), 'F d, Y')}}</h5>
            </div>
            <div class="card-body">
                <div class="m-3">
                    @if(auth()->check())
                        @if((auth()->user()->role_id == 1) ^ (auth()->user()->role_id == 2))
                            <div class="m-3">
                                <a class="btn btn-outline-dark shadow mb-3 icon-back" href="{{ route('vacancy.index') }}"> Back</a>
                            </div>
                        @else
                            <div class="m-3">
                                <a class="btn btn-outline-dark shadow mb-3 icon-back" href="{{ route('view-jobs') }}"> Back</a>
                            </div>
                        @endif
                    @else
                        <div class="m-3">
                            <a class="btn btn-outline-dark shadow mb-3 icon-back" href="{{ route('view-jobs') }}"> Back</a>
                        </div>
                    @endif

                    <h5 class="text-center">Title:  {{ $vacancy->title }}</h5>
                    {{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <strong>Company Name:</strong>--}}
                    {{--                                    {{ $vacancy->username }}--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    <h5>Job Details:</h5>
                    <div class="row m-3">
                        <div class="col-6">
                            <p><b>Required No. of Employee's:   </b>{{$vacancy->no_of_employee}}</p>
                            <p><b>Salary:                       </b>{{$vacancy->salary}}</p>
                            <p><b>Location: </b>{{$vacancy->location}}</p>
                            <p><b>Job Description:  </b>{{$vacancy->job_desc}}</p>
                            {{--                               <p>Sector of Vacancy: {{ $vacancy->location}}</p>--}}
                        </div>
                        <div class="col-6">
                            <p><b>Preferred Sex:                </b>{{$vacancy->sex}}</p>
                            <p><b>Recommended Degree:               </b>{{$vacancy->degree}}</p>
                            <p><b>Qualification/Work Experience:    </b>{{$vacancy->work_exp}}</p>
                        </div>
                    </div>
                    {{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <strong>Created By:</strong>--}}
                    {{--                                    {{ $vacancy->created_by}}--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                </div>
            </div>
        </div>

    </div>

@endsection
