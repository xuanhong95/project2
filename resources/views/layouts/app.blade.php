<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/logonho.png">
    <title> SIE Internship Manager</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
    body{
        font-family:  'Segoe UI'
    }
    .fa-btn {
        margin-right: 6px;
    }
    .navbar-default{
        background-image: url(/images/bg-header.jpg);
    }
    #app-layout{
        background: rgba(228, 228, 228, 1.48);;
        background-size: 100%;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
        background-color: #bf3f3f;
    }
    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
        background-color: rgba(189, 218, 214, 0.59);
    }

    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="position:fixed;width:100%;top: 0">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                    SIE Internship Manager
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(\Auth::guest())

                @else
                @if(\Auth::user()->user_type==0)
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Student <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/add-info/show-cv/1">CV</a></li>
                            <li><a href="/student-report">Report</a></li>
                            <li><a href="#">Feedback</a></li>
                        </ul>
                    </li>
                </ul>

                @elseif(\Auth::user()->user_type==1)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Instructor Teacher <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Marking</a></li>
                        </ul>
                    </li>
                </ul>

                @elseif(\Auth::user()->user_type==2)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise Instructor <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Marking</a></li>
                        </ul>
                    </li>
                </ul>


                @elseif(\Auth::user()->user_type==3)
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Internship Registration</a></li>
                        </ul>
                    </li>
                </ul>

                @elseif(\Auth::user()->user_type==4)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Internship Manager <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/teacher/seasons">Seasons</a></li>
                            <li><a href="#">Internship Schedule</a></li>
                            <li><a href="#">Score</a></li>
                        </ul>
                    </li>
                </ul>

                @elseif(\Auth::user()->user_type==5)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            System Manager <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Config</a></li>
                        </ul>
                    </li>
                </ul>
                @endif

                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Internship <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Students</a></li>
                            <li><a href="#">Companies</a></li>
                            <li><a href="#">Topics</a></li>
                            <li><a href="#">Result</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('auth/login') }}" style="color:white;">Login</a></li>
                    <li><a href="{{ url('auth/register') }}" style="color:white;">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white;">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/add-info/show-profile"><i class=""></i>Profile</a></li>
                            <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    @extends('layouts.footer')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
