@extends('layouts.app-master')
@section('content')
    <link href="{{asset('assets/https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css')}}" rel="stylesheet">

   <div class="container">
       <div class="card mt-3 shadow">
           <div class="card-header bg-primary">
               <h2 class="text-center text-white">Employer</h2>
           </div>
           <div class="card-body">
               @if(auth()->check())
                   <a class="btn btn-outline-dark icon-back shadow m-3 " href="{{ route('company.index') }}"> Back</a>
               @endif

                @if ($errors->any())
                   <div class="alert alert-danger">
                       <strong>Whoops!</strong> There were some problems with your input.<br><br>
                       <ul>
                           @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif

               <form class="form-floating" action="{{ route('company.store') }}" method="POST">
                   @csrf
                   <div class="row">
                       <div class="form-group form-floating">
                           <input type="email" class="form-control" id="floatingEmail" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
                           <label for="floatingEmail">Email address</label>
                           @if ($errors->has('email'))
                               <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                           @endif
                       </div>

                       <div class="form-group form-floating mb-3">
                           <input type="text" class="form-control" id="floatingName" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                           <label for="floatingName">Username</label>
                           @if ($errors->has('username'))
                               <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                           @endif
                       </div>

                       <div class="form-group form-floating mb-3">
                           <input type="password" class="form-control" id="floatingPassword" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                           <label for="floatingPassword">Password</label>
                           @if ($errors->has('password'))
                               <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                           @endif
                       </div>

                       <div class="form-group form-floating mb-3">
                           <input type="password" class="form-control" id="floatingConfirmPassword" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                           <label for="floatingConfirmPassword">Confirm Password</label>
                           @if ($errors->has('password_confirmation'))
                               <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                           @endif
                       </div>
                       <div class="form-group form-floating mb-3">
                           <input type="text" class="form-control" id="floatingCompanyName" name="company_name" placeholder="Companny name" required="required">
                           <label for="floatingCompanyName">Company Name</label>
{{--                           @if ($errors->has('company_name'))--}}
{{--                               <span class="text-danger text-left">{{ $errors->first('company_name') }}</span>--}}
{{--                           @endif--}}
                       </div>

                       <div class="form-group form-floating mb-3">
                           <input type="text" name="address" id="floatingAddress" class="form-control"  placeholder="Enter Address" required="required">
                           <label for="floatingAddress">Address</label>
{{--                           @if ($errors->has('address'))--}}
{{--                               <span class="text-danger text-left">{{ $errors->first('address') }}</span>--}}
{{--                           @endif--}}
                       </div>
                       <div class="form-group form-floating mb-3">
                           <input type="number" name="contact_no" id="floatingContactNumber" class="form-control"  placeholder="Enter Contact Number" required="required">
                           <label for="floatingContactNumber">Contact Number</label>
{{--                           @if ($errors->has('contact_no'))--}}
{{--                               <span class="text-danger text-left">{{ $errors->first('contact_no') }}</span>--}}
{{--                           @endif--}}
                       </div>
                       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           <button type="submit" class="btn btn-outline-success shadow icon-paper-plane float-right"> Submit</button>
                       </div>
                   </div>

               </form>


{{--               <div class="container-fluid">--}}
{{--                   <div class="table-responsive">--}}

{{--                       <div class="row m-3 p-3">--}}
{{--                           <div class="col-8"></div>--}}
{{--                           <div class="col-4">--}}
{{--                               <input class="form-control" id="myInput" onkeyup="employeeFunction()" placeholder="Search for names.." type="text">--}}
{{--                           </div>--}}
{{--                       </div>--}}

{{--                       <table class="table" id="myTable">--}}
{{--                           <thead>--}}
{{--                           <tr>--}}
{{--                               <th scope="col">Employee #</th>--}}
{{--                               <th scope="col">Email Address</th>--}}
{{--                               <th scope="col">Username</th>--}}
{{--                               <th scope="col">Company Name</th>--}}
{{--                               <th scope="col">Action</th>--}}
{{--                           </tr>--}}
{{--                           </thead>--}}
{{--                           <tbody>--}}

{{--                           @php--}}

{{--                               $users = DB::table('users')->select('users.id', 'users.email', 'users.username', 'companies.company_name')->join('companies', 'companies.company_id', 'users.id')->get();--}}

{{--                           @endphp--}}

{{--                           @foreach($users as $key => $data)--}}
{{--                               <tr>--}}
{{--                                   <td>{{$data->id}}</td>--}}
{{--                                   <td>{{$data->email}}</td>--}}
{{--                                   <td>{{$data->username}}</td>--}}
{{--                                   <td>{{$data->company_name}}</td>--}}
{{--                                   <td>--}}
{{--                                       <form action="" method="POST">--}}
{{--                                           <a href="{{route('show-employer'), $data->id }}" class="btn btn-outline-info shadow icon-eye-7"></a>--}}
{{--                                           <a class="btn btn-outline-primary shadow icon-edit"></a>--}}
{{--                                           <button type="submit" class="btn btn-outline-danger shadow icon-trash"></button>--}}
{{--                                       </form>--}}
{{--                                   </td>--}}
{{--                               </tr>--}}
{{--                           @endforeach--}}

{{--                           </tbody>--}}
{{--                       </table>--}}
{{--                   </div>--}}
{{--               </div>--}}


           </div>
       </div>
   </div>

   <script>
       function employeeFunction() {
           // Declare variables
           var input, filter, table, tr, td, i, txtValue;
           input = document.getElementById("myInput");
           filter = input.value.toUpperCase();
           table = document.getElementById("myTable");
           tr = table.getElementsByTagName("tr");

           // Loop through all table rows, and hide those who don't match the search query
           for (i = 0; i < tr.length; i++) {
               td = tr[i].getElementsByTagName("td")[0];
               if (td) {
                   txtValue = td.textContent || td.innerText;
                   if (txtValue.toUpperCase().indexOf(filter) > -1) {
                       tr[i].style.display = "";
                   } else {
                       tr[i].style.display = "none";
                   }
               }
           }
       }
   </script>
    <script src="{{asset('assets/https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js')}}"></script>
@endsection
