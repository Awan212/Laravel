

<!-- Sidebar -->
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('logo/student.png') }}" alt="">
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
    @if(Auth::user()->user_role == 'student')
      <!-- Heading -->
      <div class="sidebar-heading">
        Attandance
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-eye"></i>
          <span>Show</span>
        </a>
        <div id="collapseSubjects" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Subjects:</h6>
            <a class="collapse-item" href="student_attendance">Attendance List</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Heading -->
      <div class="sidebar-heading">
        Fee Voucher
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVoucher" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-eye"></i>
          <span>Show</span>
        </a>
        <div id="collapseVoucher" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Fee Voucher:</h6>
            <a class="collapse-item" href="student_fee_voucher">Fee Voucher </a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Heading -->
      <div class="sidebar-heading">
        Result
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResult" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-eye"></i>
          <span>Show</span>
        </a>
        <div id="collapseResult" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Result:</h6>
            <a class="collapse-item" href="student_result">Result </a>
          </div>
        </div>
      </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->