@extends('layouts.auth-master')

@section('content')
<!-- Corporate Header & Brand -->
<div class="text-center mb-4">
    <a href="{{ route('front-page') }}" class="d-inline-flex align-items-center gap-3 text-decoration-none mb-3 group" style="transition: transform 0.25s ease;">
        <div class="position-relative d-inline-block">
            <svg width="52" height="52" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="shadow-sm rounded-3" style="transition: transform 0.3s ease;">
                <rect width="36" height="36" rx="8" fill="var(--ae-navy, #0f172a)"/>
                <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="var(--ae-red, #e31837)"/>
                <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18 11L25 18L18 25" stroke="var(--ae-red, #e31837)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="text-start lh-1">
            <span class="fw-bold d-block fs-3 text-dark" style="color: var(--ae-navy, #0f172a) !important; letter-spacing: -0.03em;">RMS</span>
            <span class="fw-bold text-uppercase d-block mt-1" style="font-size: 0.68rem; color: var(--ae-red, #e31837); letter-spacing: 0.1em;">Recruitment Portal</span>
        </div>
    </a>

    <div class="mt-1">
        <h1 class="h4 fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">Welcome Back</h1>
        <p class="text-muted small mb-0">Sign in to manage your career applications & account</p>
    </div>
</div>

@include('layouts.partials.messages')

<form method="POST" action="{{ route('login.perform') }}" class="text-start">
    @csrf

    <!-- Username / Email Field -->
    <div class="mb-3">
        <label for="username" class="form-label fw-semibold text-muted small text-uppercase mb-1.5 d-flex align-items-center justify-content-between" style="font-size: 0.72rem; letter-spacing: 0.05em;">
            <span>Email or Username</span>
            <span class="text-secondary opacity-75" style="font-size: 0.68rem; text-transform: none;"><i class="bi bi-shield-check me-1"></i>Secure Login</span>
        </label>
        <div class="input-group-ae d-flex align-items-center position-relative">
            <span class="input-group-text text-muted ps-3 pe-2"><i class="bi bi-envelope fs-6 text-slate-400"></i></span>
            <input id="username" type="text" class="form-control ps-1 pe-3" name="username" value="{{ old('username') }}"
                   placeholder="e.g. name@company.com or username" required autofocus autocomplete="username">
        </div>
        @if ($errors->has('username'))
            <div class="text-danger small mt-1.5 d-flex align-items-center gap-1.5" style="font-size: 0.8rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first('username') }}</span>
            </div>
        @endif
    </div>

    <!-- Password Field -->
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1.5">
            <label for="password" class="form-label fw-semibold text-muted small text-uppercase mb-0" style="font-size: 0.72rem; letter-spacing: 0.05em;">Password</label>
            <a href="{{ route('forget.password.get') }}" class="auth-link small fw-medium" style="font-size: 0.78rem;">Forgot password?</a>
        </div>
        <div class="input-group-ae d-flex align-items-center position-relative">
            <span class="input-group-text text-muted ps-3 pe-2"><i class="bi bi-lock fs-6 text-slate-400"></i></span>
            <input id="password" type="password" class="form-control ps-1 pe-5" name="password"
                   placeholder="••••••••" required autocomplete="current-password">
            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3 text-decoration-none shadow-none" id="toggleLoginPassword" style="border: none; background: transparent;" tabindex="-1">
                <i class="bi bi-eye text-slate-400" id="loginEyeIcon"></i>
            </button>
        </div>
        @if ($errors->has('password'))
            <div class="text-danger small mt-1.5 d-flex align-items-center gap-1.5" style="font-size: 0.8rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first('password') }}</span>
            </div>
        @endif
    </div>

    <!-- Remember Me -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check d-flex align-items-center gap-2 mb-0">
            <input id="remember" class="form-check-input mt-0" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} style="cursor: pointer;">
            <label class="form-check-label small text-muted user-select-none" for="remember" style="cursor: pointer; font-size: 0.85rem;">
                Keep me signed in
            </label>
        </div>
    </div>

    <!-- Submit Button -->
    <button class="w-100 btn btn-ae-primary fs-6 mb-3 d-flex align-items-center justify-content-center gap-2 py-2.5 shadow-sm" type="submit" style="letter-spacing: -0.01em;">
        <span>Sign In to Account</span>
        <i class="bi bi-arrow-right fs-6 transition-all"></i>
    </button>

    <!-- Footer Action -->
    <div class="text-center pt-3 border-top mt-2">
        <span class="text-muted small" style="font-size: 0.875rem;">Don't have an account yet?</span>
        <a href="{{ route('register.show') }}" class="auth-link ms-1 fw-semibold" style="font-size: 0.875rem;">Create Account</a>
    </div>

    @include('auth.partials.copy')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleLoginPassword');
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('loginEyeIcon');

        if (toggleBtn && passInput && eyeIcon) {
            toggleBtn.addEventListener('click', function () {
                if (passInput.type === 'password') {
                    passInput.type = 'text';
                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');
                } else {
                    passInput.type = 'password';
                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');
                }
            });
        }
    });
</script>
@endsection
