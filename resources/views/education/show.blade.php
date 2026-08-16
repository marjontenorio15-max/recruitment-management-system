@extends('layouts.app-master')

@section('content')

    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header bg-primary text-center">
                <h2 class="text-white"> Show Details</h2>
            </div>
            <div class="card-body">
                <a class="btn btn-outline-dark icon-back shadow" href="{{ route('educational_background.index') }}"> Back</a><br><br>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>School Name:</strong>
                            {{ $educational_background->school_name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>School Location:</strong>
                            {{ $educational_background->school_location }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Degree:</strong>
                            {{ $educational_background->degree }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Field of Study:</strong>
                            {{ $educational_background->field_of_study }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Month Graduate:</strong>
                            {{ $educational_background->month_graduate}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Year Graduate:</strong>
                            {{ $educational_background->year_graduate }}
                        </div>
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
{{--                <a class="btn btn-primary" href="{{ route('educational_background.index') }}"> Back</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Title:</strong>--}}
{{--                {{ $educational_background->title }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Description:</strong>--}}
{{--                {{ $educational_background->description }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
