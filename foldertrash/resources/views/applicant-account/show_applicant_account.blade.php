@extends('layouts.app-master')
@section('content')
    <div class="container">
        <div class="card m-3 p-3">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <a class="btn btn-primary shadow m-3" href="{{ route('company.index') }}"> Back</a>
                        <h2 class="text-center m-3"> Show Company</h2>
                    </div>

                </div>
            </div>

            <div class="row m-3 p-3">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Company ID:</strong>
                        {{ $company->company_id}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Applicant ID:</strong>
                        {{ $company->applicant_id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
