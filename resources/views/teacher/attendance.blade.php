@extends('teacher.layouts.app')


@section('content')

@if(isset($data['attendance']))

<div class="teacher-attendance-report ">
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



<div class="card shadow mb-4 teacher-student-attendance">
    <div class="card-header py-3">
        <h6 class="m-0 h2 font-weight-bold text-primary float-left">Attendance
            Detail
        </h6>
        <button class="btn btn-primary float-right btn-print noprint"><i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['attendance'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->teachers->teacher_name }}</td>
                        <td>#{{ $value->teachers->teacher_id }}</td>
                        <td>{{ $value->attendance_date }}</td>
                        <td>
                            @if($value->attendance == 'present')
                                <p class="bg-success text-white p-1">Present</p>
                            @elseif($value->attendance == 'absent')
                                <p class="bg-danger text-white p-1">Absent</p>
                            @elseif($value->attendance == 'leave')
                                <p class="bg-dark text-white p-1">Leave</p>
                            @else
                                <p class="bg-warning text-white p-1">Late</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else

@endisset
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $(".btn-print").on('click',function(){
            $(".table").printThis();
        });

    });
</script>
@endsection
