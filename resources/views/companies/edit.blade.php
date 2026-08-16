@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card shadow mt-3">
            <div class="card-header bg-primary">
                <h2 class="text-center text-white">Edit Product</h2>
            </div>
                <div class="card-body">
                    <a class="btn btn-outline-dark shadow icon-back m-3 " href="{{ route('company.index') }}"> Back</a>

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

                    <form action="{{ route('company.update',$company->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
                            {{--                        <div class="form-group">--}}
                            {{--                            <strong>Company ID:</strong>--}}
                            {{--                            <input type="number" value="{{ $company->company_id}}" name="company_id" class="form-control" placeholder="Enter Company ID">--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Company Name:</strong>
                                    <input type="text" value="{{ $company->company_name}}" name="company_name" class="form-control" placeholder="Enter Company Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Address:</strong>
                                    <input type="text" value="{{ $company->address}}" name="address" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Contact Number:</strong>
                                    <input type="number" value="{{ $company->contact_no}}" name="contact_no" class="form-control" placeholder="Enter Contact Number">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-success shadow icon-check-1">Submit</button>
                            </div>
                        </div>

                    </form>


                </div>
        </div>

    </div>
{{--    <div class="container">--}}
{{--        <div class="card m-3 p-3">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12 margin-tb">--}}
{{--                    <div class="pull-left">--}}
{{--                        <a class="btn btn-primary icon-back m-3 shadow" href="{{ route('company.index') }}"> Back</a>--}}
{{--                        <h2 class="text-center">Edit Product</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <form action="{{ route('company.update',$company->id) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}

{{--                <div class="row">--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Company ID:</strong>--}}
{{--                            <input type="number" value="{{ $company->company_id}}" name="company_id" class="form-control" placeholder="Enter Company ID">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Company Name:</strong>--}}
{{--                            <input type="text" value="{{ $company->company_name}}" name="company_name" class="form-control" placeholder="Enter Company Name">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Address:</strong>--}}
{{--                            <input type="text" value="{{ $company->address}}" name="address" class="form-control" placeholder="Enter Address">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <strong>Contact Number:</strong>--}}
{{--                            <input type="number" value="{{ $company->contact_no}}" name="contact_no" class="form-control" placeholder="Enter Contact Number">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
@endsection
