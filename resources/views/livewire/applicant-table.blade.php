@php use App\Models\Applicant; @endphp
@if(auth()->user()->role_id == 3)
    @php
        ////            $applicants = DB::table('applicants')->where('applicants.email_address', 'users.email')->get();
        //       $applicants = DB::table('applicants', 'user_name')->where('user_name', auth()->user()->username)->get();
            $applicants = DB::table('applicants')->where('applicants.applicant_id', auth()->user()->id)->get();
    @endphp
{{--@elseif((auth()->user()->role_id == 1) ^ (auth()->user()->role_id == 2))--}}
{{--    @php--}}
{{--        $applicants =DB::table('applicants')->get();--}}
{{--    @endphp--}}
@endif

@foreach($applicants as $applicant)

    <div class="table-responsive ">
        <table class="table table-striped-columns mt-3" style="width:100%">
            <thead class="text-center">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Civil Status</th>
                <th>Birth Date</th>
                <th>Birth Place</th>
                <th>Age</th>
                <th>Email Address</th>
                <th>Contact No.</th>
                <th>Degree</th>
                <th>Resume</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $applicant->first_name }}</td>
                    <td>{{ $applicant->last_name }}</td>
                    <td>{{ $applicant->middle_name }}</td>
                    <td>{{ $applicant->street_address }}, {{ $applicant->city }}, {{ $applicant->state }}, {{ $applicant->zipcode }}</td>
                    <td>{{ $applicant->sex }}</td>
                    <td>{{ $applicant->civil_status }}</td>
                    <td>{{ date('M d, Y', strtotime($applicant->birth_date)) }}</td>
                    <td>{{ $applicant->birth_place }}</td>
                    <td>{{ $applicant->age }}</td>
                    <td>{{ $applicant->email_address }}</td>
                    <td>{{ $applicant->contact_no }}</td>
                    <td>{{ $applicant->degree }}</td>
                    <td>
                        <a href="{{ url('/download/'.$applicant->file_attachment) }}" target="_blank">
                            <i class="icon-download">Resume</i>
                            {{--                                       {{ $applicant->file_attachment }}--}}
                        </a>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class=" float-end m-3">

        <!-- <i title="Edit" class="icon-edit-1 btn btn-outline-primary "
           wire:click="edit({{ $applicant->id }})">Edit Personal Information</i> -->
        <a href="{{ route('edit_applicant_account') }}" title="Edit" class="icon-edit-1 btn btn-outline-primary "
           wire:click="edit({{ $applicant->id }})">Edit Personal Information</a>
{{--        <i title="Delete" class="icon-trash-7 btn btn-outline-danger"--}}
{{--           wire:click="delete({{ $applicant->id }})"></i>--}}

    </div>
    <br><br>

@endforeach
<br>

