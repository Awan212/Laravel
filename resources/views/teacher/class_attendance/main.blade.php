@extends('teacher.layouts.app')


@section('content')

@if($data['response'] == 'error')
{{ $data['message'] }}
@elseif($data['response'] != 'attendance_marked' or $data['response'] == 'attendance_marked' )
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Class</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data['classSection'])
                            {{ $data['classSection']->class_title }}
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Section</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data['classSection'])
                            {{ $data['classSection']->section_name }}
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Students Seats</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @isset($data['classSection'])
                                    {{ $data['classSection']->seats }}
                                    @endisset
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 90%"
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Enrolled Students</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @isset($data['enrollStudent'])
                            {{ $data['enrollStudent'] }}
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


@if($data['response'] != 'attendance_marked' )
<div class="classAttendance-Page">

    <div class="card shadow">
        <div class="card-header py-4">

        </div>
        <div class="card-body">
            <form id="mark_student_attendance">
                @csrf
                <div id="markAttendanceMessage"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 1rem;">#</th>
                                <th style="width: 7rem;">Student</th>
                                <th style="width: 5rem;">Roll No</th>
                                <th style="width: 7rem;">Class & Section</th>
                                <th style="width: 5rem;">Date</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="width: 1rem;">#</th>
                                <th style="width: 7rem;">Student</th>
                                <th style="width: 5rem;">Roll No</th>
                                <th style="width: 7rem;">Class & Section</th>
                                <th style="width: 5rem;">Date</th>
                                <th>Attendance</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach($data['students'] as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->student_name }}</td>
                                <td>#{{ $student->student_roll_no }}</td>
                                <td>{{ $student->class->class_title }} & {{ $student->class->section_name }}</td>
                                <td>{{ date('Y-m-d') }}</td>
                                <td>
                                    <input type="hidden" name="student[]" value="{{ $student->id }}">
                                    <input type="hidden" name="class" value="{{ $student->class->id }}">
                                    <select name="attendance[]" class="form-control">
                                        <option value="" selected selected>Choose attendnace</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="leave">Leave</option>
                                        <option value="late">Late</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <button class="btn btn-outline-success ml-auto mt-2 btn-mark-attendance">Mark Attendance</button>
            </form>
        </div>
        <div class="card-footer"></div>
    </div>

</div>
@else
<div class="card">
    <div class="card-header">
        <h2 class="h4 text-primary font-weight-bold">Today Attendance List:</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <p class="alert alert-success">{{ $data['message'] }}</p>
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Roll No</th>
                        <th>Class & Section</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Roll No</th>
                        <th>Class & Section</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['today_attendance'] as $key => $todayAttendance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $todayAttendance->students->student_name }}</td>
                            <td># {{ $todayAttendance->students->student_roll_no }}</td>
                            <td>{{ $todayAttendance->students->class->class_title }} & {{ $todayAttendance->students->class->section_name }}</td>
                            <td>{{ $todayAttendance->attendance_date }}</td>
                            <td>
                                @if($todayAttendance->attendance == 'present')
                                    <p class="text-white bg-success p-1">Present</p>
                                @elseif($todayAttendance->attendance == 'absent')
                                    <p class="text-white bg-danger p-1">Absent</p>
                                @elseif($todayAttendance->attendance == 'leave')
                                    <p class="text-white bg-dark p-1">Leave</p>    
                                @else
                                    <p class="text-white bg-warning p-1">Late</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </table>
        </div>
    </div>
</div>
@endif
@endisset
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $("#mark_student_attendance").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'mark_student_attendance',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: "JSON",
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#markAttendanceMessage").html('');
                    $("#markAttendanceMessage").removeClass();
                    $(".btn-mark-attendance").html('Prcoessing ...');
                },
                success: function (data) {
                    if (data.response == 1) {
                        $("#markAttendanceMessage").append(data.message);
                        $("#markAttendanceMessage").addClass(data.class);
                        $(".table-responsive").addClass('d-none');
                        $(".btn-mark-attendance").addClass('d-none');
                    }
                    else {
                        $.each(data.errors, function (i, v) {
                            $("#markAttendanceMessage").append(v);
                        });
                        $("#markAttendanceMessage").addClass(data.class);
                        $(".btn-mark-attendance").html('Not Marked');
                    }
                }
            })
        });
    });
</script>
@endsection