@php use App\Models\Vacancy; @endphp
@extends('layouts.app-master')
@section('content')
  <div class="container-fluid">
      <div class="card m-3 bg-light">

          @include('applicant.partials.profile')

          <div class="card-body">
              <div class="row bg-light">
                  <div class="col-3">
                      @include('applicant.partials.image-profile')
                  </div>
                  <div class="col-9">
                      <div class="card shadow">
                          <div class="card-header bg-info">
                              <h3 class="text-center text-white">Applied Jobs</h3>
                          </div>
                          <div class="card-body">
                              <div class="container">
                                  <div class="row">
                                      <div class="col-4"></div>
                                      <div class="col-4">

                                          <form action="" method="get">
                                              <label for="myInput">Status</label>
                                              <select id="myInput" onchange="myFunction()" class='form-control'>
                                                  <option value="" selected="selected">All</option>
                                                  <option>Pending</option>
                                                  <option>Hired</option>
                                                  <option>For Interview</option>
                                                  <option>Reject</option>
                                              </select>
                                          </form>

                                      </div>
                                      <div class="col-4">
                                          <div class="form-group shadow">
                                              <i class="icon-search-2"></i>
                                              <input class="form-control" onkeyup="myFunction()" id="myInput" placeholder="Search"
                                                     type="text">

                                          </div>
                                      </div>
                                  </div>
                                  @php

                                      //                                $data = Vacancy::select('tbl_job_list.id as id','title',
                                      //                                        'job_details', 'users.username as created_by')->
                                      //                                        leftJoin('users', 'users.id', '=', 'tbl_job_list.created_by')->
                                      ////                                        leftJoin('applicants', 'applicants.applicant_id', '=', '')->
                                      //                                        orderBy('tbl_job_list.created_by')->simplePaginate(5);
                                        $data = DB::table('apply')
                                            ->where('apply.applicant_id', auth()->user()->id)
                                            ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                                             ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                            ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                                            ->select('apply.remarks as remarks','tbl_job_list.title as title', 'companies.company_name',
                                            'tbl_job_list.location', 'apply.description', 'apply.id')
                                            ->orderBy('apply.created_at', 'desc')
                                            ->simplePaginate(10);
                                  @endphp

                                  <table class="table table-bordered shadow" id="myTable">
                                      <tr class="header">
                                          <th>Job title</th>
                                          <th>Company</th>
                                          <th>Location</th>
                                          <th>Status</th>
                                          <th>Description</th>
{{--                                          <th>Action</th>--}}
                                      </tr>

                                      @foreach ($data as $applicant)
                                          <tr>
                                              <td>{{$applicant->title}}</td>
                                              <td>{{$applicant->company_name}}</td>
                                              <td>{{$applicant->location}}</td>
                                              <td>
                                                  {{$applicant->remarks}}
                                              </td>
                                              <td>
                                                  {{$applicant->description}}
                                              </td>
{{--                                                <td>--}}
{{--                                                    <a class="btn btn-info icon-eye shadow" href="{{ route('employer_remarks.show', $applicant->id) }}">Show</a>--}}
{{--                                                </td>--}}

                                          </tr>
                                      @endforeach

                                  </table>
                              </div>
                              <span class="float-end shadow">{!! $data->links() !!}</span>
                          </div>
                      </div>
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
            // for (i = 0; i < tr.length; i++) {
            //     td = tsr[i].getElementsByTagName("td")[0];
            //     if (td) {
            //         txtValue = td.textContent || td.innerText;
            //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //             tr[i].style.display = "";
            //         } else {
            //             tr[i].style.display = "none";
            //
            //         }
            //     }
            // }
            for (i = 1; i < tr.length; i++) {
                // Hide the row initially.
                tr[i].style.display = "none";

                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    cell = tr[i].getElementsByTagName("td")[j];
                    if (cell) {
                        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

    </script>

@endsection
