switch
@extends('layouts.app-master')
@section('content')
    <div class="card p-3 m-3">

        <div class="card-header bg-info">
            <h1 class="text-center">Hi {{auth()->user()->username}}</h1>
        </div>

        <div class="card-body">
            <div class="alert alert-success alert-dismissible clearfix">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <div class="mg-alert-icon">
                    <i class="fa fa-check"></i>
                </div>
                <h3 class="mg-alert-payment">
                    <div class="alert-success">
                        Your application already submitted. Please wait for the company confirmation if
                        you are qualified to this job.
                    </div>
                </h3>
            </div>
        </div>

    </div>

@endsection
