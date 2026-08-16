@extends('layouts.auth-master')

@section('content')
    <!-- Added flexbox centering to keep the form nicely contained in the middle of the screen -->
    <div class="container d-flex justify-content-center mt-5">
        <div class="w-100 text-center" style="max-width: 400px;">

            <a href="{{ route('front-page') }}">
                <img class="mb-4" src="{{ asset('assets/img/Rms.png') }}" alt="RMS Logo" width="75" height="75">
            </a>

            <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            <form action="{{ route('forget.password.post') }}" method="POST">
                @csrf

                <div class="form-floating mb-3">
                    <!-- Changed type="text" to type="email", added value="{{ old('email') }}" and is-invalid class -->
                    <input type="email" id="email_address"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email Address" name="email"
                           value="{{ old('email') }}" required autofocus>
                    <label for="email_address">Email Address</label>

                    @error('email')
                        <span class="invalid-feedback text-start" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Changed to w-100 for a cleaner block button, replacing float-end -->
                <button type="submit" class="btn btn-primary w-100 mt-2">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
@endsection
