@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2 class="text-center text-white"> Show</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="pull-right m-3">
{{--                    <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer_remarks.index') }}"> Back</a>--}}
                    @if(auth()->user()->role_id == 2)
                        <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer-applicant-table-record') }}"> Back</a>
                    @elseif(auth()->user()->role_id == 3)
                        <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer-applicant-table-record') }}"> Back</a>
                    @else
                        <a class="btn btn-outline-dark shadow icon-back" href="{{ route('applicant-dashboard') }}"> Back</a>
                    @endif

                </div>


                    <div class="row m-3 p-3">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Remarks:</strong>
                                {{ $employer_remark->remarks}}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                {{ $employer_remark->description}}
                            </div>
                        </div>
                    </div>


            </div>

        </div>

    </div>
@endsection
