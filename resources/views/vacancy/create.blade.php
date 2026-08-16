@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card shadow m-3">
            <div class="card-header bg-primary text-center">
                <h2 class="text-white">Add New Jobs</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        @if(in_array(auth()->user()->role_id, [1, 2]))
                            <div class="pull-right">
                                <a class="btn btn-outline-dark shadow icon-back m-3" href="{{ route('vacancy.index') }}"> Back</a><br><br>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form action="{{ route('vacancy.store') }}" method="POST">
                        @csrf

                        <div class="row m-3">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                </div>
                            </div>

{{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <strong>Company ID:</strong>--}}
{{--                                    <input class="form-control" type="number" name="company_id" placeholder="Company ID" disabled>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="no_of_employee">Required No. of Employee's:</label>
                                    <input type="number" name="no_of_employee" id="no_of_employee" class="form-control" placeholder="Required No. of Employee's">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="salary">Expected Salary:</label>
                                    <input type="text" name="salary" id="salary" class="form-control" placeholder="Salary">
                                </div>
                            </div>
{{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <strong>Duration of Employment:</strong>--}}
{{--                                    <input type="text" name="duration_employment" class="form-control" placeholder="Duration of Employment">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
{{--                                    <input type="text" name="sex" class="form-control" placeholder="Preferred Sex :">--}}
                                    <label for="sex">Preferred Sex:</label>
                                    <select class="form-control" name="sex" id="sex">
{{--                                        <option selected>Preferred Sex:</option>--}}
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Female">Male/Female</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                               <div class="form-group">
                                   <label for="degree">Recommended Academic Degree:</label>
                                   <select class="form-control" name="degree" id="degree">
{{--                                       <option value="College Diploma">College Diploma</option>--}}
                                       <option value="High School Diploma">High School Diploma</option>
                                       <option value="Elementary Diploma">Elementary Diploma</option>
                                       <option value="GED">GED</option>
                                       <option value="Associate of Arts">Associate of Arts</option>
                                       <option value="Associate of Science">Associate of Science</option>
                                       <option value="Associate of Applied Science">Associate of Applied Science</option>
                                       <option value="Bachelor of Arts">Bachelor of Arts</option>
                                       <option value="Bachelor of Science in Business Administration">Bachelor of Science in Business Administration</option>
                                       <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
                                       <option value="Bachelor of Science">Bachelor of Science</option>
                                       <option value="BBA">BBA</option>
                                   </select>
                               </div>
                            </div>
{{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <strong>Sector of Vacancy:</strong>--}}
{{--                                    <input type="text" name="section_vacancy" class="form-control" placeholder="Sector of Vacancy">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
{{--                                    <input type="text" name="work_exp" class="form-control" placeholder="Qualification/Work Experience ">--}}
                                    <label for="work_exp">Qualification/Work Experience:</label>
                                    <select class="form-control" name="work_exp" id="work_exp">
                                        <option value="With or Without Experience">With or Without Experience</option>
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="4 years">4 year</option>
                                        <option value="5 years">5 years</option>
                                        <option value="6 years">6 years</option>
                                        <option value="7 years">7 years</option>
                                        <option value="8 years">8 years</option>
                                        <option value="9 years">9 years</option>
                                        <option value="10 years">10 years</option>
                                        <option value="10+ years">10+ years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="job_desc">Job Description:</label>
                                    <input type="text" name="job_desc" id="job_desc" class="form-control" placeholder="Job Description">
                                </div>
                            </div>
{{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="recommended">Looking for atlest:</label>--}}
{{--                                    <select class="form-select" name="recommended" id="recommended" aria-label="Default select example">--}}
{{--                                        <option selected>Open this select menu</option>--}}
{{--                                        <option value="1">One</option>--}}
{{--                                        <option value="2">Two</option>--}}
{{--                                        <option value="3">Three</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="location">Location:</label>
                                    <input type="text" name="location" id="location" class="form-control" placeholder="Location">
                                </div>
                            </div>
{{--                            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <strong>Job Details:</strong>--}}
{{--                                    <textarea class="form-control" type="text" style="height:150px" name="job_details" placeholder="Enter Job Derails">--}}
{{--    Required No. of Employee's :--}}
{{--    Salary :--}}
{{--    Duration of Employment :--}}
{{--    Preferred Sex :--}}
{{--    Sector of Vacancy : yes--}}
{{--    Qualification/Work Experience :--}}

{{--    Two years Experience--}}
{{--    Job Description:--}}

{{--    We are looking for bachelor of science in Accountancy--}}
{{--    Employer :--}}

{{--    Location--}}
{{--                                </textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            {{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <strong>Created By:</strong>--}}
                            {{--                                <input class="form-control" name="created_by" placeholder="Enter Created By" value="">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-success icon-paper-plane shadow"> Submit</button>
                            </div>
                        </div>

                    </form>

            </div>
        </div>
    </div>
@endsection
