<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Section</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        .nav.navbar-nav a {
            padding: 15px;
            color: #646464;
        }
        .nav.navbar-nav a:hover {
            text-decoration: none;
        }
        .dropdown-menu.show li {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .navbar-brand {
            margin-left: 3px;
            margin-right: 30px;
        }

        .btttn{
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: .9rem;
            line-height: 1.6;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            background-color: #d9d9d9;
            color: #464646;
                    }

    </style>
</head>
<body>
    <div id="app">

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">

                My Virtual Patient
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
                        <li><a style="color: #646464" href="{{ url('about') }}">
                        About
                        </a></li>
                    </ul>






                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(!Auth::guard('instractor')->user())
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a class="nav-link" href="{{ url('instractor/logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Logout
                            </a></li>

                            <form id="logout-form" action="{{ url('instractor/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
<div class="container">
     <div class="row">
        <div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
                    <ul class="nav" role="tablist" style="display: table;">
                        <li role="presentation" style="padding:5px;">
                        <?php
                            $id = Auth::guard('instractor')->user()->instractorID;
                        ?>
                            <a href="{{ url('instractor/edit_view/'.$id) }}">
                                Edit personal information
                            </a>
                        </li>
                        <li role="presentation" style="padding:5px;">
                            <a href="{{ url('instractor/edit_password_view/'.$id) }}">
                                Change password
                            </a>
                        </li>
                        <li role="presentation" style="padding:5px;">
                            <a href="{{ url('instractor/create_sections/'.$id) }}">
                                Create Section
                            </a>
                        </li>
                        <hr />
                        <li role="presentation" style="padding:5px;">
                                My Section
                        </li>
                        @if(count($my_section_data) > 0)
                        @foreach($my_section_data as $data)
                        <li role="presentation" style="padding:5px;margin-left:10px;color: #979797;">
                            <a href="{{ url('instractor/section/'.$data->sectionID) }}">
                                {{$data->section_name}}
                            </a>
                        </li>
                        @endforeach
                        @else
                        <li role="presentation" style="padding:5px;margin-left:10px;color: #979797;">
                            No data
                        </li>
                        @endif

                    </ul>
                </div>
    </div>
</div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Create Section</div>
                @if(Session::has('Data_successfully'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully') }}</p>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ url('section/edit_section_fun') }}">
                        @csrf

                        <input type="hidden"  name="sectionID" value="{{$SectionData->sectionID}}">


                        <div class="form-group row">
                            <label for="section_name" class="col-md-4 col-form-label text-md-right">Section name</label>

                            <div class="col-md-6">
                                <input id="section_name" type="text" class="form-control{{ $errors->has('section_name') ? ' is-invalid' : '' }}" name="section_name" value="{{ $SectionData->section_name }}" required autofocus>

                                @if ($errors->has('section_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('section_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="studentIDs" class="col-md-4 col-form-label text-md-right">Students Id</label>

                            <div class="col-md-6">
                        <textarea class="form-control{{ $errors->has('studentIDs') ? ' is-invalid' : '' }}" rows="4" cols="50"  name="studentIDs"  required>
{{ $SectionData->studentIDs }}
</textarea>
                        </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                                <a class="btttn" href="{{ redirect()->getUrlGenerator()->previous() }}">
                                    Back
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
       </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

