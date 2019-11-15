<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

                <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }
            .top-right {
                position: absolute;
                right: 100px;
                top: 18px;
            }
            

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .navbar{
                margin-bottom:0px !important;
            }
            .navbar-default{
                background-image: none !important;
                background-color: white;
            }

            .navbar-default {
                background-image: none !important;
                background-color: white;
                padding: 2px;
                font-weight: bold;
                font-size: 15px;
            }

            .navbar-header {
                margin-left: 25px !important;
            }
        </style>
    </head>
    <body>



            <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">My Virtual Patient</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('about') }}">About</a></li>
               

               
            </ul>
            

             <ul class="nav navbar-nav navbar-right">

                 @if(!Auth::guard('admin')->user() & !Auth::guard('instractor')->user() & !Auth::guard('student')->user())
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
                @if(!Auth::guard('admin')->user() & !Auth::guard('instractor')->user() & !Auth::guard('student')->user())

            <ul class="nav navbar-nav ">
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
            </ul>

            @endif


                @if(Auth::guard('admin')->user())

                <li><a href="{{ url('admin') }}">{{Auth::guard('admin')->user()->adminName}}</a></li>

                <li style="margin-top: 13px;"><span>|</span>

                <li><a style="color: red" class="dropdown-item" href="{{ url('admin/logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a></li>
                

                <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                  
                @endif

                @if(Auth::guard('instractor')->user())
                <li><a href="{{ url('instractor') }}">{{Auth::guard('instractor')->user()->instractorName}}</a></li>

                <li style="margin-top: 13px;"><span>|</span></li> 

                <li><a style="color: red" class="dropdown-item" href="{{ url('instractor/logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a></li>

                <form id="logout-form" action="{{ url('instractor/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                  
                @endif

                @if(Auth::guard('student')->user())
                <li><a href="{{ url('student') }}">{{Auth::guard('student')->user()->studentName}}</a></li>

                <li style="margin-top: 13px;"><span>|</span></li>  

                <li><a style="color: red" class="dropdown-item" href="{{ url('student/logout') }}"
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



        



        
        <div class="flex-center position-ref full-height">
        
        
            <div class="content">
                <div class="title m-b-md">
                    About Page
                </div>

               
            </div>
        </div>
    </body>
</html>
