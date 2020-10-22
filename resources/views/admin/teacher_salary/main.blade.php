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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_teacher_salary">
                <div class="modal-body">
                    @csrf
                    <div id="addMessage"></div>
                    <div class="form-group row">
                        <div class="col-sm-12 m-auto">
                            <label for="teacher">Teacher</label>
                            <select name="teacher" id="teacher" class="form-control custom-select">
                                <option value="" selected select>Choose Teacher</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">#{{ $teacher->teacher_id }} --
                                    {{ $teacher->teacher_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="total_salary">Total Salary:</label>
                            <input type="text" name="salary" id="salary" class="form-control"
                                placeholder="Teacher Salary">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add Modal -->
<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_teacher_salary" method="post">
                @csrf
                <div class="modal-body">
                    <div id="updateMessage"></div>
                    <input type="hidden" name="edit_salary_id" id="edit_salary_id">
                    <label for="edit_teacher">Teacher</label>
                    <select name="edit_teacher" id="edit_teacher" class="form-control custom-select">
                        <option value="" selected select>Choose Teacher</option>
                        @foreach($teachers as $teacher)
                        <option id="teacher{{ $teacher->id }}" value="{{ $teacher->id }}">#{{ $teacher->teacher_id }} --
                            {{ $teacher->teacher_name }}</option>
                        @endforeach
                    </select>
                    <label for="edit_salary">Salary</label>
                    <input type="text" name="edit_salary" id="edit_salary" class="form-control">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->

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
            <form action="delete_teacher_salary" method="POST">
                @csrf
            <div class="modal-body text-center">
                <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                <p class="h3 mt-2">Are you sure to delete this?</p>
                <input type="hidden" name="salary_id" id="salary_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">Yes I'm.</button>
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
        $(".content").load('show_teacher_salaries');


        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });
        $(document).on('click', ".btn-add", function () {
            $("#addMessage").html(' ');
            $("#addMessage").removeClass('alert alert-success');
            $("#addMessage").removeClass('alert alert-danger');
            $(".btn-save").html('Save');
            $("#addModal").modal('show');
        });

        $("#save_teacher_salary").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'save_teacher_salary',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                cache: false,
                beforeSend: function () {
                    $("#addMessage").html(' ');
                    $("#addMessage").removeClass('alert alert-success');
                    $("#addMessage").removeClass('alert alert-danger');
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
                        $("#save_teacher_salary")[0].reset();
                        $(".content").load('show_teacher_salaries');
                    }

                }

            });
        });

        $(document).on('click', ".btn-edit", function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass('alert alert-success');
            $("#updateMessage").removeClass('alert alert-danger');
            // alert($(this).attr('data-id'));
            $(".btn-update").html('Update');
            $.ajax({
                url: 'edit_teacher_salary',
                method: 'get',
                data: {
                    salary_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#edit_salary_id").val(data.id);
                    $("#teacher" + data.teacher).attr('selected', true);

                    // $("#edit_teacher").append('<option  value="'+ data.teacher +'" selected>'+'#'+data.teachers.teacher_id+ ' -- '  + data.teachers.teacher_name +'</option>');
                    $("#edit_salary").val(data.salary);
                    $("#editModal").modal('show');
                }
            });

        });

        $("#update_teacher_salary").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_teacher_salary',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                cache: false,
                beforeSend: function () {
                    $(".btn-update").html('Updating ...');
                    $("#updateMessage").html('')
                    $("#updateMessage").removeClass('alert alert-success');
                    $("#updateMessage").removeClass('alert alert-danger');
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
                        $(".btn-update").html('Updated');
                        $(".content").load('show_teacher_salaries');
                    }
                }

            });
        });

        $(document).on('click', '.btn-delete', function () {
            $("#salary_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });
    });
</script>
@endsection
