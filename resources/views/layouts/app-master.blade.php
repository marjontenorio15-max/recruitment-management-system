<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RMS | Recruitment Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('assets/img/Rms.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('assets/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('assets/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('assets/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('assets/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/vendors.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

    <!-- MODERNIZR MENU -->
    <script src="{{asset('assets/js/modernizr.js')}}"></script>



        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        {{--body{--}}
        {{--    background-repeat: no-repeat;--}}
        {{--    background-size: 1350px 1320px;--}}
        {{--    background-image:url({{asset('assets/img/background1.png')}});--}}

        {{--}--}}
    </style>


    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    @livewireStyles
</head>
<body>


@include('layouts.partials.navbar')

{{--<section class="parallax_window_in" data-parallax="scroll" data-image-src="{{asset('assets/img/recruitment.jpg')}}" data-natural-width="1400" data-natural-height="800">--}}
{{--    <div id="sub_content_in">--}}
{{--        <h1>About Potenza</h1>--}}
{{--        <p>"Usu habeo equidem sanctus no ex melius labitur conceptam eos"</p>--}}
{{--    </div>--}}
{{--</section>--}}
{{--<!-- /section -->--}}

@yield('content')




@include('layouts.footer')
<!-- COMMON SCRIPTS -->
<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/js/common_scripts.min.js')}}"></script>
<script src="{{asset('assets/js/velocity.min.js')}}"></script>
<script src="{{asset('assets/js/common_functions.js')}}"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{asset('assets/js/parallax.min.js')}}"></script>
<script src="{{asset('assets/js/owl-carousel.js')}}"></script>
<script>
    "use strict";
    $(".team-carousel").owlCarousel({
        items: 1,
        loop: false,
        margin: 10,
        autoplay: false,
        smartSpeed: 300,
        responsiveClass: false,
        responsive: {
            320: {
                items: 1,
            },
            768: {
                items: 2,
            },
            1000: {
                items: 3,
            }
        }
    });


</script>

<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@livewireScripts
</body>
</html>
