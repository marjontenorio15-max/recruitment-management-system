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
<div class="container p-3">
       <div class="card shadow">
           <div class="card-header bg-primary">
               <h2 class="text-white text-center"> Vacancy | Jobs </h2>
           </div>
           <div class="card-body">
               <button class="btn btn-outline-success shadow icon-print float-end" type="button" value="Create PDF"
                       id="btPrint" onclick="createPDF()">Generate Report</button>
               <a class="btn btn-outline-success m-3 shadow icon-plus" href="{{ route('vacancy.create')}}">New Vacancy</a>

                @if ($message = Session::get('success'))
                   <div class="alert alert-success">
                       <p>{{ $message }}</p>
                   </div>
                @endif

             <div id="tab">
                 <table class="table table-bordered shadow">
                     <tr class="text-center">
                         <th>No</th>
                         <th>Title</th>
                         <th>Company Name</th>
                         <th>Job Location</th>
                         <th>Created By</th>
                         <th>Date Posted</th>
                         <th>Switch</th>
                         <th>Action</th>
                     </tr>
                     @foreach ($vacancies as $key => $vacancy)
                         <tr>
                             <td><b>{{ ++$i }}</b></td>
                             <td>{{ $vacancy->title }}</td>
                             <td>{{ $vacancy->company_name}}</td>
                             <td>
                                 {{--                               <p>Required No. of Employee's:  {{$vacancy->no_of_employee}}</p>--}}
                                 {{--                               <p>Salary:                      {{$vacancy->salary}}</p>--}}
                                 {{--                               <p>Preferred Sex:               {{$vacancy->sex}}</p>--}}
                                 {{--                               <p>Sector of Vacancy: {{ $vacancy->location}}</p>--}}
                                 {{--                               <p>Qualification/Work Experience: {{$vacancy->work_exp}}</p>--}}
                                 {{--                               <p>Job Description:              {{$vacancy->job_desc}}</p>--}}
                                 {{--                               <p>location:                     {{$vacancy->location}}</p>--}}
                                 {{$vacancy->location}}
                             </td>
                             <td>{{ $vacancy->created_by }}</td>
                             <td>{{date_format($vacancy->created_at, 'F d, Y')}}</td>
                             <td>

                                 @if($vacancy->status == '1')
                                    <a href="{{url('/status-update',$vacancy->id)}}" class="btn btn-success icon-switch shadow">Active</a>
                                 @else
                                    <a href="{{url('/status-update',$vacancy->id)}}" class="btn btn-danger icon-switch shadow" >Inactive</a>
                                 @endif

                             </td>
                             <td>

                                    <div class="btn-group">
                                        <a class="btn btn-outline-info shadow form-group icon-eye-7" href="{{ route('vacancy.show',$vacancy->id) }}"></a>
                                        <a class="btn btn-outline-primary shadow form-group icon-edit" href="{{ route('vacancy.edit',$vacancy->id) }}"></a>
                                        <a href="#myModal" data-toggle="modal"
                                           class="btn btn-outline-danger icon-trash-7 form-group shadow"></a>
                                    </div>


                             </td>
                         </tr>
                     @endforeach
                 </table>
             </div>
             <div class="shadow float-end">  {!! $vacancies->links() !!}</div>
           </div>
       </div>
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
                <form action="{{ route('vacancy.destroy',$vacancy->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
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


