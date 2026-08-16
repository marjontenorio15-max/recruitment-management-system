@extends('layouts.auth-master')

@section('content')
    <div class="container text-center">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <a href="{{route('front-page')}}"><img class="mb-4" src="{{asset('assets/img/Rms.png')}}" alt="" width="75" height="75"></a>

        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <form action="{{ route('forget.password.post') }}" method="POST">
            @csrf
            <div class="form-group form-floating">
                <input type="text" id="email_address" class="form-control" placeholder="Email Address" name="email" required autofocus>
                <label for="email_address">Email Address</label>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary float-end">
                Send Password Reset Link
            </button>
        </form>

    </div>
@endsection
