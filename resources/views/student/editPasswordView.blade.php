<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Students</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        .nav.navbar-nav a {
            /*padding: 15px;*/
            color: #646464;
        }
        .nav.navbar-nav a:hover {
            text-decoration: none;
        }
        .dropdown-menu.show li {
            padding-top: 5px;
            padding-bottom: 5px;
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

       .navv li {
            list-style-type: none;
            margin-left: -30px;
        }

    </style>
</head>
<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Brand
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <ul class="nav navbar-nav">
                        <li><a href="{{ url('about') }}">About</a></li>
               


            </ul>
                    </ul>

                  

            <ul class="nav navbar-nav navbar-right">

                 @if(!Auth::guard('student')->user())
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a class="nav-link" href="{{ url('student/logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Logout
                            </a></li>

                            <form id="logout-form" action="{{ url('student/logout') }}" method="POST" style="display: none;">
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
                            $id = Auth::guard('student')->user()->studentID;
                        ?>
                            <a href="{{ url('student/edit_view/'.$id) }}">
                                Edit personal information
                            </a>
                        </li>


                        <li role="presentation" style="padding:5px;">
                            <a href="{{ url('student/edit_password_view/'.$id) }}">
                                Change password
                            </a>
                        </li>

                        <hr />

                        
                        <li role="presentation" style="padding:5px;">
                        
                            <a href="{{ url('/student') }}">
                                My sections
                            </a>

                           
                        </li>



                    </ul>


                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit Password </div>
                @if(Session::has('Data_successfully_modified_password'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully_modified_password') }}</p>
                @endif

                @if(Session::has('error_password_old'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="border-radius: 0 !important;">{{ Session::get('error_password_old') }}</p>
                @endif
                

                <div class="card-body">
                    <form method="POST" action="{{ url('student/edit_password') }}">
                        @csrf

                        <input type="hidden"  name="studentID" value="{{$studentData->studentID}}"> 


                        <div class="form-group row">
                            <label for="password_old" class="col-md-4 col-form-label text-md-right">Old Password</label>

                            <div class="col-md-6">
                                <input id="password_old" type="password" class="form-control{{ $errors->has('password_old') ? ' is-invalid' : '' }}" name="password_old" required>

                                @if ($errors->has('password_old'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_old') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div> 

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                                <a class="btttn" href="{{ url('/student') }}">
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

