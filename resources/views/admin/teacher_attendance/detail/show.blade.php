<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Teacher's Attendance Detail</h6>
        <button class="float-right btn btn-primary btn-print" data-toggle="tooltip" data-placement="top" title="Print">Print</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm TeacherAttandancePage" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th style="width:80px">Profile</th>
                        <th style="width: 200px;">Teacher Name</th>
                        <th style="width: 100px;">Teacher Id</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                        <th class="noprint text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Profile</th>
                        <th>Teacher Name</th>
                        <th>Teacher Id</th>
                        <th>Attendance Date</th>
                        <th>Attendance</th>
                        <th class="noprint text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($attendanceDetail as $key => $attendance)
                    <tr>
                        <td class="text-center">{{ $key+1 }}</td>
                        <td>
                            <div class="TeacherProfile">
                                <img src="{{ asset($attendance->teachers->teacher_profile_pic) }}" alt="{{ $attendance->teachers->teacher_name }}" width="100%" height="100%">
                            </div>
                        </td>
                        <td>{{ $attendance->teachers->teacher_name }}</td>
                        <td>#{{ $attendance->teachers->teacher_id }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>
                            @if($attendance->attendance == 'present')
                                <p class="text-white bg-success font-weight-bold text-center">Present</p>
                            @elseif($attendance->attendance == 'absent')
                                <p class="text-white bg-danger font-weight-bold text-center">Absent</p>
                            @elseif($attendance->attendance == 'leave')
                                <p class="text-white bg-dark font-weight-bold text-center">Leave</p>
                            @else
                                <p class="text-white bg-warning font-weight-bold text-center">late</p>
                            @endif
                        </td>
                        <td class="noprint text-center">
                            <button class="btn btn-success btn-edit" data-id="{{ $attendance->id }}" data-toggle="tooltip" data-placement="left" title="Edit">Edit</button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $attendance->id }}" data-toggle="tooltip" data-placement="top" title="Remove">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
</div>



<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
        $('#dataTable').DataTable();
    });
</script>
