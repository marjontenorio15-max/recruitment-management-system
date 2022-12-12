@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <h2 class="text-center text-white"> Show Work Experience</h2>
            </div>
            <div class="card-body m-3">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-dark icon-back m-3" href="{{ route('job-experience.index') }}"> Back</a>
                        </div>
                    </div>
                </div>

                <div class="row m-3">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>No:</strong>
                            {{ $job_experience->id }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Job Title:</strong>
                            {{ $job_experience->job_title }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Company Name:</strong>
                            {{ $job_experience->company_name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Work Experience:</strong>
                            {{ $job_experience->period_employed }}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Responsibilities & Achievements:</strong>
                            {{ $job_experience->achievements }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
