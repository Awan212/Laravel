@extends('admin.layouts.app')


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Students</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data)
                            {{$data['students']}}
                            @endisset
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Teachers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data)
                            {{$data['teachers']}}
                            @endisset
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Classes</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @isset($data)
                                    {{$data['classes']}}
                                    @endisset
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data['users'])
                            {{ $data['users'] }}
                            @endisset
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row notification">
    <div class="col-sm-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left">Today Teacher Attendance</h3>
                <button class="btn btn-success btn-mark-teacher-attendance float-right ml-2">Mark Teacher
                    Attendance</button>
                <button class="btn btn-primary btn-print-today-teacher-attendance  float-right">Print</button>
            </div>
            <div class="card-body">
                <div id="TeacherAttandance"></div>
            </div>
        </div>
    </div>
</div>


<div class="row notification mt-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left">Late Fee Student List</h3>
                <button class="btn float-right btn-primary btn-print-late-fee">Print</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered late-fee-students table-sm" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Roll No</th>
                                <th>Class & Section</th>
                                <th>Fee</th>
                                <th>Fee of Month</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Roll No</th>
                                <th>Class & Section</th>
                                <th>Fee</th>
                                <th>Fee of Month</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data['late_fee'] as $key => $lateFee)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <th>{{ $lateFee->student_fees->students->student_name }}</th>
                                <th>#{{ $lateFee->student_fees->students->student_roll_no }}</th>
                                <th>{{ $lateFee->student_fees->students->class->class_title}} |
                                    {{ $lateFee->student_fees->students->class->section_name}}</th>
                                <th>Rs.{{ $lateFee->fee_amount }}</th>
                                <th>{{ \Carbon\Carbon::parse($lateFee->fee_of_month)->toFormattedDateString() }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left">Struck Off Student</h3>
                <button class="btn btn-primary btn-print-struck-off float-right">Print</button>
            </div>
            <div class="card-body">
                <div id="StruckOffStudent"></div>
            </div>
        </div>
    </div>
</div>

<!-- edit struck Off Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateStudentProfileFrom" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="student_id" id="student_id">
                    <div class="file-upload w-25 m-auto">
                        <img src="" id="student_profile" width="100%" height="100%" />
                    </div>
                    <input type="file" name="editStudentProfile" id="editStudentProfile"
                        accept="image/gif, image/jpeg, image/png" class="form-control w-25 m-auto" />

                    <div id="message" class="mt-2"></div>

                    <div class="form-group-row">
                        <div class="col-sm-6 m-auto">
                            <label for="name">Roll No:</label>
                            <input type="text" name="roll_no" id="roll_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="father_name">Father Name:</label>
                            <input type="text" name="father_name" id="father_name" class="form-control">
                        </div>
                    </div>

                    <div class="from-group row">
                        <div class="col-sm-6">
                            <label for="class">Class & Sections:</label>
                            <select name="class_section" id="class_section" class="form-control">
                                @foreach($data['class'] as $class)
                                <option id="class{{$class->id}}" value="{{ $class->id }}">{{ $class->class_title }} --
                                    {{ $class->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="nic">CNIC #:</label>
                            <input type="text" name="cnic" id="cnic" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="dob">date of Birh</label>
                            <input type="date" name="dob" id="dob" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" id="disabled" disabled selected hidden>Choose Gender</option>
                                <option id="male" value="male">Male</option>
                                <option id="female" value="female">Female</option>
                                <option id="other" value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="address">Addres:</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="for">Religion</label>
                            <select name="religion" id="religion" class="form-control">
                                <option value="" disabled selected hidden>Choose Religion</option>
                                <option id="islam" value="islam">Islam</option>
                                <option id="other-religion" value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="guardian_name">Guardian Name:</label>
                            <input type="text" id="guardian_name" class="form-control" name="guardian_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="guardian_cnic">Guardian CNIC:</label>
                            <input type="text" name="guardian_cnic" id="guardian_cnic" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="guardian_phone_no">Guardian Phone #</label>
                            <input type="text" name="guaridan_phone" id="guardian_phone" class="form-control">
                        </div>
                    </div>

                    <label for="Guardian_occoption">Guardian Occoption</label>
                    <input type="text" name="guardian_occopa" id="guardian_occopa" class="form-control">

                    <label for="Leave">Leaved</label>
                    <select name="student_status" id="student_status" class="form-control">
                        <option id="yesLeave" value="0">Yes</option>
                        <option id="notLeaved" value="1">No</option>
                    </select>

                    <label for="struckOff">Struck Off</label>
                    <select name="struck_off" id="struck_off" class="form-control">
                        <option id="yesStruckOff" value="1">Yes</option>
                        <option id="notStruckOff" value="0">No</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-success update-btn">Procced</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit struck off Modal -->

<!-- edit teacher attendance Modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_teacher_attendance">
                <div class="modal-body">
                    <div id="updateAttendanceMessage"></div>
                    @csrf
                    <input type="hidden" name="attendance_id" id="attendance_id">
                    <input type="hidden" name="teacher" id="teacher">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="teacher_name">Teacher:</label>
                            <input type="text" name="teacher_name" id="teacher_name" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label for="teacher_id">Teacher Id:</label>
                            <input type="text" name="teacher_id" id="teacher_id" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="attendance_date">Attendance Date:</label>
                            <input type="date" name="attendance_date" id="attendance_date" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="attendance">Attendance</label>
                            <select name="attendance" id="attendance" class="form-control">
                                <option value="" selected disabled hidden>Attedance</option>
                                <option value="present" id="present">Present</option>
                                <option value="absent" id="absent">Absent</option>
                                <option value="leave" id="leave">Leave</option>
                                <option value="late" id="late">Late</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit teacher attendance Modal -->


<!-- teacher attendance Modal -->
<div class="modal fade" id="markTeacherAttendanceModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mark Teacher Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mark_all_teacher_attendance">
            <div class="modal-body">
                <div id="markTeacherAttendanceMessage"></div>
                @csrf
                @foreach($data['teacher_list'] as $teacherList)
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="hidden" name="attendance_teacher_id[]" value="{{ $teacherList->id }}">
                        <label for="teacher">Teacher:</label>
                        <input type="text" value="{{ $teacherList->teacher_name }} #{{ $teacherList->teacher_id }}""  class="form-control" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="attendance_date">Attendance Date:</label>
                        <input type="date" name="attendance_date[]"  value="{{ date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="attendance">Attendance</label>
                        <select name="teacher_attendance[]" class="form-control custom-select">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="leave">Leave</option>
                            <option value="late">Late</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Mark Attendance</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- teacher attendance Modal -->
@endsection

@section('script')

<script>
    $(document).ready(function () {
        $("#dataTable2").dataTable();

        $("#TeacherAttandance").load('today_teacher_attendance_list');
        $("#StruckOffStudent").load('struck_off_student_list');

        $(".btn-print-late-fee").on('click', function () {
            $(".late-fee-students").printThis({});
        });

        $(".btn-print-struck-off").on('click', function () {
            $(".struck-off-student").printThis();
        });

        $(".btn-print-today-teacher-attendance").on('click', function () {
            $(".today-teacher-attendance").printThis();
        });

        $(".btn-mark-teacher-attendance").on('click',function(){
            $("#markTeacherAttendanceMessage").html('');
            $("#markTeacherAttendanceMessage").removeClass();
            $("#mark_all_teacher_attendance")[0].reset();
            $("#markTeacherAttendanceModal").modal('show');
        });

        $("#mark_all_teacher_attendance").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'mark_all_teacher_attendance',
                method: 'post',
                data: new FormData(this),
                processData:false,
                dataTable: 'JSON',
                contentType:false,
                cache:false,
                beforeSend:function(){
                    $("#markTeacherAttendanceMessage").html('');
                    $("#markTeacherAttendanceMessage").removeClass();
                },
                success:function(data)
                {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#markTeacherAttendanceMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#markTeacherAttendanceMessage").addClass(data.class);
                    }
                    else {
                        $("#markTeacherAttendanceMessage").append(data.message);
                        $("#markTeacherAttendanceMessage").addClass(data.class);
                        $("#TeacherAttandance").load('today_teacher_attendance_list');
                    }
                }
            })
        });

        $(document).on('click', '.btn-edit-teacherAttendance', function () {
            $("#updateAttendanceMessage").html('');
            $("#updateAttendanceMessage").removeClass();
            $(".btn-update").html('Save changes');
            $.ajax({
                url: 'edit_teacher_attendance',
                'method': 'get',
                data: {
                    attendance_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#attendance_id").val(data.id);
                    $("#teacher").val(data.teachers.id);
                    $("#teacher_name").val(data.teachers.teacher_name);
                    $("#teacher_id").val('#' + data.teachers.teacher_id);
                    $("#attendance_date").val(data.attendance_date);
                    if (data.attendance == 'present') {
                        $("#late").attr('selected', false);
                        $("#leave").attr('selected', false);
                        $("#absent").attr('selected', false);
                        $("#present").attr('selected', true);
                    }
                    else if (data.attendance == 'absent') {
                        $("#late").attr('selected', false);
                        $("#leave").attr('selected', false);
                        $("#absent").attr('selected', false);
                        $("#present").attr('selected', false);
                        $("#absent").attr('selected', true);

                    }
                    else if (data.attendance == 'leave') {
                        $("#late").attr('selected', false);
                        $("#absent").attr('selected', false);
                        $("#present").attr('selected', false);
                        $("#absent").attr('selected', false);
                        $("#leave").attr('selected', true);
                    }
                    else {
                        $("#absent").attr('selected', false);
                        $("#present").attr('selected', false);
                        $("#absent").attr('selected', false);
                        $("#leave").attr('selected', false);
                        $("#late").attr('selected', true);
                    }
                }
            });
            $("#editTeacherModal").modal('show');
        });


        $("#update_teacher_attendance").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_teacher_attendance',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#updateAttendanceMessage").html('');
                    $("#updateAttendanceMessage").removeClass();
                    $(".btn-update").html('Saving changes ...');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#updateAttendanceMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateAttendanceMessage").addClass(data.class);
                        $(".btn-update").html("Not Update");
                    }
                    else {
                        $("#updateAttendanceMessage").append(data.message);
                        $("#updateAttendanceMessage").addClass(data.class);
                        $(".btn-update").html("Updated");
                        $("#TeacherAttandance").load('today_teacher_attendance_list');
                    }
                }
            });
        });

        $(document).on('click', '.btn-edit-student', function () {
            $("#message").html('');
            $("#message").removeClass('alert alert-danger');
            $("#message").removeClass('alert alert-success');
            var student_roll = $(this).attr('data-id');
            $.ajax({
                url: 'edit_student',
                method: 'get',
                data: { student_roll_no: student_roll },
                success: function (data) {
                    $("#student_id").val(data.id);
                    $("#student_profile").attr('src', data.student_profile_pic);
                    $("#roll_no").val(data.student_roll_no);
                    $("#name").val(data.student_name);
                    $("#father_name").val(data.student_father_name);
                    $("#class_section").attr('selected', false);
                    $("#class" + data.class_sections_id).attr('selected', true);
                    // $("#class_section").append('<option value="' + data.class_sections_id + '" selected>' + data.class.class_title + ' --  ' + data.class.section_name + '</option>');
                    $("#cnic").val(data.student_cnic);
                    $("#email").val(data.student_email);
                    $("#dob").val(data.dob);
                    if (data.student_gender == 'male') {
                        $("#male").attr('selected', true);
                    } else if (data.student_gender == 'female') {
                        $("#female").attr('selected', true);
                    }
                    else {
                        $("#other").attr('selected', true);
                    }
                    $("#address").val(data.student_address);
                    if (data.student_religion == 'islam') {
                        $("#islam").attr('selected', true);
                    }
                    else if (data.student_religion == 'other') {
                        $("#other-religion").attr('selected', true);
                    }
                    $("#guardian_name").val(data.student_guardian_name);
                    $("#guardian_cnic").val(data.student_guardian_cnic);
                    $("#guardian_phone").val(data.student_guardian_phone_no);
                    $("#guardian_occopa").val(data.student_guardian_occopation)
                    if (data.is_active == 1) {
                        $("#yesLeave").attr('selected', false);
                        $("#notLeaved").attr('selected', true);
                    }
                    else {
                        $("#notLeaved").attr('selected', false);
                        $("#yesLeave").attr('selected', true);
                    }
                    if (data.struck_off == 1) {
                        $("#notStruckOff").attr('selected', false);
                        $("#yesStruckOff").attr('selected', true);
                    }
                    else {
                        $("#yesStruckOff").attr('selected', false);
                        $("#notStruckOff").attr('selected', true);
                    }
                    $("#editStudentModal").modal('show');
                }

            });

        });


        // update studentr profile

        $(document).on('submit', "#updateStudentProfileFrom", function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_student',
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#message").html('');
                    $("#message").removeClass('alert alert-danger');
                    $("#message").removeClass('alert alert-success');
                    $("#update-btn").append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
                },
                success: function (data) {
                    if (data.response == '0') {
                        $.each(data.error, function (i, v) {
                            $("#message").append(v + '<br>');
                        });
                        $("#message").addClass(data.class);
                    }
                    else if (data.response == '1') {
                        $("#message").append(data.message);
                        $("#message").addClass(data.class);
                        $("#editModal").animate({ scrollTop: 0 }, 600);
                        $('.content').load('show_students');
                        $("#StruckOffStudent").load('struck_off_student_list');
                    }

                }

            });

        });
    });
</script>

@endsection