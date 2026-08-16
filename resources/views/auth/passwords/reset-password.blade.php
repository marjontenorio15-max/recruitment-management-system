@extends('layouts.auth-master')

@section('content')
    <!-- Centered flex container with restricted max-width for desktop -->
    <div class="container d-flex justify-content-center mt-5">
        <div class="w-100 text-center" style="max-width: 420px;">

            <a href="{{ route('front-page') }}">
                <img class="mb-4" src="{{ asset('assets/img/Rms.png') }}" alt="RMS Logo" width="75" height="75">
            </a>

            <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <!-- Secret token generated from reset link -->
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email Input -->
                <div class="form-floating mb-3 text-start">
                    <input type="email" id="email_address"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email Address" name="email"
                           value="{{ old('email', request()->email) }}" required autofocus>
                    <label for="email_address">Email Address</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-floating mb-3 text-start">
                    <input type="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="New Password" name="password" required>
                    <label for="password">New Password</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="form-floating mb-3 text-start">
                    <input type="password" id="password-confirm"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           placeholder="Confirm Password" name="password_confirmation" required>
                    <label for="password-confirm">Confirm Password</label>

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Full-width Submit Button -->
                <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                    Reset Password
                </button>
            </form>

        </div>
    </div>
@endsection
