@extends('layouts.auth-master')

@section('content')
    <div class="container text-center">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <a href="{{route('front-page')}}"><img class="mb-4" src="{{asset('assets/img/Rms.png')}}" alt="" width="75" height="75"></a>

        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
        <div class="card-body">

            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group form-floating ">

                    <input type="text" id="email_address" class="form-control" placeholder="Email Address" name="email" required autofocus>
                    <label for="email_address">Email Address</label>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group  form-floating ">

                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" required autofocus>
                    <label for="password">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating ">

                    <input type="password" id="password-confirm" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autofocus>
                    <label for="password-confirm">Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
