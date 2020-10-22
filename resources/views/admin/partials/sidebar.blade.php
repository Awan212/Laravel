<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="">
            <img src="{{ asset('logo/admin.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-2">{{Auth::user()->user_role}} </div>
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
    @if(Auth::user()->user_role == 'admin')
    <!-- Heading -->
    <div class="sidebar-heading">
        Courses
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjects"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-eye"></i>
            <span>Show</span>
        </a>
        <div id="collapseSubjects" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Courses:</h6>
                <a class="collapse-item" href="subjects">Courses List</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjectUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseSubjectUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="add_subjects">Add New Subjects</a>
            </div>
        </div>
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Classes & sections
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClass" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-eye"></i>
            <span>Show</span>
        </a>
        <div id="collapseClass" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Subjects:</h6>
                <a class="collapse-item" href="class_sections">Class & Section List</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClassUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseClassUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="add_class_sections">Add New Class & Section</a>
            </div>
        </div>
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Heading -->
    <div class="sidebar-heading">
        Students
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-eye"></i>
            <span>Show</span>
        </a>
        <div id="collapseStudent" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Subjects:</h6>
                <a class="collapse-item" href="students">All Student List</a>
                <a class="collapse-item" href="student_attendances">Student Attendance</a>
                <a class="collapse-item" href="student_fee">Student Fee</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudentUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseStudentUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="add_students">Add New Student</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Teachers
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeacher"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-eye"></i>
            <span>Show</span>
        </a>
        <div id="collapseTeacher" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Subjects:</h6>
                <a class="collapse-item" href="teachers">Teacher List</a>
                <a class="collapse-item" href="class_teachers">Clas Teacher List</a>
                <a class="collapse-item" href="subject_teachers">Subjects Teacher List</a>
                <a class="collapse-item" href="teacher_salaries">Teacher Salaries List</a>
                <a class="collapse-item" href="teacher_attendance">Teacher Attendance</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeacherUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseTeacherUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Action:</h6>
                <a class="collapse-item" href="add_teacher">Add New Teacher</a>
                <!--
            <a class="collapse-item" href="add_class_teacher">Add Class Teacher</a>
            <a class="collapse-item" href="add_subject_teacher">Add Subject Teacher</a>
            -->
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Result
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResult"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-eye"></i>
            <span>Show</span>
        </a>
        <div id="collapseResult" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Result:</h6>
                <a class="collapse-item" href="class_results">All Classes Result</a>
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
