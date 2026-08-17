@extends('layouts.auth-master')

@section('content')
<!-- Corporate Header & Brand -->
<div class="text-center mb-4">
    <a href="{{ route('front-page') }}" class="d-inline-flex align-items-center gap-3 text-decoration-none mb-3" style="transition: transform 0.25s ease;">
        <svg width="52" height="52" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="shadow-sm rounded-3">
            <rect width="36" height="36" rx="8" fill="var(--ae-navy, #0f172a)"/>
            <path d="M0 8C0 3.58172 3.58172 0 8 0H12L0 12V8Z" fill="var(--ae-red, #e31837)"/>
            <path d="M11 11L18 18L11 25" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18 11L25 18L18 25" stroke="var(--ae-red, #e31837)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="text-start lh-1">
            <span class="fw-bold d-block fs-3 text-dark" style="color: var(--ae-navy, #0f172a) !important; letter-spacing: -0.03em;">RMS</span>
            <span class="fw-bold text-uppercase d-block mt-1" style="font-size: 0.68rem; color: var(--ae-red, #e31837); letter-spacing: 0.1em;">Recruitment Portal</span>
        </div>
    </a>

    <div class="mt-1">
        <h1 class="h4 fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">Set New Password</h1>
        <p class="text-muted small mb-0">Create a secure new password for your account</p>
    </div>
</div>

@if (Session::has('message'))
    <div class="alert alert-success d-flex align-items-center gap-2 p-3 mb-3 rounded-3 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <span class="small">{{ Session::get('message') }}</span>
    </div>
@endif

@include('layouts.partials.messages')

<form action="{{ route('reset.password.post') }}" method="POST" class="text-start">
    @csrf
    <!-- Secret token generated from reset link -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Input -->
    <div class="mb-3">
        <label for="email_address" class="form-label fw-semibold text-muted small text-uppercase mb-1.5" style="font-size: 0.72rem; letter-spacing: 0.05em;">Email Address</label>
        <div class="input-group-ae d-flex align-items-center position-relative">
            <span class="input-group-text text-muted ps-3 pe-2"><i class="bi bi-envelope fs-6 text-slate-400"></i></span>
            <input type="email" id="email_address"
                   class="form-control ps-1 pe-3 @error('email') is-invalid @enderror"
                   placeholder="e.g. name@company.com" name="email"
                   value="{{ old('email', request()->email) }}" required autofocus autocomplete="email">
        </div>
        @error('email')
            <div class="text-danger small mt-1.5 d-flex align-items-center gap-1.5" style="font-size: 0.8rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Password Input -->
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold text-muted small text-uppercase mb-1.5" style="font-size: 0.72rem; letter-spacing: 0.05em;">New Password</label>
        <div class="input-group-ae d-flex align-items-center position-relative">
            <span class="input-group-text text-muted ps-3 pe-2"><i class="bi bi-lock fs-6 text-slate-400"></i></span>
            <input type="password" id="password"
                   class="form-control ps-1 pe-5 @error('password') is-invalid @enderror"
                   placeholder="Enter new password" name="password" required autocomplete="new-password">
            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3 text-decoration-none shadow-none toggle-reset-pass" data-target="password" style="border: none; background: transparent;" tabindex="-1">
                <i class="bi bi-eye text-slate-400"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger small mt-1.5 d-flex align-items-center gap-1.5" style="font-size: 0.8rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Confirm Password Input -->
    <div class="mb-4">
        <label for="password-confirm" class="form-label fw-semibold text-muted small text-uppercase mb-1.5" style="font-size: 0.72rem; letter-spacing: 0.05em;">Confirm New Password</label>
        <div class="input-group-ae d-flex align-items-center position-relative">
            <span class="input-group-text text-muted ps-3 pe-2"><i class="bi bi-shield-lock fs-6 text-slate-400"></i></span>
            <input type="password" id="password-confirm"
                   class="form-control ps-1 pe-5 @error('password_confirmation') is-invalid @enderror"
                   placeholder="Confirm new password" name="password_confirmation" required autocomplete="new-password">
            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted pe-3 text-decoration-none shadow-none toggle-reset-pass" data-target="password-confirm" style="border: none; background: transparent;" tabindex="-1">
                <i class="bi bi-eye text-slate-400"></i>
            </button>
        </div>
        @error('password_confirmation')
            <div class="text-danger small mt-1.5 d-flex align-items-center gap-1.5" style="font-size: 0.8rem;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-100 btn btn-ae-primary fs-6 mb-3 d-flex align-items-center justify-content-center gap-2 py-2.5 shadow-sm">
        <span>Save New Password</span>
        <i class="bi bi-arrow-right fs-6"></i>
    </button>

    <!-- Back to Sign In -->
    <div class="text-center pt-3 border-top mt-2">
        <a href="{{ route('login.show') }}" class="auth-link small d-inline-flex align-items-center gap-1.5 fw-semibold" style="font-size: 0.875rem;">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Sign In</span>
        </a>
    </div>

    @include('auth.partials.copy')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-reset-pass').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetId = btn.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = btn.querySelector('i');
                if (input) {
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                }
            });
        });
    });
</script>
@endsection
