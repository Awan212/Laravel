@extends('student.layouts.app')


@section('content')
<div class="student-attendance-report ">
    <span id="heading">Attendance Report</span>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Total Days:</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['total_days'] }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Absent</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['absent'] }}</span>
                </div>
            </div>
        
        </div>
        <div class="col-md-6">
            <div class="row">
            <div class="col-md-6">
                    <span class="heading">Total Present:</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['present'] }}</span>
                </div>
            </div>

                    
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Leaves:</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['leave'] }}</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Late:</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['late'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header"> 
        <h4 class="text-dark">Attendance List</h4> 
    </div>
    <div class="card-body">
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</td>
                        <th>Day</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student</td>
                        <th>Day</th>
                        <th>Attendance</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['attendance'] as $key => $attendance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $attendance->students->student_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->toFormattedDateString() }}</td>
                            <td>
                                @if($attendance->attendance == 'present')
                                    <p class="text-white bg-success p-1">Present</p>
                                @elseif($attendance->attendance == 'absent')
                                    <p class="text-white bg-danger p-1">Absent</p>
                                @elseif($attendance->attendance == 'Leave')
                                    <p class="text-white bg-dark p-1">Leave</p>
                                @else
                                    <p class="text-white bg-warninng p-1">Late</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection