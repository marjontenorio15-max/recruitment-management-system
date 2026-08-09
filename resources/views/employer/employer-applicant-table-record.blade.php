@extends('layouts.app-master')
@section('content')
    <style>

        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }
        .modal-confirm .modal-footer a {
            color: #999;
        }
        .modal-confirm .icons-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icons-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn, .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }
        .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
   <div class="container">
      <div class="card m-3 shadow">
          @php use App\Models\Applicant; @endphp
          @auth()
              @if((auth()->user()->role_id == '2' )^(auth()->user()->role_id == '1' ))
                 <div class="card-header bg-primary">
                     <div class="m-3">
                         <h2 class="text-center text-white">List of Applicants</h2>
                     </div>
                 </div>
                  <div class="card-body m-3">
                      <div class="form-group shadow">
                          <i class="icon-search-2"></i>
                          <input class="form-control" onkeyup="myFunctionSearch()" id="searchAll" placeholder="Search"
                                 type="text">
                      </div>
{{--                      <button class="btn btn-outline-success icon-print float-end" type="button" value="Create PDF"--}}
{{--                              id="btPrint" onclick="createPDF()">Generate Report</button>--}}
                      <div id="tab">
                          <table class="table table-bordered shadow" style="width:100%" id="myTable">
                              <thead class="text-center">
                              <tr>
                                  <th>Applicant Name</th>
                                  <th>Job Title</th>
                                  <th>Company</th>
                                  <th>Date Applied</th>
                                  <th>Download Resume</th>
                                  <th>Status | Remarks</th>
                                  <th>Description</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @php
                                  ////            $applicants = DB::table('applicants')->where('applicants.email_address', 'users.email')->get();
                                  //       $applicants = DB::table('applicants', 'user_name')->where('user_name', auth()->user()->username)->get();
                                 $applicants = DB::table('apply')
                                         ->where('tbl_job_list.company_id', auth()->user()->id)
                                         ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                         ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                                         ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                                         ->select('apply.remarks', 'apply.id', 'applicants.file_attachment',
                                         'apply.created_at', 'tbl_job_list.title', 'companies.company_name',
                                       'applicants.first_name', 'applicants.last_name', 'applicants.middle_name', 'apply.description')
                                       -> orderBy('apply.created_at', 'desc')->simplePaginate(5);

                              @endphp
                              @foreach($applicants as $applicant)
                                  <tr>
                                      <td>{{ $applicant->first_name}} {{ $applicant->middle_name}} {{ $applicant->last_name}}</td>
                                      <td>{{ $applicant->title }}</td>
                                      <td>{{ $applicant->company_name }}</td>
                                      <td>{{ $applicant->created_at }}</td>
                                      <td>
                                          @if($applicant->file_attachment != null)
                                            <a href="<?php echo asset("storage/uploads/$applicant->file_attachment")?>" target="_blank">
                                                <i class="icon-download">Resume</i>
                                                {{--                                       {{ $applicant->file_attachment }}--}}
                                            </a>
                                          @else
                                            N/A
                                          @endif
                                      </td>
                                      <td> {{ $applicant->remarks }}</td>
                                      <td> {{ $applicant->description }}</td>
                                      <td>
                                          <div class="btn-group">
                                              {{--                                       <a href="{{ url('edit', $applicant->id)}}"><i title="Edit" class="icon-edit-1 btn btn-outline-primary btn-sm"--}}
                                              {{--                                           ></i></a>--}}
{{--                                              <a href="{{ route('employer_remarks.show', $applicant->id)}}" class="icon-eye btn btn-outline-primary shadow "></a>--}}
                                              <a href="{{ route('employer_remarks.edit', $applicant->id)}}" class="icon-edit-1 btn btn-outline-primary shadow "></a>
                                              {{--                                       <a href="{{ route('employer_remarks.destroy', $applicant->id)}}"><i title="Delete" class="icon-trash-7 btn btn-outline-danger shadow btn-sm"--}}
                                              {{--                                           ></i></a>--}}
                                              <a href="#myModal" data-toggle="modal"
                                                 class="btn btn-outline-danger icon-trash-7 shadow"></a>
                                          </div>

                                          <div id="myModal" class="modal fade">
                                              <div class="modal-dialog modal-confirm">
                                                  <div class="modal-content">
                                                      <div class="modal-header flex-column">
                                                          <div class="icons-box">
                                                              <i class=" icon-cancel-1"></i>
                                                          </div>
                                                          <h4 class="modal-title w-100">Are you sure?</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Do you really want to delete these records? This process cannot be undone.</p>
                                                      </div>
                                                      <div class="modal-footer justify-content-center">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                          <form action="{{ route('employer_remarks.destroy', $applicant->id) }}" method="POST">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" class="btn btn-danger">Delete</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>

                      </div>
                      <span class="float-end shadow">{!! $applicants->links() !!}</span>
                  </div>
              @endif
          @endauth
      </div>
   </div>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/search.js')}}"></script>
@endsection
<script>
    function createPDF() {
        var sTable = document.getElementById('tab').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
</script>

