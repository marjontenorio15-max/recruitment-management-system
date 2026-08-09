
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/signin.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>


    <style>
        /*.bd-placeholder-img {*/
        /*    !*font-size: 1.125rem;*!*/
        /*    text-anchor: middle;*/
        /*    -webkit-user-select: none;*/
        /*    -moz-user-select: none;*/
        /*    user-select: none;*/
        /*}*/

        /*@media (min-width: 768px) {*/
        /*    .bd-placeholder-img-lg {*/
        /*        font-size: 3.5rem;*/
        /*    }*/
        /*}*/
    </style>


    <!-- Custom styles for this template -->
{{--    <link href="signin.css" rel="stylesheet">--}}
    <link href="{{asset('assets/css/signin.css')}}" rel="stylesheet">

</head>
<body class="bg-light text-center">

<main class="form-signin shadow bg-white">

    @yield('content')

</main>


</body>
</html>
