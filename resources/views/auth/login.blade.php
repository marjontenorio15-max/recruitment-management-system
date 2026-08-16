@extends('layouts.auth-master')

@section('content')
   <div class="container text-center">
           <form method="POST" action="{{ route('login.perform') }}">
               @csrf
               <a href="{{route('front-page')}}"><img class="mb-4" src="{{asset('assets/img/Rms.png')}}" alt="" width="75" height="75"></a>


               <h1 class="h3 mb-3 fw-normal">Login</h1>

               @include('layouts.partials.messages')

               <div class="form-group form-floating mb-3">
                   <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                          placeholder="Username" required autofocus autocomplete="username">
                   <label for="username">Email or Username</label>
                   @if ($errors->has('username'))
                       <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                   @endif
               </div>

               <div class="form-group form-floating mb-3" >
                   <input id="password" type="password" class="form-control" name="password"
                          placeholder="Password" required autocomplete="current-password">
                   <label for="password">Password</label>
                   @if ($errors->has('password'))
                       <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                   @endif
               </div>

               <div class="form-group mb-3">
                   <input id="remember" type="checkbox" name="remember" value="1">
                   <label for="remember">Remember me</label>
               </div>

               <div class="form-group">
                   <button class="w-100 btn btn-lg btn-primary"  type="submit">Login</button>
               </div>
               {{--           <div class="form-group row">--}}
               {{--             <div class="col-md-6 offset-md-4">--}}
               {{--                 <div class="checkbox">--}}
               {{--                     <label>--}}
               {{--                         <a href="{{ route('forget.password.get') }}">Reset Password</a>--}}
               {{--                     </label>--}}
               {{--                 </div>--}}
               {{--             </div>--}}
               {{--           </div>--}}

               <div class="row">
                   <div class="form-group col-6">
                       <a href="{{ route('forget.password.get') }}">Reset Password</a>
                   </div>
                   <div class="form-group col-6">
                       <a href="{{ route('register.show') }}">Create New Account</a>
                   </div>
               </div>



               {{--           @include('auth.passwords.reset')--}}
               @include('auth.partials.copy')
           </form>
   </div>
@endsection
