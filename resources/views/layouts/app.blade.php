<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        html {
            /*overflow-y: scroll;*/
            /*overflow-x: scroll;*/
        }

        .nav.navbar-nav a {
            padding: 15px;
            color: #646464;
        }
        .nav.navbar-nav a:hover {
            text-decoration: none;
            color: #474747;
        }
        .dropdown-menu.show li {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .navbar-brand {
            margin-left: 3px;
            margin-right: 30px;
        }
        .title {
            color: dodgerblue;
        }


    </style>

</head>
<body>
<div id="app">

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">

            <a class="navbar-brand title" href="{{ url('/') }}">

                <span class="title">My Virtual Patient</span>
                <!--
                <img src="C:\Users\LENOVO\Desktop\MVP\logo.png" >
                -->

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li><a style="color: #646464; text-decoration: none" href="{{ url('about') }}">
                            About
                        </a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">

                    @if(!Auth::guard('admin')->user() || !Auth::guard('instractor')->user() || !Auth::guard('student')->user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Login
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @if(!Auth::guard('admin')->user())
                                    <li><a href="{{ url('admin/login') }}">Admin</a></li>
                                @endif
                                @if(!Auth::guard('instractor')->user())
                                    <li><a href="{{ url('instractor/login') }}">Instractor</a></li>
                                @endif
                                @if(!Auth::guard('student')->user())
                                    <li><a href="{{ url('student/login') }}">Students</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif


                    @if(!Auth::guard('instractor')->user() || !Auth::guard('student')->user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Register
                                <span class="caret"></span></a>

                            <ul class="dropdown-menu">
                                @if(!Auth::guard('instractor')->user())
                                    <li><a href="{{ url('instractor/register') }}">Instractor</a></li>
                                @endif
                                @if(!Auth::guard('student')->user())
                                    <li><a href="{{ url('student/register') }}">Students</a></li>
                                @endif
                            </ul>

                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
