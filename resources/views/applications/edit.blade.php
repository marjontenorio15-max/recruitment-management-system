@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header text-center bg-primary">
                <h2 class="text-white">Edit Product</h2>
            </div>
            <div class="card-body">
                <a class="btn btn-outline-dark shadow icon-back" href="{{ route('apply.index') }}"> Back</a><br><br>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('apply.update',$apply->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Job ID:</strong>
                                <input type="number" name="job_id" value="{{ $apply->job_id }}" class="form-control" placeholder="Job ID">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Applicant ID:</strong>
                                <input type="number" name="applicant_id" value="{{ $apply->applicant_id }}" class="form-control" placeholder="Applicant ID">
                            </div>
                        </div>
                        {{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
                        {{--                <div class="form-group">--}}
                        {{--                    <strong>Description:</strong>--}}
                        {{--                    <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ $apply->description }}</textarea>--}}
                        {{--                </div>--}}
                        {{--            </div>--}}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="submit" class="btn btn-outline-success shadow float-end">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2>Edit Product</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-primary" href="{{ route('apply.index') }}"> Back</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{ route('apply.update',$apply->id) }}" method="POST">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}

{{--        <div class="row">--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Job ID:</strong>--}}
{{--                    <input type="number" name="job_id" value="{{ $apply->job_id }}" class="form-control" placeholder="Job ID">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Applicant ID:</strong>--}}
{{--                    <input type="number" name="applicant_id" value="{{ $apply->applicant_id }}" class="form-control" placeholder="Applicant ID">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Description:</strong>--}}
{{--                    <textarea class="form-control" style="height:150px" name="description" placeholder="Detail">{{ $apply->description }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </form>--}}
@endsection
