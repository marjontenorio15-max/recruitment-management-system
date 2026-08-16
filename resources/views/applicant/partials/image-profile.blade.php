<div class="card shadow">

    <div>
        @php

            $image = DB::table('image')->where('image.applicant_id',auth()->user()->id)->get();
//                                     $image = DB::table('image')->get();
        @endphp
        @foreach($image as $images)
            <img class="card-img-top p-3 bg-transparent" src="{{asset("imageUpload/$images->file_path")}}"
                 alt="{{ $images->file_path }}" style="width:288px; height:300px">
            {{--                                    <img class="card-img-top" src="{{asset('imageUpload/'.$images->file_path)}}" style="width:100%">--}}
        @endforeach
    </div>
    @php
        $applicants = DB::table('applicants')->where('applicants.applicant_id', auth()->user()->id)->get();
         $data = DB::table('apply')
            ->where('apply.applicant_id', auth()->user()->id)
//            ->join('tbl_job_list', 'apply.job_id', 'tbl_job_list.id')
//            ->join('applicants', 'apply.applicant_id', 'applicants.applicant_id')
//            ->join('companies', 'tbl_job_list.company_id', 'companies.company_id')
//            ->select('apply.remarks','tbl_job_list.title', 'companies.company_name',
//            'tbl_job_list.location', 'apply.description', 'apply.id')
            ->simplePaginate(100);
    @endphp
    <div class="card-body">
        @foreach($applicants as $applicant)
            @if(auth()->user()->role_id == 3)
                <h3><b>Real Name:</b> {{$applicant->first_name}}
                    {{$applicant->middle_name}} {{$applicant->last_name}}</h3>
            @endif
        @endforeach
            @if(auth()->user()->role_id == 2)
                <h3 class="text-center">Company Name: <b>{{auth()->user()->name}}</b></h3>
            @endif
        <hr>
        @if(auth()->user()->role_id == 3)
            <a href="{{route('applicant-dashboard')}}" class="btn btn-primary icon-tasks form-control-file form-group position-relative">
                Applied Jobs

{{--                    @foreach($data as $id_val)--}}
{{--                        @if($id_val->remarks != 'Pending')--}}
{{--                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">--}}
{{--                            <span class="visually-hidden">New alerts</span>--}}
{{--    --}}{{--                        {{ $loop->iteration }}--}}
{{--                            </span>--}}
{{--                        @else--}}

{{--                        @endif--}}
{{--                    @endforeach--}}

            </a>
            <a href="{{route('account-profile')}}" class="btn btn-info form-control-file form-group icon-user">Accounts</a>
{{--            <a href="" class="btn btn-success form-control-file form-group icon-mail-1">Message</a>--}}
        @elseif(auth()->user()->role_id == 2)
            <a href="{{route('account-profile')}}" class="btn btn-info form-control-file form-group icon-user">Accounts</a>
        @else
        @endif
    </div>
</div>

