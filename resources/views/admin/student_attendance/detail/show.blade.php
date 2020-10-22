<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Student attendance Detail List</h6>
        <!-- <button class="btn btn-success float-right btn-add" >Add</button> -->
        <button class="btn btn-primary float-right mr-2 btn-print"> <i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Attendance date</th>
                        <th>Attendance</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Attendance date</th>
                        <th>Attendance</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($attendances as $key => $attendance)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="profile-Img">
                                    <img src="{{ asset($attendance->students->student_profile_pic) }}" alt="" width="100%" height="100%">
                                </div>
                            </td>
                            <td>{{ $attendance->students->student_name }}</td>
                            <td>#{{ $attendance->students->student_roll_no }}</td>
                            <td>{{ $attendance->attendance_date }}</td>
                            <td>
                                @if($attendance->attendance == 'present')
                                    <p class="text-white text-center font-weight-bold bg-success">Present</p>
                                @elseif($attendance->attendance == 'absent')
                                    <p class="text-white text-center bg-danger font-weight-bold">Absent</p>
                                @elseif($attendance->attendance == 'leave')
                                    <p class="text-white text-center bg-dark font-weight-bold">Leave</p>
                                @else
                                    <p class="text-white text-center bg-warning font-weight-bold">Late</p>
                                @endif
                            </td>
                            <td class="noprint">
                                <button class="btn btn-success btn-edit" data-id="{{ $attendance->id }}">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="{{ $attendance->id }}">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

    </div>
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
