
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</td>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($students as $key => $student)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div class="profile-Img">
                                <img src="{{ asset($student->student_profile_pic) }}" alt="" width="100%" height="100%">
                            </div>
                        </td>
                        <td>{{ $student->student_name }}</td>
                        <td>#{{ $student->student_roll_no }}</td>
                        <td>{{ $student->class->class_title }} & {{ $student->class->section_name }}</td>
                        <td>
                            <a href="student_attendance_detail?student={{ $student->id }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Show detail">Show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
