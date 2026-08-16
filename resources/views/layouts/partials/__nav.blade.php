@auth()
{{--       admin--}}
 @if(auth()->user()->role_id == 1)
     <nav>
         <ul class="cd-primary-nav">
             <li><a href="{{route('dashboard.index')}}" class="animated-link">Dashboard</a></li>
             <li><a href="{{route('reports.index')}}" class="animated_link">Generate Report</a></li>
             <li><a href="{{route('company.index')}}" class="animated_link">Manage|Create Company</a></li>
             <li><a href="{{route('vacancy.index')}}" class="animated_link">Vacancy|Create Jobs</a></li>
             <li><a href="{{route('users.index')}}" class="animated_link">Manage Users</a></li>
             <li><a href="{{route('apply.index')}}" class="animated_link">Applicants Record</a></li>
{{--             <li><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
             {{--                 <li><a href="{{route('create-employer')}}" class="animated_link">Employee Record</a></li>--}}
             {{--                 <li><a href="{{route('application-form')}}" class="animated_link">Applicant Management</a></li>--}}
         </ul>
     </nav>
{{--         employer--}}
 @elseif(auth()->user()->role_id == 2)
     <nav>
         <ul class="cd-primary-nav">
             <li><a href="{{route('home.index')}}" class="animated_link">Home</a></li>
             <li><a href="{{route('reports.index')}}" class="animated_link">Generate Report</a></li>
             <li><a href="{{route('vacancy.index')}}" class="animated_link">Create Job|Vacancy</a></li>
             <li><a href="{{route('employer-applicant-table-record')}}" class="animated_link">Manage Applicants</a></li>
             <li><a href="{{route('account-profile')}}" class="animated_link">Employer Profile</a></li>
{{--             <li><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
             {{--                 <li><a href="{{route('company.index')}}" class="animated_link">Company</a></li>--}}
         </ul>
     </nav>
{{--         Applicant--}}
 @else
 <nav>
     <ul class="cd-primary-nav">
         <li><a href="{{route('front-page')}}" class="animated_link">Home</a></li>
         <li><a href="{{route('view-jobs')}}" class="animated_link">Job Browse</a></li>
         <li><a href="{{route('applicant-dashboard')}}" class="animated_link">Applied Jobs</a></li>
         <li><a href="{{route('account-profile')}}" class="animated_link">Account</a></li>
{{--         <li><a href="{{route('logout.perform')}}" class="animated_link">Logout</a></li>--}}
     </ul>
 </nav>
 @endif
@endauth

@guest()
    <nav>
        <ul class="cd-primary-nav">
            <li><a href="{{route('front-page')}}" class="animated-link">Home</a></li>
            <li><a href="{{route('term')}}" class="animated_link">Terms</a></li>
            <li><a href="{{route('view-jobs')}}" class="animated_link">Browse Jobs</a></li>
            <li><a href="{{route('about')}}" class="animated_link">About Us</a></li>
            <li><a href="{{route('contacts')}}" class="animated_link">Contact Us</a></li>
        </ul>
    </nav>
@endguest


