@extends('layouts.auth-master')

@section('content')
    <style>
        input[type=text] {
            padding: 12px 20px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #captchabut{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
        canvas{
            /*prevent interaction with the canvas*/
            pointer-events:none;
        }
    </style>
   <div class="container text-center">
       <body onload="createCaptcha()">
           <form method="post"id="myForm" onsubmit="validateCaptcha()"  action="{{ route('login.perform') }}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <a href="{{route('front-page')}}"><img class="mb-4" src="{{asset('assets/img/Rms.png')}}" alt="" width="75" height="75"></a>


               <h1 class="h3 mb-3 fw-normal">Login</h1>

               @include('layouts.partials.messages')

               <div class="form-group form-floating mb-3">
                   <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                          placeholder="Username" required="required" autofocus>
                   <label for="floatingName">Email or Username</label>
                   @if ($errors->has('username'))
                       <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                   @endif
               </div>

               <div class="form-group form-floating mb-3" >
                   <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                          placeholder="Password" required="required">
                   <label for="floatingPassword">Password</label>
                   @if ($errors->has('password'))
                       <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                   @endif
               </div>

{{--                          captcha js--}}
               <div class="form-group form-floating mb-3">
                   <div id="captcha"> </div>
                   <input type="text"  placeholder="Captcha" id="cpatchaTextBox"/>
               </div>



               <div class="form-group mb-3">
                   <label for="remember">Remember me</label>
                   <input type="checkbox" name="remember" value="1">
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
       </body>


   </div>

    <script>
        var code;
        function createCaptcha() {
            //clear the contents of captcha div first
            document.getElementById('captcha').innerHTML = "";
            var charsArray =
                "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
            var lengthOtp = 6;
            var captcha = [];
            for (var i = 0; i < lengthOtp; i++) {
                //below code will not allow Repetition of Characters
                var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
                if (captcha.indexOf(charsArray[index]) == -1)
                    captcha.push(charsArray[index]);
                else i--;
            }
            var canv = document.createElement("canvas");
            canv.id = "captcha";
            canv.width = 100;
            canv.height = 50;
            var ctx = canv.getContext("2d");
            ctx.font = "25px Georgia";
            ctx.strokeText(captcha.join(""), 0, 30);
            //storing captcha so that can validate you can save it somewhere else according to your specific requirements
            code = captcha.join("");
            document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
        }
        function validateCaptcha() {
            event.preventDefault();
            debugger
            if (document.getElementById("cpatchaTextBox").value == code) {
                alert("Valid Captcha");
                window.location = '{{ route('login.perform') }}';
                document.getElementById("myForm").submit();

            }else{
                alert("Invalid Captcha. try Again");
                createCaptcha();
            }

        }


    </script>
@endsection
