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
                   <div class="row">
                       <div class="col-6">
                           <div class="card shadow">
                               <div class="card-header bg-primary">
                                   <h4 class="text-white text-center">Users Chart</h4>
                               </div>
                               <div class="card-body">
                                   <canvas id="myChart" height="280" width="600"></canvas>
                               </div>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="card shadow">
                               <div class="card-header bg-primary text-center ">
                                   <h4 class="text-white">
                                       Users Chart
                                   </h4>
                               </div>
                               <div class="card-body">
                                   <canvas id="canvas" height="280" width="600"></canvas>
                               </div>
                           </div>
                       </div>
                   </div>
{{--                   <div class="row">--}}
{{--                       <div class="col-6">--}}
{{--                           <div class="card">--}}
{{--                               <div class="card-header bg-primary text-center ">--}}
{{--                                   <h3 class="text-white">--}}
{{--                                       Dashboard--}}
{{--                                   </h3>--}}
{{--                               </div>--}}
{{--                               <div class="card-body">--}}
{{--                                   <canvas id="canvas" height="280" width="600"></canvas>--}}
{{--                               </div>--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                       <div class="col-6">--}}

{{--                       </div>--}}
{{--                   </div>--}}
               </div>

           </div>
           {{--       <button onclick="window.print()">Print this page</button>--}}

       </div>
    </div>




   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--   for users--}}
   <script type="text/javascript">

       var labels =  {{ Js::from($labels) }};
       var users =  {{ Js::from($data) }};

       const data = {
           labels: labels,
           datasets: [{
               label: 'Users',
               backgroundColor: 'rgb(255, 99, 132)',
               borderColor: 'rgb(255, 99, 132)',
               data: users,
           }]
       };

       const config = {
           type: 'line',
           data: data,
           options: {}
       };

       const myChart = new Chart(
           document.getElementById('myChart'),
           config
       );

   </script>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
           var data = google.visualization.arrayToDataTable({{ Js::from($result) }});

           var options = {
               chart: {
                   title: 'Website Performance',
                   subtitle: 'jobs and applicants',
               },
           };

           var chart = new google.charts.Bar(document.getElementById('barchart_material'));

           chart.draw(data, google.charts.Bar.convertOptions(options));
       }
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
   <script>
       var year = <?php echo $year; ?>;
       var user = <?php echo $user; ?>;
       var barChartData = {
           labels: year,
           datasets: [{
               label: 'User',
               backgroundColor: "pink",
               data: user
           }]
       };

       window.onload = function() {
           var ctx = document.getElementById("canvas").getContext("2d");
           window.myBar = new Chart(ctx, {
               type: 'bar',
               data: barChartData,
               options: {
                   elements: {
                       rectangle: {
                           borderWidth: 2,
                           borderColor: '#c1c1c1',
                           borderSkipped: 'bottom'
                       }
                   },
                   responsive: true,
                   title: {
                       display: true,
                       text: 'Monthly User Joined'
                   }
               }
           });
       };
   </script>
@endsection
