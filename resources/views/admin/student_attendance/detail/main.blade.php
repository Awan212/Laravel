@extends('admin.layouts.app')

@section('content')

@if(Session::has('message'))
    <div class="alert alert-warning  alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="content"></div>
<!-- add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mark attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mark_student_attendance">
                @csrf
                <div class="modal-body">
                    <div id="addMessage"></div>
                    <input type="hidden" name="student" value="{{ $data['student']->id }}">
                    <input type="hidden" name="class" value="{{ $data['student']->class->id }}">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_name">Student Name:</label>
                            <input type="text" name="student_name" id="student_name"
                                value="{{ $data['student']->student_name }}" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label for="student_roll">Student Roll No:</label>
                            <input type="text" name="student_roll" id="student_roll" class="form-control"
                                value="{{ $data['student']->student_roll_no }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="attendance_date">Attendnace Date:</label>
                            <input type="date" name="attendance_date" id="attendance_date" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="attendance">Attendance:</label>
                            <select name="attendance" id="attendance" class="form-control">
                                <option value="" disabled selected>Select attendance</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="leave">Leave</option>
                                <option value="late">Late</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-save">Mark Attendance</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Marked attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_student_attendance">
                @csrf
                <div class="modal-body">
                    <div id="updateMessage"></div>
                    <input type="hidden" name="edit_attendance_id" id="edit_attendance_id">
                    <input type="hidden" name="edit_student" id="edit_student">
                    <input type="hidden" name="edit_class" id="edit_class">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_name">Student Name:</label>
                            <input type="text" name="edit_student_name" id="edit_student_name" class="form-control"
                                disabled>
                        </div>

                        <div class="col-sm-6">
                            <label for="student_roll">Student Roll No:</label>
                            <input type="text" name="edit_student_roll" id="edit_student_roll" class="form-control"
                                disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="attendance_date">Attendnace Date:</label>
                            <input type="date" name="edit_attendance_date" id="edit_attendance_date"
                                class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="attendance">Attendance:</label>
                            <select name="edit_attendance" id="edit_attendance" class="form-control">
                                <option value="" disabled selected>Select attendance</option>
                                <option value="present" id="edit_present">Present</option>
                                <option value="absent" id="edit_absent">Absent</option>
                                <option value="leave" id="edit_leave">Leave</option>
                                <option value="late" id="edit_late">Late</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-update">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit modal -->

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_student_attendance" method="post">
                <div class="modal-body text-center">
                    @csrf
                    <i class="fa fa-exclamation-triangle fa-8x text-warning" aria-hidden="true"></i>
                    <p class="h2 mt-2">Are you sure to delete this?</p>
                    <input type="hidden" name="delete_attendance_id" id="delete_attendance_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger">Yes I'm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal -->
@endsection



@section('script')
<script>
    $(document).ready(function () {
        $(".content").load('show_student_attendance_detail');

        $(document).on('click', '.btn-print', function () {
            $('.table').printThis();
        });

        $(document).on('click', '.btn-add', function () {
            $("#addMessage").html('');
            $("#addMessage").removeClass();
            $(".btn-save").html('Mark Attendance');
            $("#addModal").modal('show');
        });

        $("#mark_student_attendance").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'mark_student_attendance_by_admin',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: "JSON",
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass();
                    $(".btn-save").html('Processing ...');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#addMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Attendance Not Mark');
                    }
                    else {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Attendance Marked');
                        $(".content").load('show_student_attendance_detail');
                    }

                }
            });
        });

        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass();
            $(".btn-update").html('save Changes');
            $.ajax({
                url: 'edit_student_attendance',
                method: 'get',
                data: {
                    attendance_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#edit_attendance_id").val(data.id);
                    $("#edit_student").val(data.students.id);
                    $("#edit_class").val(data.class.id);
                    $("#edit_student_name").val(data.students.student_name);
                    $("#edit_student_roll").val('#' + data.students.student_roll_no);
                    $("#edit_attendance_date").val(data.attendance_date);
                    if (data.attendance == 'present') {
                        $("#edit_late").attr('selected', false);
                        $("#edit_leave").attr('selected', false);
                        $("#edit_absent").attr('selected', false);
                        $("#edit_present").attr('selected', true);
                    }
                    else if (data.attendance == 'absent') {
                        $("#edit_late").attr('selected', false);
                        $("#edit_leave").attr('selected', false);
                        $("#edit_present").attr('selected', false);
                        $("#edit_absent").attr('selected', true);
                    }
                    else if (data.attendance == 'leave') {
                        $("#edit_late").attr('selected', false);
                        $("#edit_present").attr('selected', false);
                        $("#edit_absent").attr('selected', false);
                        $("#edit_leave").attr('selected', true);
                    }
                    else {
                        $("#edit_present").attr('selected', false);
                        $("#edit_absent").attr('selected', false);
                        $("#edit_leave").attr('selected', false);
                        $("#edit_late").attr('selected', true);
                    }
                }

            });
            $("#editModal").modal('show');
        });

        $("#edit_student_attendance").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_student_attendance',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: "JSON",
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass();
                    $(".btn-update").html('save Changing ...');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#updateMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Not saveed..');
                    }
                    else {
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Saved changes');
                        $(".content").load('show_student_attendance_detail');
                    }
                }
            });
        });

        $(document).on('click', '.btn-delete', function () {
            $("#delete_attendance_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });
    });
</script>
@endsection
