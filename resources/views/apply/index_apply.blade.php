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
    <div class="container">
        <div class="card m-3 shadow" >
            <div class="card-header bg-primary">
                <h2 class="text-center text-white">List of Applicants | APPLY</h2>
            </div>
            <div class="card-body pull-right">
{{--                <a class="btn btn-outline-success shadow icon-plus-6" href="{{ route('apply.create') }}"> ADD</a>--}}
                <button class="btn btn-outline-success shadow icon-print float-end" type="button" value="Create PDF"
                        id="btPrint" onclick="createPDF()"> Generate Report</button>
            </div>
          <div class="row m-3" id="tab">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                      <p>{{ $message }}</p>
                  </div>
              @endif
              <table class="table table-bordered shadow">
                  <tr>
                      <th>No</th>
                      <th>Applicant Name</th>
                      <th>Job Title</th>
                      <th>Company</th>
                      <th>Date Applied</th>
                      <th>Download Resume</th>
                      <th>Status | Remarks</th>
{{--                      <th>Description</th>--}}
                      <th>Action</th>
                  </tr>
                  @foreach ($data as $key => $value)
                      <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $value->first_name}} {{ $value->middle_name}} {{ $value->last_name}}</td>
                          <td>{{ $value->title }}</td>
                          <td>{{ $value->company_name }}</td>
                          <td>{{ $value->created_at }}</td>
                          <td>
                              <a href="{{ url('/download/'.$value->file_attachment) }}">
                                  <i class="icon-download">Resume</i>
                                  {{--                                       {{ $applicant->file_attachment }}--}}
                              </a>
                          </td>
                          <td> {{ $value->remarks }}</td>
                          {{--                <td>{{ \Str::limit($value->description, 100) }}</td>--}}
{{--                          <td>--}}
{{--                              <form action="{{ route('apply.destroy',$value->id) }}" method="POST">--}}
{{--                                 <div class="btn-group">--}}
{{--                                     <a class="btn btn-outline-info shadow icon-eye-7" href="{{ route('apply.show',$value->id) }}"></a>--}}
{{--                                     <a class="btn btn-outline-primary shadow icon-edit" href="{{ route('apply.edit',$value->id) }}"></a>--}}
{{--                                     @csrf--}}
{{--                                     @method('DELETE')--}}
{{--                                     <button type="submit" class="btn btn-outline-danger shadow icon-trash"></button>--}}
{{--                                 </div>--}}
{{--                              </form>--}}
{{--                          </td>--}}
{{--                          <td> {{ $value->description }}</td>--}}
                          <td>
                              <div class="btn-group">
                                  {{--                                       <a href="{{ url('edit', $applicant->id)}}"><i title="Edit" class="icon-edit-1 btn btn-outline-primary btn-sm"--}}
                                  {{--                                           ></i></a>--}}
                                  <a href="{{ route('employer_remarks.show', $value->id)}}" class="icon-eye btn btn-outline-primary shadow"></a>
                                  <a href="{{ route('employer_remarks.edit', $value->id)}}" class="icon-edit-1 btn btn-outline-primary shadow"></a>
                                  {{--                                       <a href="{{ route('employer_remarks.destroy', $applicant->id)}}"><i title="Delete" class="icon-trash-7 btn btn-outline-danger shadow btn-sm"--}}
                                  {{--                                           ></i></a>--}}
                                  <!-- Button HTML (to Trigger Modal) -->
                                  <a href="#myModal" data-toggle="modal" class="btn btn-outline-danger icon-trash-7 shadow"></a>
                              </div>
                                  <!-- Modal HTML -->
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
                                              <form action="{{ route('employer_remarks.destroy', $value->id) }}" method="POST">
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
              </table>
              <div class="float-end">
                  {!! $data->links() !!}
              </div>
          </div>
        </div>

    </div>
{{--    <div class="row" style="margin-top: 5rem;">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2>Apply</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-success" href="{{ route('apply.create') }}"> Create New Post</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @if ($message = Session::get('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            <p>{{ $message }}</p>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <table class="table table-bordered">--}}
{{--        <tr>--}}
{{--            <th>No</th>--}}
{{--            <th>Job ID</th>--}}
{{--            <th>Applicant ID</th>--}}
{{--            <th>Action</th>--}}
{{--        </tr>--}}
{{--        @foreach ($data as $key => $value)--}}
{{--            <tr>--}}
{{--                <td>{{ ++$i }}</td>--}}
{{--                <td>{{ $value->job_id }}</td>--}}
{{--                <td>{{ $value->applicant_id }}</td>--}}
{{--                <td>{{ \Str::limit($value->description, 100) }}</td>--}}
{{--                <td>--}}
{{--                    <form action="{{ route('apply.destroy',$value->id) }}" method="POST">--}}
{{--                        <a class="btn btn-info" href="{{ route('apply.show',$value->id) }}">Show</a>--}}
{{--                        <a class="btn btn-primary" href="{{ route('apply.edit',$value->id) }}">Edit</a>--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--    </table>--}}
{{--    {!! $data->links() !!}--}}
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
