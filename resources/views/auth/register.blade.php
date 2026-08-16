@extends('layouts.auth-master')

@section('content')
<style>
    :root {
        --ae-navy: #002855;
        --ae-navy-dark: #001a38;
        --ae-red: #e31837;
        --ae-red-hover: #c4122d;
        --ae-blue-light: #e8f1f8;
        --ae-gray-bg: #f4f6f8;
        --ae-border: #dbe2ea;
        --ae-text-dark: #1e293b;
        --ae-text-muted: #64748b;
    }

    /* Fluid Container & Card */
    .form-signin {
        max-width: 850px !important;
        width: 92% !important;
        margin: 2.5rem auto;
    }

    /* Scaled Inputs & Floating Labels */
    .form-floating > .form-control {
        height: clamp(56px, 6vh, 64px);
        font-size: 1.05rem;
        border-color: var(--ae-border);
    }

    .form-floating > label {
        padding: 1.15rem 0.85rem;
        font-size: 0.95rem;
        color: var(--ae-text-muted);
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--ae-navy);
        font-weight: 600;
        transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
    }

    .form-control:focus {
        border-color: var(--ae-navy);
        box-shadow: 0 0 0 0.25rem rgba(0, 40, 85, 0.15);
    }

    .pass-toggle-btn {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background: transparent;
        border: none;
        font-size: 1.25rem;
        color: var(--ae-text-muted);
        cursor: pointer;
    }

    .pass-toggle-btn:hover {
        color: var(--ae-navy);
    }

    .step-badge {
        font-size: 0.8125rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ae-red);
    }

    .btn-ae-primary {
        background-color: var(--ae-red);
        border: none;
        padding: 0.95rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-ae-primary:hover {
        background-color: var(--ae-red-hover);
        box-shadow: 0 4px 12px rgba(227, 24, 55, 0.3);
    }

    .btn-ae-navy {
        background-color: var(--ae-navy);
        border: none;
        padding: 0.95rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-ae-navy:hover {
        background-color: var(--ae-navy-dark);
        box-shadow: 0 4px 12px rgba(0, 40, 85, 0.3);
    }

    /* Large OTP Input */
    .otp-input-large {
        height: 72px !important;
        font-size: 2.25rem !important;
        letter-spacing: 0.4em !important;
        border: 2px solid var(--ae-border);
        border-radius: 10px;
    }

    .otp-input-large:focus {
        border-color: var(--ae-navy);
    }
</style>

<div class="ae-auth-card text-start">

    {{-- Header Branding --}}
    <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="d-inline-block mb-3">
            <img src="{{ asset('assets/img/Rms.png') }}" alt="Advanced Energy Logo" width="92" height="90" class="img-fluid">
        </a>
        <span class="d-block step-badge mb-2" id="stepIndicator">Step 1 of 2 — Candidate Information</span>
        <h1 class="h3 fw-bold text-dark mb-1" id="formTitle">Create Candidate Account</h1>
        <p class="text-muted fs-6 mb-0" id="formSubtitle">Advanced Energy Recruitment Management System</p>
    </div>

    @include('layouts.partials.messages')

    {{-- STEP 1: Registration Form --}}
    <form method="post" action="{{ route('register.perform') }}" class="frmRegister">
        @csrf

        {{-- Candidate Name Fields --}}
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control" id="regLastname" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required autofocus>
                    <label for="regLastname">Last Name *</label>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control" id="regFirstname" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required>
                    <label for="regFirstname">First Name *</label>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control" id="regMiddlename" name="middlename" value="{{ old('middlename') }}" placeholder="Middle Name">
                    <label for="regMiddlename">Middle Name</label>
                </div>
            </div>
        </div>

        {{-- Birth Date & Username --}}
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control txtBirthdate" id="regBirthdate" name="birth_date" value="{{ old('birth_date') }}" required>
                    <label for="regBirthdate">Date of Birth *</label>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="regUsername" name="username" value="{{ old('username') }}" placeholder="Username" required>
                    <label for="regUsername">Username *</label>
                </div>
            </div>
        </div>

        {{-- Email Address --}}
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="regEmail" name="email" value="{{ old('email') }}" placeholder="Email address" required>
            <label for="regEmail">Email Address *</label>
        </div>

        {{-- Passwords --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="form-floating position-relative">
                    <input type="password" class="form-control txtPassword" id="regPassword" name="password" placeholder="Password" required>
                    <label for="regPassword">Password *</label>
                    <button type="button" class="pass-toggle-btn togglePassword" data-target="#regPassword" tabIndex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-floating position-relative">
                    <input type="password" class="form-control txtConPass" id="regConfirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="regConfirmPassword">Confirm Password *</label>
                    <button type="button" class="pass-toggle-btn togglePassword" data-target="#regConfirmPassword" tabIndex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Alert Container --}}
        <div id="regAlertContainer"></div>

        <button class="w-100 btn text-white btn-ae-primary shadow-sm btnSubmitReg" type="submit">
            <span class="btn-text">Register & Send OTP Code</span>
            <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
        </button>

        <div class="text-center mt-4 fs-6">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login.show') }}" class="fw-bold text-decoration-none ms-1" style="color: var(--ae-navy);">Sign In</a>
        </div>

        @include('auth.partials.copy')
    </form>

    {{-- STEP 2: Verification Code Form --}}
    <form method="post" action="" class="frmOTP" style="display: none;">
        @csrf

        <div class="text-center my-4">
            <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 72px; height: 72px; border: 2px solid var(--ae-border);">
                <i class="bi bi-shield-lock-fill fs-1" style="color: var(--ae-navy);"></i>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control txtOtp otp-input-large text-center fw-bold" id="otpCode" name="otp" placeholder="000000" maxlength="6" pattern="[0-9]*" inputmode="numeric" required autocomplete="off">
            <label for="otpCode" class="text-center w-100 fs-6">Enter 6-Digit Verification Code</label>
        </div>
        <span class="text-danger small spanOTPErrMsg d-block mb-3 text-center"></span>

        <div id="otpAlertContainer"></div>

        <button class="w-100 btn text-white btn-ae-navy shadow-sm mb-4 btnConfirm" type="submit">
            <span class="btn-text">Verify Code & Complete Account</span>
            <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
        </button>

        <div class="d-flex justify-content-between align-items-center pt-3 border-top fs-6">
            <button type="button" class="btn btn-link text-decoration-none p-0 btnResendOTP fw-semibold" style="color: var(--ae-red);">
                <i class="bi bi-arrow-clockwise me-1"></i> <span class="resend-label">Resend Code</span>
            </button>
            <button type="button" class="btn btn-link text-muted text-decoration-none p-0 btnBackToReg">
                <i class="bi bi-arrow-left me-1"></i> Back to Details
            </button>
        </div>

        @include('auth.partials.copy')
    </form>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    var cooldownTimer = null;

    $(document).ready(function() {

        // Toggle password eye icon
        $('.togglePassword').on('click', function() {
            var targetInput = $($(this).data('target'));
            var icon = $(this).find('i');

            if (targetInput.attr('type') === 'password') {
                targetInput.attr('type', 'text');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                targetInput.attr('type', 'password');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });

        // OTP Numeric restraint & Auto-submit upon completing 6 digits
        $('.txtOtp').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) {
                $('.frmOTP').submit();
            }
        });

        // Submit Step 1: Registration
        $('.frmRegister').on('submit', function(e) {
            e.preventDefault();
            clearAlerts();

            var pass = $('.txtPassword').val();
            var conPass = $('.txtConPass').val();
            var birthDate = $('.txtBirthdate').val();

            if (pass !== conPass) {
                showAlert('#regAlertContainer', 'danger', 'Passwords do not match.');
                return;
            }

            if (!birthDate) {
                showAlert('#regAlertContainer', 'warning', 'Please select your date of birth.');
                return;
            }

            var age = calculateAge(birthDate);
            if (age < 18) {
                showAlert('#regAlertContainer', 'danger', 'You must be at least 18 years old to create an account.');
                return;
            }

            SendOTP();
        });

        // Submit Step 2: Verification
        $('.frmOTP').on('submit', function(e) {
            e.preventDefault();
            clearAlerts();

            var inputOtp = $.trim($('.txtOtp').val());

            if (inputOtp.length < 6) {
                $('.spanOTPErrMsg').text('Please enter all 6 digits of your verification code.');
                return;
            }

            verifyOTP(inputOtp);
        });

        // Resend OTP
        $('.btnResendOTP').on('click', function() {
            if ($(this).hasClass('disabled')) return;
            SendOTP(true);
        });

        // Back to Step 1
        $('.btnBackToReg').on('click', function() {
            $('.frmOTP').fadeOut(200, function() {
                $('#stepIndicator').text('Step 1 of 2 — Candidate Information');
                $('#formTitle').text('Create Candidate Account');
                $('#formSubtitle').text('Advanced Energy Recruitment Management System');
                $('.frmRegister').fadeIn(200);
            });
        });
    });

    function SendOTP(isResend = false) {
        setBtnLoading('.btnSubmitReg', true);

        $.ajax({
            url: "{{ route('sendOTP') }}",
            data: $('.frmRegister').serialize(),
            method: 'POST',
            success: function(result) {
                setBtnLoading('.btnSubmitReg', false);
                if (result.result == 1) {
                    if (!isResend) {
                        $('.frmRegister').fadeOut(200, function() {
                            $('#stepIndicator').text('Step 2 of 2 — Verification Code');
                            $('#formTitle').text('Enter Verification Code');
                            $('#formSubtitle').text('We sent a 6-digit verification code to your email.');
                            $('.frmOTP').fadeIn(200);
                            $('.txtOtp').focus();
                        });
                    }
                    showAlert('#otpAlertContainer', 'success', 'Verification code sent to your email.');
                    startResendCooldown(60);
                } else {
                    showAlert('#regAlertContainer', 'danger', result.message || 'Verification failed. Please check your information.');
                }
            },
            error: function(xhr) {
                setBtnLoading('.btnSubmitReg', false);
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errs = xhr.responseJSON.errors;
                    var firstErr = Object.values(errs)[0][0];
                    showAlert('#regAlertContainer', 'danger', firstErr);
                } else {
                    showAlert('#regAlertContainer', 'danger', 'An error occurred while sending the code. Please try again.');
                }
            }
        });
    }

    function verifyOTP(inputOtp) {
        setBtnLoading('.btnConfirm', true);

        var formData = $('.frmRegister').serialize() + '&otp=' + encodeURIComponent(inputOtp);

        $.ajax({
            url: "{{ route('verifyOTP') }}",
            data: formData,
            method: 'POST',
            success: function(result) {
                setBtnLoading('.btnConfirm', false);
                if (result.result == 1) {
                    showAlert('#otpAlertContainer', 'success', 'Account created! Redirecting to jobs portal...');
                    setTimeout(function() {
                        window.location.href = result.redirect || "/view-jobs";
                    }, 1200);
                } else {
                    showAlert('#otpAlertContainer', 'danger', result.message || 'Invalid code. Please try again.');
                }
            },
            error: function(xhr) {
                setBtnLoading('.btnConfirm', false);
                if (xhr.status === 422 && xhr.responseJSON) {
                    showAlert('#otpAlertContainer', 'danger', xhr.responseJSON.message || 'Invalid verification code.');
                } else {
                    showAlert('#otpAlertContainer', 'danger', 'An error occurred during verification.');
                }
            }
        });
    }

    function startResendCooldown(seconds) {
        var $btn = $('.btnResendOTP');
        var $label = $btn.find('.resend-label');
        $btn.addClass('disabled').css('pointer-events', 'none');

        if (cooldownTimer) clearInterval(cooldownTimer);

        var remaining = seconds;
        $label.text('Resend Code (' + remaining + 's)');

        cooldownTimer = setInterval(function() {
            remaining--;
            if (remaining <= 0) {
                clearInterval(cooldownTimer);
                $btn.removeClass('disabled').css('pointer-events', 'auto');
                $label.text('Resend Code');
            } else {
                $label.text('Resend Code (' + remaining + 's)');
            }
        }, 1000);
    }

    function setBtnLoading(btnSelector, isLoading) {
        var $btn = $(btnSelector);
        if (isLoading) {
            $btn.prop('disabled', true);
            $btn.find('.btn-text').data('original', $btn.find('.btn-text').text()).text('Processing...');
            $btn.find('.spinner-border').removeClass('d-none');
        } else {
            $btn.prop('disabled', false);
            $btn.find('.btn-text').text($btn.find('.btn-text').data('original') || 'Submit');
            $btn.find('.spinner-border').addClass('d-none');
        }
    }

    function showAlert(containerSelector, type, message) {
        var html = '<div class="alert alert-' + type + ' alert-dismissible fade show p-3 fs-6 mb-3 text-start" role="alert">' +
                   '<span>' + message + '</span>' +
                   '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                   '</div>';
        $(containerSelector).html(html);
    }

    function clearAlerts() {
        $('#regAlertContainer, #otpAlertContainer').empty();
        $('.spanOTPErrMsg').text('');
    }

    function calculateAge(birthDateString) {
        var today = new Date();
        var birthDate = new Date(birthDateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
</script>
@endsection
