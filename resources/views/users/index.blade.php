@extends('layouts.app-master')
@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="container">
        <div class="card shadow m-3">
            <div class="card-header bg-primary text-center">
                <h2 class="text-white">List of Users</h2>
            </div>
            <div class="card-body">
                {{--                    <a href="" class="btn btn-outline-primary shadow  icon-list-add">Add Users</a>--}}
                <div class="container-fluid">
                    <div class="row col-6 float-end">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend shadow">
                                <span class="input-group-text icon-search bg-success text-white" id="basic-addon1"></span>
                            </div>
                            <input type="text" class="form-control shadow" id="searchAll" onkeyup="myFunctionSearch()" placeholder="Search for .." aria-label="searchAll" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    {{--                            <div class="m-3">--}}
                    {{--                                <button class="btn btn-success send-email">Send Email</button>--}}
                    {{--                            </div>--}}
                    <table class="table table-bordered data-table shadow" id="myTable">
                        <thead>
                        <tr class="">
                            {{--                                    <th></th>--}}
                            <th scope="col">User Role</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Username</th>
                            {{--                                    <th scope="col">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        {{--                                @php--}}
                        {{--                                    //                                    $users = DB::table('users')->orderBy('role_id')->get();--}}
                        {{--                                                                         $users =  DB::table('users')->select("*")->orderBy('role_id')--}}
                        {{--                                                                            ->simplePaginate(10);--}}
                        {{--                                @endphp--}}

                        @foreach($users as $user)

                            <tr>
                                {{--                                        <td><input type="checkbox" class="user-checkbox" name="users[]" value="{{ $user->id }}"></td>--}}
                                <td>
                                    @if($user->role_id == 1)
                                        Admin
                                    @elseif($user->role_id == 2)
                                        Employer
                                    @else
                                        Applicant
                                    @endif
                                </td>
                                <td>{{ $user->email}}</td>
                                <td>{{($user->username)}}</td>
                                {{--                                        <td>--}}
                                {{--                                            <form action="" method="POST">--}}
                                {{--                                                <a class="btn btn-outline-info shadow icon-eye-7"></a>--}}
                                {{--                                                <a class="btn btn-outline-primary shadow  icon-edit"></a>--}}
                                {{--                                                <button type="submit" class="btn btn-outline-danger shadow icon-trash"></button>--}}
                                {{--                                            </form>--}}
                                {{--                                        </td>--}}
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <div class="float-end shadow">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunctionSearch() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchAll");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            // for (i = 0; i < tr.length; i++) {
            //     td = tsr[i].getElementsByTagName("td")[0];
            //     if (td) {
            //         txtValue = td.textContent || td.innerText;
            //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //             tr[i].style.display = "";
            //         } else {
            //             tr[i].style.display = "none";
            //
            //         }
            //     }
            // }
            for (i = 1; i < tr.length; i++) {
                // Hide the row initially.
                tr[i].style.display = "none";

                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    cell = tr[i].getElementsByTagName("td")[j];
                    if (cell) {
                        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
{{--    <script type="text/javascript">--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $(".send-email").click(function(){--}}
{{--            var selectRowsCount = $("input[class='user-checkbox']:checked").length;--}}

{{--            if (selectRowsCount > 0) {--}}

{{--                var ids = $.map($("input[class='user-checkbox']:checked"), function(c){return c.value; });--}}

{{--                $.ajax({--}}
{{--                    type:'POST',--}}
{{--                    url:"{{ route('ajax.send.email') }}",--}}
{{--                    data:{ids:ids},--}}
{{--                    success:function(data){--}}
{{--                        alert(data.success);--}}
{{--                    }--}}
{{--                });--}}

{{--            }else{--}}
{{--                alert("Please select at least one user from list.");--}}
{{--            }--}}
{{--            console.log(selectRowsCount);--}}
{{--        });--}}

{{--    </script>--}}

@endsection

