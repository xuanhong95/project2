<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
        font-family:  'Segoe UI';
    }
    .fa-btn {
        margin-right: 6px;
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
    <nav class="navbar navbar-default navbar-static-top" style="position:fixed;width:100%;top: 0;background-image: url(/images/bg-header.jpg)">
        <div class="container-fluid">
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
                <!-- navbar for STUDENT -->
                @if(\Auth::user()->user_type==0)
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Student <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/add-info/show-cv/{{\Auth::user()->id}}">CV</a></li>
                            <li><a href="{!! route('student-report') !!}">Report</a></li>
                            <li><a href="{!! route('student-feedback') !!}">Feedback</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- navbar for INSTRUCTOR TEACHER -->
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
                <!-- navbar for ENTERPRISE INSTRUCTOR -->
                @elseif(\Auth::user()->user_type==2)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise Instructor <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Marking</a></li>
                            <li><a href="{!! route('instructor-students') !!}">Manage students</a></li>
                            <li><a href="#">Timekeeping</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- navbar for ENTERPRISE -->
                @elseif(\Auth::user()->user_type==3)
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! route('create-recruitment') !!}">Create new recruitment</a>                                    </li>
                            <li><a href="{!! route('enterprise-recruitment') !!}">Show Recruitments</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- navbar for INTERNSHIP MANAGER -->
                @elseif(\Auth::user()->user_type==4)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Internship Manager <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! route('seasons') !!}">Seasons</a></li>
                            <li><a href="#">Internship Schedule</a></li>
                            <li><a href="#">Score</a></li>
                        </ul>
                    </li>
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Companies <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="{!! route('manager-recruitments') !!}">Recruitments</a></li>
                    </ul>
                </li>
            </ul>

            <!-- navbar for SYSTEM MANAGER -->
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

            <!-- DEFAULT navbar  -->
            <ul class="nav navbar-nav">
                <li class=dropdown>
                    <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                        Internship <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{!! route('students-in-season')!!}">Students</a></li>
                        <li><a href="{!! route('companies-in-season')!!}">Companies</a></li>
                        <li><a href="{!! route('view-topics') !!}">Topics</a></li>
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
                        <li><a href="{!! route('profile') !!}"><i class=""></i>Profile</a></li>
                        <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div style="min-height:100%">
    <div class="" >
        @yield('content')
    </div>
    <div class="col-md-10 pull-right">
        @yield('content-with-sidebar')
    </div>
</div>


<div class="col-md-12" >
    <!--footer start from here-->
    <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    <style >
      .copyright { min-height:40px; background-color:#000000;}
      .copyright p { text-align:left; color:#FFF; padding:10px 0; margin-bottom:0px;}
      .container {
        min-height: 100%;
      }
      .footer {
        margin-top: 30px;
        position: absolute;
        right: 0;
        left: 0;
        background-color: #efefef;
        text-align: center;
      }
    </style>
    <div class="footer">
      <footer style="background-image:url('/images/footersievn.png'); background-repeat:repeat-x;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 col-sm-6 footerleft ">

              <p><i class="fa fa-map-pin"></i>Address: Room 201, D7 Building, HUST | No.1, Dai Co Viet Street, Hanoi, Vietnam.</p>
              <p><i class="fa fa-phone"></i>Tel:(+84)04.3868.3407 & 3868.2261 | Fax:(+84)04.3868.3409</p>
              <p><i class="fa fa-envelope"></i>Email: info@sie.edu.vn | Website: http://sie.hust.edu.vn</p>

            </div>

            <div class="col-md-3 col-sm-3 paddingtop-bottom " >
              <div class="fb-page" data-href="https://www.facebook.com/sie.hust.edu.vn/" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <div class="fb-xfbml-parse-ignore">
                  <blockquote cite="https://www.facebook.com/sie.hust.edu.vn/"><a href="https://www.facebook.com/sie.hust.edu.vn/">Facebook</a></blockquote>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 paddingtop-bottom">
              <div class="logofooter" > <img src="/images/logonho.png" alt="sie_logo"></div>
            </div>
          </div>
        </div>
      </footer>
      <!--footer start from here-->

      <div class="copyright" style="height:50px">
        <div class="container">
          <div class="col-md-6">
            <p>Copyright© School of International Education | HUST</p>
          </div>
          <div class="col-md-6">
            <p>Powered by: Students</p>
          </div>
        </div>
      </div>
    </div>

</div>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
