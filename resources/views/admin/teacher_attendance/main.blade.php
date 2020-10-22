@extends('admin.layouts.app')

@section('content')
<div class="content"></div>

<!-- attandance Modal -->
<div class="modal fade" id="AttandanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Attendence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mark-teacher-attendance">
                <div class="modal-body">
                    <div id="markAttendanceMessage"></div>
                    @csrf
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
                            <input type="date" name="attendance_date" id="attendance_date" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="attendance">Attendance</label>
                            <select name="attendance" id="attendance" class="form-control">
                                <option value="" selected disabled hidden>Mark Attandance</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="leave">Leave</option>
                                <option value="late">Late</option>
                            </select>
                        </div>                              
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-mark-attendance">Mark Attendance</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Attandance Modal -->
@endsection

@section('script')
<script>
    $(document).ready(function () {


        $(".content").load('show_teacher_attendance');

        $(document).on('click', '.btn-attendance-mark', function () {
            // $(this).attr('data-id');
            $("#markAttendanceMessage").html('');
            $('#markAttendanceMessage').removeClass('alert alert-danger');
            $("#markAttendanceMessage").removeClass('alert alert-success');
            $("#mark-teacher-attendance")[0].reset();
            $(".btn-mark-attendance").html('Mark Attendance');
            $.ajax({
                url: 'mark_teacher_attendance',
                method: 'get',
                data:{teacher_id:$(this).attr('data-id')},
                success:function(data)
                {
                    $("#teacher").val(data.id);
                    $("#teacher_name").val(data.teacher_name);
                    $("#teacher_id").val('#'+data.teacher_id);
                }
            });
            $("#AttandanceModal").modal('show');
        });

        $('#mark-teacher-attendance').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url:'mark_teacher_attendance',
                method: 'post',
                data: new FormData(this),
                processData:false,
                dataType:'JSON',
                contentType:false,
                cache:false,
                beforeSend:function()
                {
                    $(".btn-mark-attendance").html('Marking Attendance ...');
                    $("#markAttendanceMessage").html('');
                    $('#markAttendanceMessage').removeClass('alert alert-danger');
                    $("#markAttendanceMessage").removeClass('alert alert-success');
                },
                success:function(data)
                {
                    if(data.response == 0)
                    {
                        $.each(data.errors,function(i,v){
                            $("#markAttendanceMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#markAttendanceMessage").addClass(data.class);
                        $(".btn-mark-attendance").html('Not Mark Attendance');
                    }
                    else
                    {
                        $("#markAttendanceMessage").append(data.message);
                        $("#markAttendanceMessage").addClass(data.class);
                        $(".btn-mark-attendance").html('Attendance Marked');

                    }
                }
            });
        });
    });
</script>
@endsection
