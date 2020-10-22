@extends('admin.layouts.app')


@section('content')
<div class="content"></div>





<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <input type="date" name="attendance_date" id="attendance_date"
                                class="form-control">
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
<!-- edit Modal -->
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $(".content").load('show_attendance_detail');

        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });

        $(document).on('click','.btn-edit',function(){
            $("#updateAttendanceMessage").html('');
            $("#updateAttendanceMessage").removeClass();
            $(".btn-update").html('Save changes');
            $.ajax({
                url:'edit_teacher_attendance',
                'method': 'get',
                data: {
                    attendance_id:$(this).attr('data-id')
                    },
                success:function(data)
                {
                    $("#attendance_id").val(data.id);
                    $("#teacher").val(data.teachers.id);
                    $("#teacher_name").val(data.teachers.teacher_name);
                    $("#teacher_id").val('#' + data.teachers.teacher_id);
                    $("#attendance_date").val(data.attendance_date);
                    if(data.attendance == 'present')
                    {
                        $("#late").attr('selected',false);
                        $("#leave").attr('selected',false);
                        $("#absent").attr('selected',false);
                        $("#present").attr('selected',true);
                    }
                    else if(data.attendance == 'absent')
                    {
                        $("#late").attr('selected',false);
                        $("#leave").attr('selected',false);
                        $("#absent").attr('selected',false);
                        $("#present").attr('selected',false);
                        $("#absent").attr('selected',true);

                    }
                    else if(data.attendance == 'leave')
                    {
                        $("#late").attr('selected',false);
                        $("#absent").attr('selected',false);
                        $("#present").attr('selected',false);
                        $("#absent").attr('selected',false);
                        $("#leave").attr('selected',true);
                    }
                    else{
                        $("#absent").attr('selected',false);
                        $("#present").attr('selected',false);
                        $("#absent").attr('selected',false);
                        $("#leave").attr('selected',false);
                        $("#late").attr('selected',true);
                    }
                }
            });
            $("#editModal").modal('show');
        });


        $("#update_teacher_attendance").on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url:'update_teacher_attendance',
                method:'post',
                data:new FormData(this),
                processData:false,
                dataType:'JSON',
                contentType:false,
                cache:false,
                beforeSend:function()
                {
                    $("#updateAttendanceMessage").html('');
                    $("#updateAttendanceMessage").removeClass();
                    $(".btn-update").html('Saving changes ...');
                },
                success:function(data)
                {
                    if(data.response == 0 )
                    {
                        $.each(data.errors, function(i,v){
                            $("#updateAttendanceMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateAttendanceMessage").addClass(data.class);
                        $(".btn-update").html("Not Update");
                    }
                    else
                    {
                        $("#updateAttendanceMessage").append(data.message);
                        $("#updateAttendanceMessage").addClass(data.class);
                        $(".btn-update").html("Updated");
                        $(".content").load('show_attendance_detail');
                    }
                }
            });
        });
        $(document).on('click', '.btn-delete', function () {
            $("#attendanceId").val($(this).attr('data-id'));
            $("#warningModal").modal('show');
        });
    });
</script>
@endsection
