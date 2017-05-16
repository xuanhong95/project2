
<link rel="stylesheet" href="/css/sidebar.css">
<!-- Sidebar -->
<div id="sidebar" class="col-md-2">
<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav text-center" style="min-width:220px;">
                @if(\Auth::user()->user_type==0)
                <li class="dropdown">
                    <a role="button" href="#" data-toggle="collapse" data-target="#student">
                        Student <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="student">
                        <li><a href="/add-info/show-cv/{{\Auth::user()->id}}" >CV</a></li>
                        <li><a href="{!! route('student-report') !!}">Report</a></li>
                        <li><a href="{!! route('student-feedback') !!}">Feedback</a></li>
                    </ul>
                </li>
                <!-- navbar for INSTRUCTOR TEACHER -->
                @elseif(\Auth::user()->user_type==1)
                <li class=dropdown>
                    <a role="button" href="#" data-toggle="collapse" data-target="#teacher">
                        Instructor Teacher <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="teacher">
                        <li><a href="#">Marking</a></li>
                    </ul>
                </li>

                <!-- navbar for ENTERPRISE INSTRUCTOR -->
                @elseif(\Auth::user()->user_type==2)

                <li class=dropdown>
                    <a role="button" data-toggle="collapse" href="#" data-target="#instructor">
                        Enterprise Instructor <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="instructor">
                        <li><a href="#">Marking</a></li>
                        <li><a href="{!! route('instructor-students') !!}">Manage students</a></li>
                        <li><a href="{{ route('timekeeping') }}">Timekeeping</a></li>
                    </ul>
                </li>


                <!-- navbar for ENTERPRISE -->
                @elseif(\Auth::user()->user_type==3)

                <li class="dropdown">
                    <a role="button" data-toggle="collapse" href="#" data-target="#enterprise">
                        Enterprise <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="enterprise">
                        <li><a href="{!! route('create-recruitment') !!}">Create new recruitment</a>                                    </li>
                        <li><a href="{!! route('enterprise-recruitment') !!}">Show Recruitments</a></li>
                    </ul>
                </li>


                <!-- navbar for INTERNSHIP MANAGER -->
                @elseif(\Auth::user()->user_type==4)

                <li class=dropdown>
                    <a role="button" data-toggle="collapse" href="#" data-target="#manager">
                        Internship Manager <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="manager">
                        <li><a href="{!! route('seasons') !!}">Seasons</a></li>
                        <li><a href="#">Internship Schedule</a></li>
                        <li><a href="#">Score</a></li>
                    </ul>
                </li>
                <li class=dropdown>
                    <a role="button" data-toggle="collapse" href="#" data-target="#manager_company">
                        Companies <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="manager_company">
                        <li><a href="{!! route('manager-recruitments') !!}">Recruitments</a></li>
                    </ul>
                </li>


                <!-- navbar for SYSTEM MANAGER -->
                @elseif(\Auth::user()->user_type==5)

                <li class=dropdown>
                    <a role="button" data-toggle="collapse" href="#" data-target="#system_manager">
                        System Manager <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="system_manager">
                        <li><a href="#">Users</a></li>
                        <li><a href="#">Config</a></li>
                    </ul>
                </li>

                @endif

                <!-- DEFAULT navbar  -->

                <li class=dropdown>
                    <a role="button" data-toggle="collapse" href="#" data-target="#internship">
                        Internship <span class="caret"></span>
                    </a>
                    <ul class="collapse forAnimate" id="internship">
                        <li><a href="{!! route('students-in-season')!!}">Students</a></li>
                        <li><a href="{!! route('companies-in-season')!!}">Companies</a></li>
                        <li><a href="{!! route('view-topics') !!}">Topics</a></li>
                        <li><a href="{!! route('allocations') !!}">Allocations</a></li>
                        <li><a href="{{ route('timesheet') }}">Timesheet</a></li>
                        <li><a href="#">Result</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
</div>
