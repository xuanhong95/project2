<nav class="navbar navbar-default navbar-static-top" style="position:fixed;width:100%;top: 0;background-image: url(/images/bg-header.jpg)">
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
                            <li><a href="{{ route('teacher-marking') }}">Marking</a></li>
                            <li><a href="{{ route('teacher-edit-point') }}">Edit Point</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- navbar for ENTERPRISE INSTRUCTOR -->
                @elseif(\Auth::user()->user_type==2)
                

                <!-- navbar for ENTERPRISE -->
                @elseif(\Auth::user()->user_type==3)
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
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
                            <li><a href="{{ route('manager-edit-point') }}">Remarking</a></li>
                            <li><a href="{!! route('seasons') !!}">Seasons</a></li>
                            <li><a href="{{ route('manager-allocate')}}">Allocating</a></li>
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
                            <li><a href="/system-manager/manage-account">Account Management</a></li>
                        </ul>
                    </li>
                </ul>

                @elseif(\Auth::user()->user_type==6)
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

                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Teacher <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('teacher-marking') }}">Marking</a></li>
                            <li><a href="{{ route('teacher-edit-point') }}">Edit Point</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Instructor <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! route('instructor-students') !!}">Manage students</a></li>
                            <li><a href="{{ route('timekeeping') }}">Timekeeping</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Enterprise <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! route('enterprise-recruitment') !!}">Show Recruitments</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Internship Manager <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('manager-edit-point') }}">Remarking</a></li>
                            <li><a href="{!! route('seasons') !!}">Seasons</a></li>
                            <li><a href="{{ route('manager-allocate')}}">Allocating</a></li>
                            <li><a href="{!! route('manager-recruitments') !!}">Company Recruitments</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            System Manager <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/system-manager/manage-account">Account Management</a></li>
                        </ul>
                    </li>
                </ul>
                @endif

                <!-- DEFAULT navbar  -->
                @if(\Auth::user()->user_type != 6)
                <ul class="nav navbar-nav">
                    <li class=dropdown>
                        <a role="button" aria-expand="false" class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white;">
                            Internship <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{!! route('students-in-season')!!}">Students</a></li>
                            <li><a href="{!! route('companies-in-season')!!}">Companies</a></li>
                            <li><a href="{!! route('view-topics') !!}">Topics</a></li>
                            <li><a href="{!! route('allocations') !!}">Allocations</a></li>
                            <li><a href="{{ route('timesheet') }}">Timesheet</a></li>
                            <li><a href="{{route('view-result')}}">Result</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
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
                            @if(\Auth::user()->user_type == 6)
                            <li><a href="{!! route('students-in-season')!!}">Students</a></li>
                            <li><a href="{!! route('companies-in-season')!!}">Companies</a></li>
                            <li><a href="{!! route('view-topics') !!}">Topics</a></li>
                            <li><a href="{!! route('allocations') !!}">Allocations</a></li>
                            <li><a href="{{ route('timesheet') }}">Timesheet</a></li>
                            <li><a href="{{route('view-result')}}">Result</a></li>
                            @endif
                            <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>