@extends('layouts.app-master')
@section('content')
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    @livewireStyles

    <div class="container container-fluid">
        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary">
                <span class="card-title font-weight-bolder h4 text-white">Applicant Information</span>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                @livewire('applicants')

            </div>
        </div>
    </div>

    @livewireScripts

@endsection
