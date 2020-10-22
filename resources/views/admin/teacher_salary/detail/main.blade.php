@extends('admin.layouts.app')

@section('content')

@if(Session::has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_salary_detail">
                <div class="modal-body">
                    <div id="addMessage"></div>
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="teacher">Teacher</label>
                            <input type="hidden" name="salary_id" value="{{ $salary->id }}">
                            <input type="hidden" name="teacher_id" value="{{ $salary->teacher }}">
                            <input type="text" value="{{ $salary->teachers->teacher_name }}"
                                placeholder="{{ $salary->teachers->teacher_name }}" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label for="teacher">Salary</label>
                            <input type="text" name="salary" id="salary" value="{{ $salary->salary }}"
                                placeholder="{{ $salary->salary }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="advance_salary">Advance Salary</label>
                            <input type="number" name="advance_salary" id="advance_salary" class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="salary_of_month">Salary of Month</label>
                            <input type="month" name="month_salary" id="month_salary" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="remaining_salary">Remaining Salary</label>
                            <input type="number" name="rem_salary" id="rem_salary" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-save">Save</button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_salary_detail">
                <div class="modal-body">
                    <div id="updateMessage"></div>
                    @csrf
                    <input type="hidden" name="salary_detail_id" id="salary_detail_id">
                    <input type="hidden" name="teacher_id" id="teacher_id">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="teacher">Teacher</label>
                            <input type="text" name="edit_teacher" id="edit_teacher" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <label for="salary">Salary</label>
                            <input type="text" name="edit_salary" id="edit_salary" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="edit_advance_salary">Advance Salary</label>
                            <input type="number" name="edit_advance_salary" id="edit_advance_salary"
                                class="form-control">
                        </div>

                        <div class="col-sm-6">
                            <label for="edit_month_salary">Salary of Month</label>
                            <input type="month" name="edit_month_salary" id="edit_month_salary" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="edit_rem_salary">Remaining Salary</label>
                            <input type="number" name="edit_rem_salary" id="edit_rem_salary" class="form-control">
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
            <form action="delete_salary_detail" method="POST">
                @csrf
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                <p class="h3 mt-2">Are you sure to delete this?</p>
                <input type="hidden" name="detail_id" id="detail_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                <button  class="btn btn-danger">Remove</button>
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
        $(".content").load('show_salary_detail');

        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });

        $(document).on('click', '.btn-add', function () {
            $("#addMessage").html('');
            $("#addMessage").removeClass('alert alert-danger');
            $("#addMessage").removeClass('alert alert-success');
            $(".btn-save").html('Save');
            $("#addModal").modal('show');
        });

        $("#advance_salary").on('change', function () {
            var salary = $("#salary").val();
            var advance = $("#advance_salary").val();
            $("#rem_salary").val(salary - advance);
        });

        $("#add_salary_detail").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'save_salary_detail',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                cache: false,
                beforeSend: function () {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass('alert alert-danger');
                    $("#addMessage").removeClass('alert alert-success');
                    $(".btn-save").html('Saving ...');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#addMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Not Save');
                    }
                    else {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Saved');
                        $(".content").load('show_salary_detail');
                    }
                }
            });
        });
        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass('alert alert-danger');
            $("#updateMessage").removeClass('alert alert-success');
            $(".btn-update").html('Save Changes');
            $("#salary_detail_id").val($(this).attr('data-id'));
            $.ajax({
                url: 'edit_salary_detail',
                'method': 'get',
                data: { salary_id: $(this).attr('data-id') },
                success: function (data) {
                    $("#salary_detail_id").val(data.id);
                    $("#teacher_id").val(data.teachers.id);
                    $("#edit_teacher").val(data.teachers.teacher_name);
                    $("#edit_salary").val(data.teacher_salary.salary);
                    $("#edit_advance_salary").val(data.advance_salary);
                    $("#edit_month_salary").val(data.salary_of_month);
                    $("#edit_rem_salary").val(data.remaining_salary);
                    if (data.is_paid == '1') {
                        $("#edit_yes_paid").attr('selected', true);
                    }
                    else {
                        $("#edit_not_paid").attr('selected', true);
                    }
                }
            });
            $("#editModal").modal('show');
        });

        $("#edit_advance_salary").on('change', function () {
            var salary = $("#edit_salary").val();
            var advance = $("#edit_advance_salary").val();
            $("#edit_rem_salary").val('');
            $("#edit_rem_salary").val(salary - advance);
        });

        $("#update_salary_detail").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_salary_detail',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                cache: false,
                beforeSend: function () {
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass('alert alert-danger');
                    $("#updateMessage").removeClass('alert alert-success');
                    $(".btn-update").html('updating ..');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#updateMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Not Updated');
                    }
                    else {
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Updted');
                        $(".content").load('show_salary_detail');
                    }
                }
            });
        });
        $(document).on('click','.btn-remove',function(){
            $("#detail_id").val();
            $("#detail_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });

    });
</script>
@endsection
