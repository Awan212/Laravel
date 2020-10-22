<div class="table-responsive">
    <table class="table table-bordered today-teacher-attendance table-sm" id="dataTable1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Id</th>
                <th>Phone #</th>
                <th>Attendance</th>
                <th class="noprint">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Id</th>
                <th>Phone #</th>
                <th>Attendance</th>
                <th class="noprint">Action</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($data['teacher_attendance'] as $key => $teacherAttendance)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $teacherAttendance->teachers->teacher_name }}</th>
                <th># {{ $teacherAttendance->teachers->teacher_id }}</th>
                <th>{{ $teacherAttendance->teachers->teacher_phone }}</th>
                <th>
                    @if( $teacherAttendance->attendance == 'present' )
                    <p class="bg-success  p-2 text-white">Present</p>
                    @elseif( $teacherAttendance->attendance == 'absent' )
                    <p class="bg-danger p-2 text-white">Absent</p>
                    @elseif( $teacherAttendance->attendance == 'leave' )
                    <p class="bg-dark p-2 text-white">Leave</p>
                    @else
                    <p class="bg-warning p-2 text-white">Late</p>
                    @endif
                </th>
                <th class="noprint">
                    <button class="btn btn-primary btn-edit-teacherAttendance"
                        data-id="{{ $teacherAttendance->id }}">Edit</button>
                </th>
            </tr>
            @endforeach
        </tbody>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $("#dataTable1").dataTable();
    });
</script>