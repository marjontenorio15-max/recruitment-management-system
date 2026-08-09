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
            <div class="col-6">
                <ul>
                    @auth()
{{--       admin--}}
 @if(auth()->user()->role_id == 1)
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('dashboard.index')}}" class="animated-link">Dashboard</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('generate-reports')}}" class="animated_link">Generate Report</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('company.index')}}" class="animated_link">Manage|Create Company</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('vacancy.index')}}" class="animated_link">Vacancy|Create Jobs</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('users.index')}}" class="animated_link">Manage Users</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('apply.index')}}" class="animated_link">Applicants Record</a></li>
{{--             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
             {{--                 <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('create-employer')}}" class="animated_link">Employee Record</a></li>--}}
             {{--                 <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('application-form')}}" class="animated_link">Applicant Management</a></li>--}}
{{--         employer--}}
 @elseif(auth()->user()->role_id == 2)
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('home.index')}}" class="animated_link">Home</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('generate-reports')}}" class="animated_link">Generate Report</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('vacancy.index')}}" class="animated_link">Create Job|Vacancy</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('employer-applicant-table-record')}}" class="animated_link">Manage Applicants</a></li>
             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('account-profile')}}" class="animated_link">Employer Profile</a></li>
{{--             <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
             {{--                 <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('company.index')}}" class="animated_link">Company</a></li>--}}
{{--         Applicant--}}
 @else
         <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('front-page')}}" class="animated_link">Home</a></li>
         <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('view-jobs')}}" class="animated_link">Job Browse</a></li>
         <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('applicant-dashboard')}}" class="animated_link">Applied Jobs</a></li>
         <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('account-profile')}}" class="animated_link">Account</a></li>
{{--         <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
 @endif
@endauth

@guest
            <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('front-page')}}" class="animated-link">Home</a></li>
            <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('term')}}" class="animated_link">Terms</a></li>
            <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('view-jobs')}}" class="animated_link">Browse Jobs</a></li>
            <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('about')}}" class="animated_link">About Us</a></li>
            <li style="margin-right: 20px; margin-top: 15px; float: left;"><a href="{{route('contacts')}}" class="animated_link">Contact Us</a></li>
@endguest
                </ul>
            </div>
            <div class="col-3">
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
                            <li><a href="{{ route('login.perform') }}" class="btn btn-primary text-white">Login</a></li>

                           <li> <a href="{{ route('register.perform') }}" class="btn btn-success float-end text-white">Register</a></li>
                        @endguest
                    </ul>
                </div>
{{--                <!-- /social -->--}}
                <!-- <a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a> -->
                <!-- /menu button -->
                <!-- /menu -->
            </div>
        </div>
    </div>
    <!-- /container -->
</header>
<!-- /Header -->
