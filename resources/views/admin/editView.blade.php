<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    
    
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

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
                        @if(!Auth::guard('admin')->user())
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li><a class="nav-link" href="{{ url('admin/logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Logout
                            </a></li>

                            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
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
                            $id = Auth::guard('admin')->user()->adminID;
                        ?>
                            <a href="{{ url('admin/edit_view/'.$id) }}">
                                Edit personal information
                            </a>
                        </li>
                        <li role="presentation" style="padding:5px;">
                            <a href="{{ url('admin/edit_password_view/'.$id) }}">
                                Change password
                            </a>
                        </li>
                        <hr/>
                        <li role="presentation" style="padding:5px;">
                            <a href="{{ url('/admin') }}">
                                Manage instructors
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit personal information </div>
                @if(Session::has('Data_successfully_modified'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}" style="border-radius: 0 !important;">{{ Session::get('Data_successfully_modified') }}</p>
                @endif
                

                <div class="card-body">
                    <form method="POST" action="{{ url('admin/edit') }}">
                        @csrf

                        <input type="hidden"  name="adminID" value="{{$adminData->adminID}}"> 


                        <div class="form-group row">
                            <label for="admin_fName" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="admin_fName" type="text" class="form-control{{ $errors->has('admin_fName') ? ' is-invalid' : '' }}" name="admin_fName" value="{{ $adminData->admin_fName }}" required>

                                @if ($errors->has('admin_fName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('admin_fName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="admin_mName" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                            <div class="col-md-6">
                                <input id="admin_mName" type="text" class="form-control{{ $errors->has('admin_mName') ? ' is-invalid' : '' }}" name="admin_mName" value="{{ $adminData->admin_mName }}" required>

                                @if ($errors->has('admin_mName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('admin_mName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="admin_lName" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="admin_lName" type="text" class="form-control{{ $errors->has('admin_lName') ? ' is-invalid' : '' }}" name="admin_lName" value="{{ $adminData->admin_lName }}" required>

                                @if ($errors->has('admin_lName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('admin_lName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="admin_email" class="col-md-4 col-form-label text-md-right">Email</label>
                              
                                <!-- admin edit email -->
                            <div class="col-md-6">
                                <input id="admin_email" type="text" 
                                class="form-control{{ $errors->has('admin_email') ? ' is-invalid' : '' }}" 
                                name="admin_email" value="{{ $adminData->admin_email }}" required readonly>

                                @if ($errors->has('admin_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('admin_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                                <a class="btttn" href="{{url('/admin')}}">
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

