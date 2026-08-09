@php use App\Models\Applicant; @endphp
@extends('layouts.app-master')
@section('content')

    <div class="card m-3 shadow">

        @include('profile')

        <div class="body p-3 m-3">
            <div class="row">
                <div class="col-3">

                    @include('image-profile')

                </div>
                <div class="col-9">
                    <div class="card bg-white shadow">
                        <div class="card-header bg-info text-white">
                            <div class="m-3 text-center">
                                <h3 class="text-white">Profile</h3>
{{--                                <p>Your Last Login-in: {{date('M d, Y', strtotime(auth()->user()->updated_at))}}</p>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-3">
                                @include('image-form')
                            </div>
                            <br><br>
                            <div class="m-3">
                                @php
                                    $applicants_info = DB::table('applicants')
                                       ->where('applicants.applicant_id', auth()->user()->id)->get();
                                   $applicants_degree = DB::table('educational_background')
                                       ->where('educational_background.applicant_id', auth()->user()->id)->get();
                                   $applicants_work_exp = DB::table('experience')
                                       ->where('experience.applicant_id', auth()->user()->id)->get();
                                @endphp

                                @if(($applicants_info != '[]') AND ($applicants_degree != '[]') AND ($applicants_work_exp != '[]'))
                                    @if(auth()->user()->role_id == 3)
                                        <h3>Recommended Jobs</h3>
                                    @endif

                                    @if(session()->has('message'))
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </symbol>
                                        </svg>
                                        {{--            <div class="alert alert-info">--}}
                                        {{--                {{ session('message') }}--}}
                                        {{--            </div>--}}
                                        <div class="alert alert-danger d-flex alert-dismissible fade show align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="30" height="30" role="img" aria-label="Warning:" >
                                                <use xlink:href="#exclamation-triangle-fill"/>
                                            </svg>
                                            <div>
                                                {{ session('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        @php
                                        $vacancies = DB::table('applicants')
                                              ->where('applicants.applicant_id', auth()->user()->id)
                                              ->where('experience.applicant_id', auth()->user()->id)
                                              ->where('educational_background.applicant_id', auth()->user()->id)
                                             ->join('tbl_job_list', 'applicants.sex', 'tbl_job_list.sex')
                                             ->join('users','tbl_job_list.created_by', 'users.id')
                                             ->join('educational_background', 'tbl_job_list.degree', 'educational_background.degree')
                                              ->join('experience', 'tbl_job_list.work_exp', 'experience.period_employed')
                                             ->select('tbl_job_list.id as id', 'tbl_job_list.title', 'users.username as created_by',
                                             'tbl_job_list.location','tbl_job_list.created_at', 'tbl_job_list.degree', 'tbl_job_list.sex',
                                             'tbl_job_list.status','tbl_job_list.work_exp')
                                             ->simplePaginate(5);
                                        @endphp
{{--                                        $vacancies = DB::table('applicants')--}}
{{--                                              ->where('applicants.applicant_id', auth()->user()->id)--}}
{{--//                                              ->where('experience.applicant_id', auth()->user()->id)--}}
{{--                                              ->where('educational_background.applicant_id', auth()->user()->id)--}}
{{--                                             ->join('tbl_job_list', 'applicants.sex', 'tbl_job_list.sex')--}}
{{--                                             ->join('users','tbl_job_list.created_by', 'users.id')--}}
{{--                                             ->join('educational_background', 'tbl_job_list.degree', 'educational_background.degree')--}}
{{--//                                              ->join('experience', 'tbl_job_list.work_exp', 'experience.period_employed')--}}
{{--                                             ->select('tbl_job_list.id as id', 'tbl_job_list.title', 'users.username as created_by',--}}
{{--                                             'tbl_job_list.location','tbl_job_list.created_at', 'tbl_job_list.degree', 'tbl_job_list.sex',--}}
{{--                                             'tbl_job_list.status','tbl_job_list.work_exp')--}}
{{--                                             ->simplePaginate(5);--}}
                                        @include('view_jobs.vacancy_list')
                                    </div>
                                    <span class="float-end shadow">{!! $vacancies->links() !!}</span>
                                @endif


                            </div>


                            {{--                                @php--}}
                            {{--                                    $applicants = Applicant::where('applicants.applicant_id', Auth::user()->id)->get();--}}
                            {{--                                @endphp--}}
                            {{--                                @foreach($applicants as $applicant)--}}
                            {{--                                @endforeach--}}
                        </div>

                        @if(auth()->user()->role_id == 3)
                        <div class="card-header bg-info text-white">
                            <div class="m-3 text-center">
                                <h3 class="text-white">Personal Information</h3>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            @include('livewire.applicant-create')
                        </div>

                        <div class="card-header bg-info text-white">
                            <div class="m-3 text-center">
                                <h3 class="text-white">Educational Background</h3>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            @include('fragments.educational_background')
                        </div>

                        <div class="card-header bg-info text-white">
                            <div class="m-3 text-center">
                                <h3 class="text-white">Work Experience</h3>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            @include('fragments.work_experience')
                        </div>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
