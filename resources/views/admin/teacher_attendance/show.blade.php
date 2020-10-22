<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Teacher's Attendance List</h6>
        <button class="float-right btn btn-primary print">Print</button>
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
                        <th style="width: 200px;" class="noprint text-center">Mark Attendance</th>
                        <th class="noprint text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Profile</th>
                        <th>Teacher Name</th>
                        <th>Teacher Id</th>
                        <th class="noprint text-center">Mark Attendance</th>
                        <th class="noprint text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($teachers as $key => $teacher)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>
                                <div class="TeacherProfile ">
                                        <img src="{{ asset($teacher->teacher_profile_pic) }}" alt="" width="100%" height="100%">
                                </div>
                            </td>
                            <td> <h5>{{ $teacher->teacher_name }}</h5> </td>
                            <td> #{{ $teacher->teacher_id }} </td>
                            <td class="text-center"> <button class="btn btn-primary btn-attendance-mark" data-id="{{ $teacher->id }}" data-toggle="tooltip" data-placement="right" title="Mark Attendance">Mark Attendance</button> </td>
                            <td class="text-center">
                                <a href="attendance_detail?teacher={{$teacher->id}}" class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Show detail">Show</a>
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
