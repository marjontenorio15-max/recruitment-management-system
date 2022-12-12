@extends('layouts.app-master')
@section('content')
   <div class="container">
       <div class="card">
           <div class="card-header">
               <h1 class="h3 mb-3 fw-normal text-center">Create Employee Account</h1>
           </div>
           <div class="card-body">
               <form method="post" action="{{ route('employer.perform') }}">

                   <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                   <div class="form-group form-floating mb-3">
                       <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
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
                       <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                       <label for="floatingPassword">Password</label>
                       @if ($errors->has('password'))
                           <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                       @endif
                   </div>

                   <div class="form-group form-floating mb-3">
                       <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                       <label for="floatingConfirmPassword">Confirm Password</label>
                       @if ($errors->has('password_confirmation'))
                           <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                       @endif
                   </div>
                   <button class="btn btn-lg btn-primary icon-user-add" type="submit">Add</button>
                   @include('auth.partials.copy')
               </form>
               <hr>

{{--               <div class="container-fluid">--}}
{{--                   <div class="table-responsive">--}}

{{--                      <div class="row m-3 p-3">--}}
{{--                         <div class="col-8"></div>--}}
{{--                          <div class="col-4">--}}
{{--                              <input class="form-control" id="myInput" onkeyup="employeeFunction()" placeholder="Search for names.." type="text">--}}
{{--                          </div>--}}
{{--                      </div>--}}

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

{{--                               $data = DB::table('users')->select('users.id', 'users.email', 'users.username', 'companies.company_name')->join('companies', 'companies.company_id', 'users.id')->get();--}}

{{--                           @endphp--}}

{{--                               @foreach($data as $key => $value)--}}
{{--                                   <tr>--}}
{{--                                       <td>{{$value->id}}</td>--}}
{{--                                       <td>{{$value->email}}</td>--}}
{{--                                       <td>{{$value->username}}</td>--}}
{{--                                       <td>{{$value->company_name}}</td>--}}
{{--                                       <td>--}}
{{--                                           <form action="" method="POST">--}}
{{--                                               <a href="{{route('company.show',$value->id)}}" class="btn btn-info">Show</a>--}}
{{--                                               <a class="btn btn-primary">Edit</a>--}}
{{--                                               <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                           </form>--}}
{{--                                       </td>--}}
{{--                                   </tr>--}}
{{--                               @endforeach--}}

{{--                           </tbody>--}}
{{--                       </table>--}}
{{--                   </div>--}}
{{--               </div>--}}

           </div>
       </div>
   </div>

{{--   <script>--}}
{{--       function employeeFunction() {--}}
{{--           // Declare variables--}}
{{--           var input, filter, table, tr, td, i, txtValue;--}}
{{--           input = document.getElementById("myInput");--}}
{{--           filter = input.value.toUpperCase();--}}
{{--           table = document.getElementById("myTable");--}}
{{--           tr = table.getElementsByTagName("tr");--}}

{{--           // Loop through all table rows, and hide those who don't match the search query--}}
{{--           for (i = 0; i < tr.length; i++) {--}}
{{--               td = tr[i].getElementsByTagName("td")[0];--}}
{{--               if (td) {--}}
{{--                   txtValue = td.textContent || td.innerText;--}}
{{--                   if (txtValue.toUpperCase().indexOf(filter) > -1) {--}}
{{--                       tr[i].style.display = "";--}}
{{--                   } else {--}}
{{--                       tr[i].style.display = "none";--}}
{{--                   }--}}
{{--               }--}}
{{--           }--}}
{{--       }--}}
{{--   </script>--}}
@endsection
