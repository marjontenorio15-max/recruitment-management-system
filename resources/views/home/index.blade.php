@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            @if(auth()->check())
                <h1>Hello {{ auth()->user()->username }}</h1>
                <p class="lead">Have a good Day!</p>
            @endif
        @endauth

        @guest
            <h1>Homepage</h1>
                <a href="" class="btn btn-outline-primary"><i class="icon-home"></i></a>
            <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
