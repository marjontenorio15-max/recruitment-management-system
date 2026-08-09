@extends('layouts.app-master')
@section('content')

   <div class="container">
       <div class="shadow m-3">
           <div class="header">
               <nav class="header" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                   <ol class="breadcrumb ">
                       <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                       <li class="breadcrumb-item active" aria-current="page">Charts</li>
                   </ol>
               </nav>
           </div>

           <div class="container">
               <div class="row m-3">
                   <div class="col-lg-3 col-6">
                       <div class="card bg-info shadow">
                           <div class="card-header">
                               @php
                                    $jobs = DB::table('tbl_job_list')->select(DB::raw("COUNT(*) as countJob"))->get();
                               @endphp
                               <h3 class="text-white">
                                   @foreach($jobs as $users)
                                       {{ $users->countJob }}
                                   @endforeach
                               </h3>
                               <p class="text-white">New Jobs <i class="icon-list-add"></i></p>
                           </div>
                           <div class="card-footer text-center">
                               <a href="{{route('vacancy.index')}}" class="text-white">More info<i class="icon-right-circled"></i></a>
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-3 col-6">
                       <div class="card bg-success shadow">
                           <div class="card-header">
                               @php
                                   $apply = DB::table('apply')->select(DB::raw("COUNT(*) as countJob"))->get();
                               @endphp
                               <h3 class="text-white">
                                   @foreach($apply as $users)
                                       {{ $users->countJob }}
                                   @endforeach
                               </h3>
                               <p class="text-white">Applicant Apply  <i class="icon-chart-bar"></i></p>
                           </div>
                           <div class="card-footer text-center">
                               <a href="{{route('apply.index')}}" class="text-white">More info<i class="icon-right-circled"></i></a>
                           </div>

                       </div>
                   </div>

                   <div class="col-lg-3 col-6">
                       <div class="card bg-warning shadow">
                           @php
                             $user = DB::table('users')->select(DB::raw("COUNT(*) as count"))->get();
                           @endphp

                           <div class="card-header">
                               <h3 class="text-white">
                                   @foreach($user as $users)
                                       {{ $users->count }}
                                   @endforeach
                               </h3>
                               <p class="text-white">User Registrations <i class="icon-user-add"></i></p>
                           </div>
                           <div class="card-footer text-center">
                               <a href="{{route('users.index')}}" class="text-white">More info <i class="icon-right-circled"></i></a>
                           </div>
                       </div>
                   </div>

                   <div class="col-lg-3 col-6">
                       <div class="card bg-danger shadow">
                           <div class="card-header">
                               @php
                                   $companies = DB::table('companies')->select(DB::raw("COUNT(*) as count"))->get();
                               @endphp
                               <h3 class="text-white">
                                   @foreach($companies as $users)
                                       {{ $users->count }}
                                   @endforeach
                               </h3>
                               <p class="text-white" >Companies<i class=" icon-building"></i></p>
                           </div>
                           <div class="card-footer">
                               <a href="{{route('company.index')}}" class="text-white">More info <i class="icon-right-circled"></i></a>
                           </div>
                       </div>
                   </div>

               </div>

               {{--           @if (\Session::has('print'))--}}
               {{--               <div class="alert alert-success">--}}
               {{--                   <ul>--}}
               {{--                       <li>{!! \Session::get('print') !!}</li>--}}
               {{--                   </ul>--}}
               {{--               </div>--}}
               {{--           @endif--}}

               <div class="m-3 p-3">

               </div>

           </div>
           {{--       <button onclick="window.print()">Print this page</button>--}}

       </div>
    </div>

@endsection
