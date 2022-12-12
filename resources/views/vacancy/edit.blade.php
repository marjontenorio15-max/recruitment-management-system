@extends('layouts.app-master')
@section('content')
<div class="container">
    <div class="card m-3 shadow">
        <div class="card-header bg-primary">
            <h2 class="text-center text-white">Edit Jobs</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="pull-right">
                    <a class="btn btn-dark shadow m-3 icon-back" href="{{ route('vacancy.index') }}"> Back</a>
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

                <form action="{{ route('vacancy.update',$vacancy->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row m-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="title" name="title" placeholder="Title"
                                       type="text" value="{{ $vacancy->title }}">
                                <label for="title">Title</label>
                            </div>
                        </div>
                        {{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--                            <div class="form-floating mb-3">--}}
                        {{--                                <input class="form-control" id="company_id" name="company_id" placeholder="Company ID"--}}
                        {{--                                       type="text" value="{{ $vacancy->company_name }}">--}}
                        {{--                                <label for="company_id">Company ID</label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="required no.">Required No. of Employee's:</label>
                                <input type="number" id="required no." name="no_of_employee" class="form-control" placeholder="Required No. of Employee's" value="{{ $vacancy->no_of_employee }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="salary">Salary:</label>
                                <input type="text" id="salary" name="salary" class="form-control" placeholder="Salary"  value="{{ $vacancy->salary }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{--                                <label for="sex">Preferred Sex:</label>--}}
                                {{--                                <input type="text" id="sex" name="sex" class="form-control" placeholder="Preferred Sex :"  value="{{ $vacancy->sex }}">--}}
                                <label for="sex">Preferred Sex:</label>
                                <select class="form-control" name="sex" id="sex">
                                    <option selected value="{{ $vacancy->sex }}">{{ $vacancy->sex }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="degree">Recommended Degree:</label>
                                <select class="form-control" name="degree" id="degree">
                                    <option selected value="{{ $vacancy->degree }}">{{ $vacancy->degree }}</option>
                                    <option value="High School Diploma">High School Diploma</option>
                                    <option value="Elementary Diploma">Elementary Diploma</option>
                                    <option value="GED">GED</option>
                                    <option value="Associate of Arts">Associate of Arts</option>
                                    <option value="Associate of Science">Associate of Science</option>
                                    <option value="Associate of Applied Science">Associate of Applied Science</option>
                                    <option value="Bachelor of Arts">Bachelor of Arts</option>
                                    <option value="Bachelor of Science">Bachelor of Science</option>
                                    <option value="BBA">BBA</option>
                                </select>
                            </div>
                        </div>
                        {{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label for="sector">Sector of Vacancy:</label>--}}
                        {{--                                <input type="text" id="sector" name="section_vacancy" class="form-control" placeholder="Sector of Vacancy"  value="{{ $vacancy->section_vacancy }}">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {{--                                <label for="work">Qualification/Work Experience:</label>--}}
                                {{--                                <input type="text" id="work" name="work_exp" class="form-control" --}}
                                {{--                                       placeholder="Qualification/Work Experience "  value="{{ $vacancy->work_exp }}">--}}
                                <label for="work_exp">Qualification/Work Experience:</label>
                                <select class="form-control" name="work_exp" id="work_exp">
                                    <option selected value="{{ $vacancy->work_exp }}">{{ $vacancy->work_exp }}</option>
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
                                <label for="job">Job Description:</label>
                                <input type="text" id="job" name="job_desc" class="form-control" placeholder="Job Description"  value="{{ $vacancy->job_desc }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Location"  value="{{ $vacancy->location }}">
                            </div>
                        </div>
                        {{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--                            <div class="form-floating mb-3">--}}
                        {{--                                <textarea class="form-control" id="location" name="location" placeholder="Job Details"--}}
                        {{--                                          style="height:300px" value="">{{ $vacancy->location }}</textarea>--}}
                        {{--                                <label for="location">Job Details</label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--                            <div class="form-floating mb-3">--}}
                        {{--                                <textarea class="form-control" id="created_by" name="created_by"--}}
                        {{--                                          placeholder="Created By">{{ $vacancy->created_by }}</textarea>--}}
                        {{--                                <label for="created_by">Created By</label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-success shadow  icon-paper-plane"> Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
