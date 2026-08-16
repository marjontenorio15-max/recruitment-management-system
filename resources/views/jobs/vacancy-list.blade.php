<table class="table table-bordered shadow bg-white" id="myTable">
    <tr class="header">

{{--        <th>No</th>--}}
        <th>Job Title</th>
        <th>Company</th>
        <th>Location</th>
{{--        <th>Preferred Sex</th>--}}
{{--        <th>Preferred Degree</th>--}}
{{--        <th>Preferred Work Experience</th>--}}
{{--        <th>Created By</th>--}}
        <th>Date Posted</th>
        <th>Action</th>
    </tr>

    @foreach ($vacancies as $key => $vacancy)
        @if($vacancy->status == 1)
            <tr>
                {{--            <td><b>{{ $loop->iteration }}</b></td>--}}
{{--                <td><b>{{ $vacancy->id }}</b></td>--}}
                <td>{{ $vacancy->title }}</td>
                <td>{{ $vacancy->created_by}}</td>
                <td>{{$vacancy->location}}</td>
                {{--                                    <td>{{$vacancy->sex}}</td>--}}
                {{--                                    <td>{{$vacancy->degree}}</td>--}}
                {{--                                    <td>{{$vacancy->work_exp}}</td>--}}
{{--                <td>{{ $vacancy->created_by }}</td>--}}
                <td>{{ date('M d, Y', strtotime($vacancy->created_at))}}</td>
                <td class="text-center">
                    <div class="btn-group">
                        @if(Auth::check())
                            @php
                                $applicants_info = DB::table('applicants')
                                ->where('applicants.applicant_id', auth()->user()->id)->get();
                                 $applicants_degree = DB::table('educational_background')
                                ->where('educational_background.applicant_id', auth()->user()->id)->get();
                                  $applicants_work_exp = DB::table('experience')
                                ->where('experience.applicant_id', auth()->user()->id)->get();
                            @endphp

                            {{--                                @if($applicants !==null)--}}
                            @if($applicants_info == '[]')
                                {{-- <a class="form-group btn btn-success icon-pencil-squared" href="{{route('applicant-application-form')}}"> Create </a>--}}
                                <button type="button" class="btn btn-success form-group shadow icon-pencil-squared"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Create Applicant Info
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl ">
                                        <div class="modal-content ">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white" id="staticBackdropLabel">Personal Information</h5>
                                                <a type="button" href="{{route('view-jobs')}}"
                                                   class="btn-close shadow"  aria-label="Close"></a>
                                            </div>
                                            <div class="modal-body">
                                                @livewire('applicants')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($applicants_degree == '[]')
                                <a  href="{{ route('educational_background.create') }}"
                                    class="btn btn-success shadow form-group icon-pencil-6 shadow">
                                    Create Education Background
                                </a>

{{--                            @elseif($applicants_work_exp == '[]')--}}
{{--                                <a  href="{{ route('job-experience.create') }}"--}}
{{--                                    class="btn btn-success form-group shadow   icon-pencil-alt-1">--}}
{{--                                    Create Work Experience--}}
{{--                                </a>--}}
                            @else
                                <a class="btn btn-success icon-doc-text shadow form-group aApplyJob" href="javascript:;" job-id="{{ $vacancy->id }}"
                                   style="font-size: medium"> Apply</a>
                            @endif

                            {{--                                <a class="btn btn-success form-control"--}}
                            {{--                                   href="{{route('register.perform', $vacancy->id)}}">Apply</a>--}}
                            {{--                                @endif--}}

                        @else
                            <a class="btn btn-primary icon-user-add shadow form-group"
                               href="{{route('register.perform', $vacancy->id)}}"
                               style="font-size: medium"> Sign-up</a>
                        @endif

                        <a class="btn btn-info icon-eye-7 form-group shadow"
                           href="{{ route('vacancy.show', $vacancy->id) }}"
                           style="font-size: medium"> View</a>
                    </div>
                </td>
            </tr>
        @else
        @endif
    @endforeach
</table>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.aApplyJob', function(){
            var jobId = $(this).attr('job-id');
            ApplyJob(jobId);
        });

        function ApplyJob(job_id) {
            $.ajax({
                url: "applyJob",
                data: {
                    job_id: job_id,
                    remarks: 'Pending',
                },
                beforeSend: function() {
                    
                },
                success: function(data){
                    if(data.result == 1) {
                        alert('Successfully Applied!');
                    }
                    else if(data.result == 2) {
                        alert('You have already applied on this job!');
                    }
                    else{
                        alert('Application Failed!');
                    }
                }
            });
        }
    });
</script>



