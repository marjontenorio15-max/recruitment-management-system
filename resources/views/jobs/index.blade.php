@php use App\Models\Vacancy;use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app-master')
@section('content')

    {{--     Search content--}}
    <div class="container mb-3" id="view">
        <div class="container-fluid text-center mb-5 mt-5">
            <h1>Find Your Dream Job Today</h1>
            <h5>Jobs, Employment & Future Career Opportunities</h5>
        </div>
        <form novalidate="" autocomplete="off" id="view">
            <div class="row">
                <div class="col-4">
                    <div class="form-group shadow">
                        <i class="icon-search-2"></i>
                        <input class="form-control" onkeyup="GetVacancies()" id="myInputJobTitle"
                               placeholder="Search for Job Title"
                               type="text">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group shadow">
                        <i class="icon-search-3"></i>
                        <input class="form-control" onkeyup="GetVacancies()" id="myInputCompany"
                               placeholder="Search by Company Name"
                               type="text">
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group shadow">
                        <i class="icon-location-1"></i>
                        <input class="form-control" onkeyup="GetVacancies()" id="myInputCity"
                               placeholder="Search by Location"
                               type="text">
                    </div>
                </div>

                <!-- <div class="col-3">
                    <div class="form-group shadow">
                        <i class="icon-search-2"></i>
                        <input class="form-control" onkeyup="myFunctionSearch()" id="searchAll" placeholder="Search"
                               type="text">
                    </div>
                </div> -->
            </div>
        </form>
    </div>

    {{--    <hr>--}}
    {{--    @if(auth()->check())--}}
    {{--    @else--}}
    {{--        <div class="container">--}}
    {{--            <div class="row text-center">--}}
    {{--                <div class="col-3">--}}
    {{--                    <a class="icon-search-7" style="font-size: 80px"></a>--}}
    {{--                </div>--}}
    {{--                <div class="col-6">--}}
    {{--                   <div class="btn-outline-success rounded-circle">--}}
    {{--                       <span>Applicant</span>--}}
    {{--                       <h3>Looking for work ?</h3>--}}
    {{--                       <span>(Naghahanap ng trabaho ?)</span>--}}
    {{--                   </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-3">--}}
    {{--                    <a href="{{route('register.show')}}" style="font-size: 40px">Apply now!--}}
    {{--                        <i class="icon-left"></i>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            --}}{{--                <div class="col-6">--}}
    {{--            --}}{{--                    <div class="row">--}}
    {{--            --}}{{--                        <div class="col-3">--}}
    {{--            --}}{{--                            <div class="text-center m-3">--}}
    {{--            --}}{{--                                <a class="icon-user-add-1 " style="font-size: 50px"></a>--}}
    {{--            --}}{{--                            </div>--}}
    {{--            --}}{{--                        </div>--}}
    {{--            --}}{{--                        <div class="team-item-detail-inner col-6">--}}
    {{--            --}}{{--                            <span>Employer</span>--}}
    {{--            --}}{{--                            <h3>Are you hiring applicant ?</h3>--}}
    {{--            --}}{{--                        </div>--}}
    {{--            --}}{{--                        <div class="col-3 text-center">--}}
    {{--            --}}{{--                            <div class="cols-4">--}}
    {{--            --}}{{--                                <a href="{{route('contacts')}}">Contact us now!--}}
    {{--            --}}{{--                                    <i class="icon-left"></i>--}}
    {{--            --}}{{--                                </a>--}}
    {{--            --}}{{--                            </div>--}}
    {{--            --}}{{--                        </div>--}}
    {{--            --}}{{--                    </div>--}}
    {{--            --}}{{--                </div>--}}

    {{--        </div>--}}
    {{--    @endif--}}
    {{--    <hr>--}}
    <div class="container">
        {{--         Begin Jobs--}}
        @if(session()->has('message'))
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            {{--            <div class="alert alert-info">--}}
            {{--                {{ session('message') }}--}}
            {{--            </div>--}}
            <div class="alert alert-danger d-flex alert-dismissible fade show align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="30" height="30" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill"/>
                </svg>
                <div>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-4 divJobList" style="max-height: 500px; overflow-y: auto;">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Loading...</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card" style="width: 100%; height: 100% !important;">
                    <div class="card shadow m-3 cardJobDetails">
                        <div class="card-header bg-primary text-center">
                            <h3 class="text-white">JOB DETAILS</h3>
                            <h5 class="text-white">Date Posted: <span class="spanDatePosted"></span></h5>
                        </div>
                        <div class="card-body">
                            <div class="m-3">

                                <h5 class="text-center">Title: <span class="spanTitle"></span></h5>
                                <h5>Job Details:</h5>
                                <div class="row m-3">
                                    <div class="col-6">
                                        <p><b>Required No. of Employee's: </b><span class="spanNoOfEmp"></span></p>
                                        <p><b>Salary: </b><span class="spanSalary"></span></p>
                                        <p><b>Location: </b><span class="spanLocation"></span></p>
                                        <p><b>Job Description: </b><span class="spanJobDesc"></span></p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>Preferred Sex: </b><span class="spanSex"></span></p>
                                        <p><b>Recommended Degree: </b><span class="spanDegree"></span></p>
                                        <p><b>Qualification/Work Experience: </b><span class="spanQualification"></span>
                                        </p>

                                        <input type="text" name="job_id" id="txtApplyJobId" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        @auth
                            @if(auth()->user()->role_id == 3)

                                    <div class="card-footer cardFooter" style="display: none;">
                                        <button type="button" class="btn btn-primary btnApply" style="float: right;">
                                            Apply Now
                                        </button>
                                    </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="container-fluid bg-info text-white shadow p-3">
        <div class="container">
            <div class="row text-center">
                <div class="col-3">
                    <i class="icon-search btn-primary shadow" style="font-size: 50px"></i>
                    <br>
                    <span>Register Your Account</span>
                </div>
                <div class="col-1 icon-left" style="font-size: 50px"></div>
                <div class="col-3">
                    <i class="icon-upload-1 btn-primary shadow" style="font-size: 50px"></i>
                    <br>
                    <span>Upload Your Resume</span>
                </div>
                <div class="col-1 icon-left" style="font-size: 50px"></div>
                <div class="col-4">
                    <i class="icon-check-2 btn-primary shadow" style="font-size: 50px"></i>
                    <br>
                    <span>Apply for Dream Job</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            GetVacancies();

            $(document).on('click', '.cardJob', function () {
                $('.spanTitle').html($(this).attr('title'));
                $('.spanDatePosted').html($(this).attr('created-at'));
                $('.spanNoOfEmp').html($(this).attr('no-of-employee'));
                $('.spanSalary').html($(this).attr('salary'));
                $('.spanLocation').html($(this).attr('location'));
                $('.spanJobDesc').html($(this).attr('job-desc'));
                $('.spanSex').html($(this).attr('sex'));
                $('.spanDegree').html($(this).attr('degree'));
                $('.spanQualification').html($(this).attr('work-exp'));
                $('#txtApplyJobId').val($(this).attr('job-id'));

                $('.cardFooter').show();
            });

            $('.btnApply').click(function () {
                ApplyJob();
            });
        });

        function GetVacancies() {
            var title = $('#myInputJobTitle').val();
            var createdBy = $('#myInputCompany').val();
            var location = $('#myInputCity').val();
            $.ajax({
                url: "getVacancies",
                data: {
                    title: title,
                    created_by: createdBy,
                    location: location,
                },
                beforeSend: function () {
                    var html = '<div class="card" style="width: 100%; cursor: pointer;">';
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">Loading...</h5>';
                    html += '</div>';
                    html += '</div>';
                    $('.divJobList').html(html);
                },
                success: function (result) {
                    var html = '';
                    if (result.vacancies.length > 0) {
                        for (var index = 0; index < result.vacancies.length; index++) {
                            html += '<div class="card cardJob" style="width: 100%; cursor: pointer;" ';

                            html += ' created-at="' + moment(result.vacancies[index].created_at).format('LL') + '"';
                            html += ' title="' + result.vacancies[index].title + '"';
                            html += ' created-by="' + result.vacancies[index].created_by + '"';
                            html += ' location="' + result.vacancies[index].location + '"';
                            html += ' job-desc="' + result.vacancies[index].job_desc + '"';
                            html += ' salary="' + result.vacancies[index].salary + '"';
                            html += ' sex="' + result.vacancies[index].sex + '"';
                            html += ' work-exp="' + result.vacancies[index].work_exp + '"';
                            html += ' job-id="' + result.vacancies[index].id + '"';
                            html += ' no-of-employee="' + result.vacancies[index].no_of_employee + '"';
                            html += ' degree="' + result.vacancies[index].degree + '"';
                            html += '>';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title">' + result.vacancies[index].title + '</h5>';
                            html += '<p class="card-text">' + result.vacancies[index].created_by + '</p>';
                            html += '<p class="card-text">' + result.vacancies[index].location + '</p>';
                            html += '<p class="card-text">' + moment(result.vacancies[index].created_at).fromNow() + '</p>';
                            html += '</div>';
                            html += '</div>';
                        }
                    } else {
                        html = '<div class="card" style="width: 100%; cursor: pointer;">';
                        html += '<div class="card-body">';
                        html += '<h5 class="card-title">No jobs found.</h5>';
                        html += '</div>';
                        html += '</div>';
                    }

                    $('.divJobList').html(html);
                }
            });
        }

        function ApplyJob() {
            var job_id = $('#txtApplyJobId').val();
            $.ajax({
                url: "applyJob",
                data: {
                    job_id: job_id,
                    remarks: 'Pending',
                },
                beforeSend: function () {

                },
                success: function (data) {
                    if (data.result == 1) {
                        alert('Successfully Applied!');
                    } else if (data.result == 2) {
                        alert('You have already applied on this job!');
                    } else {
                        alert('Application Failed!');
                    }
                }
            });
        }
    </script>

@endsection

