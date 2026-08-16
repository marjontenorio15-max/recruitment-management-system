@php use App\Models\Applicant; @endphp
@extends('layouts.app-master')
@section('content')

    <div class="card m-3 shadow">

        @include('applicant.partials.profile')

        <div class="body p-3 m-3">
            <div class="row">
                <div class="col-3">

                    @include('applicant.partials.image-profile')

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
                                @include('media.image-form')
                            </div>
                            <br><br>
                            <div class="m-3">
                                @php
                                    $applicant_degree = DB::table('educational_background')
                                        ->where('applicant_id', auth()->user()->id)
                                        ->value('degree');

                                    $vacancies = DB::table('tbl_job_list')
                                        ->select(
                                            'tbl_job_list.id as id',
                                            'tbl_job_list.title',
                                            'tbl_job_list.location',
                                            'tbl_job_list.degree',
                                            'tbl_job_list.sex',
                                            'tbl_job_list.status',
                                            'tbl_job_list.work_exp',
                                            'tbl_job_list.salary',
                                            'tbl_job_list.created_at',
                                            'users.username as created_by',
                                            'companies.company_name'
                                        )
                                        ->leftJoin('users', 'tbl_job_list.created_by', '=', 'users.id')
                                        ->leftJoin('companies', 'tbl_job_list.company_id', '=', 'companies.company_id')
                                        ->where('tbl_job_list.status', 1)
                                        ->when($applicant_degree, function ($q, $deg) {
                                            return $q->where('tbl_job_list.degree', 'like', "%{$deg}%");
                                        })
                                        ->latest('tbl_job_list.created_at')
                                        ->paginate(5);
                                @endphp

                                @if(auth()->user()->role_id == 3 && $vacancies->count() > 0)
                                    <h3>Recommended Jobs</h3>

                                    @if(session()->has('message'))
                                        <div class="alert alert-danger d-flex alert-dismissible fade show align-items-center" role="alert">
                                            <div>
                                                {{ session('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        @include('jobs.vacancy-list')
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
                            @include('fragments.educational-background')
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

