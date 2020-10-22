<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #303030 !important;"
  id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('logo/teacher.png') }}" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">{{Auth::user()->user_role}}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="/home">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- check -->
  @if(Auth::user()->user_role == 'teacher')
  <!-- Heading -->
  <div class="sidebar-heading">
    class Attandance
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-eye"></i>
      <span>Show</span>
    </a>
    <div id="collapseSubjects" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Subjects:</h6>
        <a class="collapse-item" href="class_attendance">Attendance</a>
      </div>
    </div>
  </li>


  <!-- Heading -->
  <div class="sidebar-heading">
    classes
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClasses" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-eye"></i>
      <span>Show</span>
    </a>
    <div id="collapseClasses" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Classes:</h6>
        <a class="collapse-item" href="subject_classes">Show List</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- Heading -->
  <div class="sidebar-heading">
    Salary
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalary" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-eye"></i>
      <span>Show</span>
    </a>
    <div id="collapseSalary" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Salary:</h6>
        <a class="collapse-item" href="salary">Show </a>
      </div>
    </div>
  </li>





  <!-- Heading -->
  <div class="sidebar-heading">
    Attendance
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-eye"></i>
      <span>Show</span>
    </a>
    <div id="collapseAttendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Attendance:</h6>
        <a class="collapse-item" href="attendance">Show </a>
      </div>
    </div>
  </li>

  <!-- Heading -->
  <div class="sidebar-heading">
    Result
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResult" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-eye"></i>
      <span>Show</span>
    </a>
    <div id="collapseResult" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Result:</h6>
        <a class="collapse-item" href="class_result">Show </a>
      </div>
    </div>
  </li>
  @else

  @endif


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->