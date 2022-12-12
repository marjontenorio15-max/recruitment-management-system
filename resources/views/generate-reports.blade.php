@extends('layouts.app-master')
@section('content')

    <div class="container-fluid">
        <div class="card m-3 shadow">
            <div class="card-header bg-primary">
                <button class="btn btn-success shadow icon-print float-end" type="button" value="Create PDF"
                        id="btPrint" onclick="createPDF()"> Generate Report</button>
            </div>
            <div class="card-body">
                <div id="tab">
                    <h3>List of Applicant</h3>
                    <table class="table table-bordered shadow">
                        <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Job Title</th>
                            <th>Email Address</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Company</th>
                            <th>Degree</th>
                            <th>Date Applied</th>
                            <th>Status|Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                      @if(auth()->user()->role_id == 2)
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
                                      'applicants.first_name', 'applicants.last_name', 'applicants.middle_name',
                                      'applicants.email_address', 'applicants.contact_no',
                                      'street_address', 'city', 'state', 'zipcode', 'applicants.degree')
                                     ->simplePaginate(10);

                          @endphp
                      @elseif(auth()->user()->role_id == 1)
                          @php
                              ////            $applicants = DB::table('applicants')->where('applicants.email_address', 'users.email')->get();
                              //       $applicants = DB::table('applicants', 'user_name')->where('user_name', auth()->user()->username)->get();
                             $applicants = DB::table('apply')
//                                     ->where('tbl_job_list.company_id', auth()->user()->id)
                                     ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
                                     ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
                                     ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
                                     ->select('apply.remarks', 'apply.id', 'applicants.file_attachment',
                                     'apply.created_at', 'tbl_job_list.title', 'companies.company_name',
                                      'applicants.first_name', 'applicants.last_name', 'applicants.middle_name',
                                      'applicants.email_address', 'applicants.contact_no',
                                      'street_address', 'city', 'state', 'zipcode', 'applicants.degree')
                                     ->simplePaginate(10);

                          @endphp
                      @endif
                        @foreach($applicants as $applicant)
                            <tr>
                                <td>{{ $applicant->first_name}} {{ $applicant->middle_name}} {{ $applicant->last_name}}</td>
                                <td>{{ $applicant->title }}</td>
                                <td>{{$applicant->email_address}}</td>
                                <td>{{$applicant->contact_no}}</td>

                                <td>{{$applicant->street_address}}, {{$applicant->city}}, {{$applicant->state}}, {{$applicant->zipcode}} </td>

                                <td>{{ $applicant->company_name }}</td>
                                <td>{{$applicant->degree}}</td>
                                <td>{{ $applicant->created_at }}</td>
                                <td> {{ $applicant->remarks }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                   <div class="float-end">
                       {!! $applicants->links() !!}
                   </div>
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
