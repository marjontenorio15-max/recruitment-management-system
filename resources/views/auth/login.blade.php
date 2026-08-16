@extends('layouts.auth-master')

@section('content')
<!-- Corporate Header -->
<div class="text-center mb-4">
    <a href="{{ route('front-page') }}" class="d-inline-flex align-items-center gap-3 text-decoration-none mb-3">
        <svg width="56" height="56" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="shadow-sm rounded-3">
            <rect width="36" height="36" rx="8" fill="var(--ae-navy, #002855)"/>
            <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="var(--ae-red, #e31837)"/>
            <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 11L25 18L18 25" stroke="var(--ae-red, #e31837)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="text-start lh-1">
            <span class="fw-bold d-block fs-3 text-dark" style="color: var(--ae-navy) !important; letter-spacing: -0.02em;">RMS</span>
            <span class="fw-bold text-uppercase d-block mt-1" style="font-size: 0.7rem; color: var(--ae-red); letter-spacing: 0.08em;">Recruitment Portal</span>
        </div>
    </a>

    <h1 class="h4 fw-bold text-dark mb-1">Welcome Back</h1>
    <p class="text-muted small mb-0">Sign in to manage your applications & account</p>
</div>

@include('layouts.partials.messages')

<form method="POST" action="{{ route('login.perform') }}" class="text-start">
    @csrf

    <!-- Username / Email Field -->
    <div class="mb-3">
        <label for="username" class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing: 0.03em;">Email or Username</label>
        <div class="input-group-ae d-flex align-items-center">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                   placeholder="e.g. name@company.com" required autofocus autocomplete="username">
        </div>
        @if ($errors->has('username'))
            <span class="text-danger small mt-1 d-block">{{ $errors->first('username') }}</span>
        @endif
    </div>

    <!-- Password Field -->
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="password" class="form-label fw-semibold text-muted small text-uppercase mb-0" style="letter-spacing: 0.03em;">Password</label>
            <a href="{{ route('forget.password.get') }}" class="auth-link small fw-normal">Forgot?</a>
        </div>
        <div class="input-group-ae d-flex align-items-center">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password"
                   placeholder="••••••••" required autocomplete="current-password">
        </div>
        @if ($errors->has('password'))
            <span class="text-danger small mt-1 d-block">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <!-- Remember Me -->
    <div class="form-check mb-4">
        <input id="remember" class="form-check-input" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label small text-muted" for="remember">
            Keep me logged in
        </label>
    </div>

    <!-- Submit Button -->
    <button class="w-100 btn btn-ae-primary fs-6 mb-3" type="submit">
        Sign In <i class="bi bi-arrow-right ms-1"></i>
    </button>

    <!-- Footer Action -->
    <div class="text-center pt-3 border-top">
        <span class="text-muted small">Don't have an account?</span>
        <a href="{{ route('register.show') }}" class="auth-link ms-1">Create Account</a>
    </div>

    @include('auth.partials.copy')
</form>
@endsection
