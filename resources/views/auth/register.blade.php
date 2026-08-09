@extends('layouts.auth-master')

@section('content')

    <form method="post" action="{{ route('register.perform')}}" class="frmRegister">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{{asset('assets/img/Rms.png')}}" alt="" width="72" height="70">

        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname" required="required" autofocus>
            <label for="floatingEmail">Lastname</label>
            @if ($errors->has('lastname'))
                <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname" required="required" autofocus>
            <label for="floatingEmail">Firstname</label>
            @if ($errors->has('firstname'))
                <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" placeholder="Middlename" autofocus>
            <label for="floatingEmail">Middlename</label>
            @if ($errors->has('middlename'))
                <span class="text-danger text-left">{{ $errors->first('middlename') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="date" class="form-control txtBirthdate" name="birth_date" value="{{ old('birth_date') }}" placeholder="Birthdate" autofocus>
            <label for="floatingEmail">Birthdate</label>
            @if ($errors->has('birth_date'))
                <span class="text-danger text-left">{{ $errors->first('birth_date') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required="required" autofocus>
            <label for="floatingEmail">Email address</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control txtPassword" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control txtConPass" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirm Password</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>


        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        <div class="m-3 p-3">
            <a href="{{route('login.perform')}}">Already have an account?</a>
        </div>
        @include('auth.partials.copy')
    </form>

    <form method="post" action="" class="frmOTP" style="display: none;">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 mb-3 fw-normal">Confirm OTP</h1>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control txtOtp" name="otp" value="" placeholder="OTP" required="required" autofocus>
            <label for="floatingEmail">OTP</label>
            <span class="text-danger text-left spanOTPErrMsg"></span>
        </div>

        <button class="w-100 btn btn-lg btn-primary btnConfirm" type="submit">Confirm</button>
        @include('auth.partials.copy')
    </form>

<script type="text/javascript">
    var otp = "";

    // Setup CSRF token for all AJAX requests automatically
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    $(document).ready(function() {
        $('.frmRegister').submit(function(e){
            e.preventDefault();
            if($('.txtPassword').val() == $('.txtConPass').val()) {
                if($('.txtBirthdate').val() != '') {
                    var age = moment().diff($('.txtBirthdate').val(), 'years', false);
                    if(age >= 18) {
                        SendOTP();
                    } else {
                        alert('You must be at least 18 years old to register.');
                    }
                } else {
                    alert('Please enter your birth date.');
                }
            } else {
                alert('Passwords do not match!');
            }
        });

        $('.frmOTP').submit(function(e){
            e.preventDefault();
            if(otp == $('.txtOtp').val()) {
                RegisterUser();
            } else {
                alert('Invalid OTP!');
            }
        });
    });

    function SendOTP() {
        $.ajax({
            url: "{{ route('sendOTP') }}", // Uses Laravel's named route securely
            data: $('.frmRegister').serialize(),
            method: 'post',
            success: function(result){
                if(result.result == 1) {
                    otp = result.otp; // Note: if you secured it and removed raw OTP, handle session checking instead, but this matches your current setup
                    $('.frmRegister').hide();
                    $('.frmOTP').show();
                    alert('OTP has been sent to your email.');
                } else {
                    alert('Failed to send OTP.');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('An error occurred while sending OTP.');
            }
        });
    }

    function RegisterUser() {
        $.ajax({
            url: "{{ route('registerUser') }}", // Uses Laravel's named route securely
            data: $('.frmRegister').serialize(),
            method: 'post',
            success: function(result){
                if(result.result == 1){
                    alert('User has been created successfully!');
                    window.location.href = "/view-jobs"; // Redirect appropriately after success
                } else {
                    alert('User registration failed!');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('An error occurred during registration.');
            }
        });
    }

    function verifyOTP(){
        // When the user submits the OTP form
        $('.frmOTP').submit(function(e){
            e.preventDefault();

            // Append the OTP field data to the main registration form data
            var formData = $('.frmRegister').serialize() + '&otp=' + $('.txtOtp').val();

            $.ajax({
                url: "{{ route('verifyOTP') }}",
                data: formData,
                method: 'post',
                success: function(result){
                    if(result.result == 1){
                        alert('User has been created successfully!');
                        window.location.href = "/view-jobs"; // Or wherever you want to redirect
                    } else {
                        alert('Invalid OTP or registration failed!');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('An error occurred during OTP verification.');
                }
            });
        });
    }

</script>

@endsection
