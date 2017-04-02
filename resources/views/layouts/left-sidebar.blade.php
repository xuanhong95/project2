
<link rel="stylesheet" href="/css/sidebar.css">
<!-- Sidebar -->
  <div id="sidebar-wrapper" class=" col-md-3 pull-left">
      <!-- navbar for STUDENT -->
      @if(\Auth::user()->user_type==0)
      <ul class="sidebar-nav">
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
      <ul class="sidebar-nav">
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
      <ul class="sidebar-nav">
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
      <ul class="sidebar-nav">
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
      <ul class="sidebar-nav">
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
  <ul class="sidebar-nav">
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
  <ul class="sidebar-nav">
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

  </div>
