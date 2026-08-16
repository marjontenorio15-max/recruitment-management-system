@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header bg-primary">
                <h2 class="text-center text-white"> Show Product</h2>
            </div>
            <div class="card-body">
                <a class="btn btn-outline-primary shadow icon-back" href="{{ route('apply.index') }}"> Back</a><br><br>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Job ID:</strong>
                        {{ $apply->job_id }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Applicant ID:</strong>
                        {{ $apply->applicant_id }}
                    </div>
                </div>

            </div>

        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2> Show Product</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-primary" href="{{ route('apply.index') }}"> Back</a>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Job ID:</strong>--}}
{{--                            {{ $apply->job_id }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Applicant ID:</strong>--}}
{{--                            {{ $apply->applicant_id }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Job ID:</strong>--}}
{{--                {{ $apply->job_id }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Applicant ID:</strong>--}}
{{--                {{ $apply->applicant_id }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
