@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card m-3">
            <div class="card-header bg-primary">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2 class="text-center text-white">Add New Product</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="m-3">
{{--                    <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer_remarks.index') }}"> Back</a>--}}
                    <a class="btn btn-outline-dark shadow icon-back" href="{{ route('employer-applicant-table-record') }}"> Back</a>
                </div>
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

                <form action="{{ route('employer_remarks.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="applicant_id">Applicant_ID:</label>
                                <input type="number" id="applicant_id" name="applicant_id" class="form-control" placeholder="Applicant Id">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="remarks">Remarks:</label>
                                <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Remarks">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-success shadow icon-ok">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
