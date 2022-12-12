<header class="">
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->

    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div><!-- /loader_form -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <a href="{{route('front-page')}}"><img src="{{asset('assets/img/rms1.png')}}" alt="" width="50" height="50"></a>
            </div>
            <div class="col-9">
                <div id="social">
                    <ul>
{{--                        @include('layouts.partials.__nav')--}}
{{--                        <li><a href="#0"><i class="icon-facebook"></i></a></li>--}}
{{--                        <li><a href="#0"><i class="icon-twitter"></i></a></li>--}}
{{--                        <li><a href="#0"><i class="icon-google"></i></a></li>--}}
{{--                        <li><a href="#0"><i class="icon-linkedin"></i></a></li>--}}
                        @auth
                            <li class="text-center m-2">{{auth()->user()->username}}</li>
                            <a href="{{ route('logout.perform') }}" class="btn btn-warning float-end">Logout</a>
                        @endauth

                        @guest
                            <a href="{{ route('login.perform') }}" class="btn btn-primary float-end">Login</a>
{{--                            <a href="{{ route('register.perform') }}" class="btn btn-success">Sign-up</a>--}}
                        @endguest
                    </ul>
                </div>
{{--                <!-- /social -->--}}
                <a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
                <!-- /menu button -->
               @include('layouts.partials.__nav')
                <!-- /menu -->
            </div>
        </div>
    </div>
    <!-- /container -->
</header>
<!-- /Header -->
