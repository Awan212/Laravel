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

<!-- Delete Modal -->
<div class="modal animate__animated animate__pulse" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_subject_teacher" method="post">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                    <p class="h2 mt-2">Confirm to delete it?</p>
                    @csrf
                    <input type="hidden" name="subject_teacher" id="subject_teacher">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger">Procced</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add Modal -->
<div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Subject Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save_subject_teacher">
                    @csrf
                    <div id="addMessage"></div>
                    <div class="from-group row mb-4">
                        <div class="col-sm-6">
                            <label for="teacher">Teacher</label>
                            <select name="teacher" class="form-control custom-select">
                                <option value="" disabled selected hidden>Choose a teacher</option>
                                @foreach($data['teachers'] as $teacher)
                                <option value="{{ $teacher->id }}">
                                    # {{ $teacher->teacher_id }} -- {{ $teacher->teacher_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="class_section">Class & Section</label>
                            <select name="class_section" class="form-control custom-select">
                                <option value="" disabled selected hidden>Choose a class and section</option>
                                @foreach($data['classes'] as $class)
                                <option value="{{ $class->id }}">
                                    {{$class->class_title}} -- {{$class->section_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 m-auto">
                            <label for="subject_title">Subject:</label>
                            <input type="text" class="form-control" value="" name="subject_title" id="subject_title"
                                placeholder="Subject Title">
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <label>Lecture Start Time</label>
                            <input type="time" value="" class="form-control" name="lecture_start_time"
                                id="lecture_start_time" placeholder="start time">

                        </div>

                        <div class="col-sm-6">
                            <label>Lecture End Time</label>
                            <input type="time" value="" class="form-control" name="lecture_end_time"
                                id="lecture_end_time">

                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-6 m-auto">
                            <button class="btn btn-success btn-lg w-75 m-auto btn-save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add Modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_subject_teacher">
                    @csrf
                    <div id="updateMessage"></div>
                    <input type="hidden" name="edit_subject_teacher" id="edit_subject_teacher">
                    <div class="from-group row mb-4">
                        <div class="col-sm-6">
                            <label for="teacher">Teacher</label>
                            <select name="edit_teacher" id="edit_teacher" class="form-control custom-select">
                                <option value="" disabled selected hidden>Choose a teacher</option>
                                @foreach($data['teachers'] as $teacher)
                                <option value="{{ $teacher->id }}">
                                    # {{ $teacher->teacher_id }} -- {{ $teacher->teacher_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="class_section">Class & Section</label>
                            <select name="edit_class_section" id="edit_class_section" class="form-control custom-select">
                                <option value="" disabled selected hidden>Choose a class and section</option>
                                @foreach($data['classes'] as $class)
                                <option value="{{ $class->id }}">
                                    {{$class->class_title}} -- {{$class->section_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 m-auto">
                            <label for="subject_title">Subject:</label>
                            <input type="text" class="form-control" value="" name="edit_subject_title" id="edit_subject_title"
                                placeholder="Subject Title">
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <label>Lecture Start Time</label>
                            <input type="time" value="" class="form-control" name="edit_lecture_start_time"
                                id="edit_lecture_start_time" placeholder="start time">

                        </div>

                        <div class="col-sm-6">
                            <label>Lecture End Time</label>
                            <input type="time" value="" class="form-control" name="edit_lecture_end_time"
                                id="edit_lecture_end_time">

                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-6 m-auto">
                            <button class="btn btn-success btn-lg w-75 m-auto btn-update">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $(".content").load('show_subject_teachers');

        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });

        $(document).on('click', '.btn-add', function () {
            $(".btn-save").html('Save');
            $("#addMessage").html('');
            $("#addMessage").removeClass('alert alert-danger');
            $("#addMessage").removeClass('alert alert-success');
            $("#addModalCenter").modal('show');
        });


        $("#save_subject_teacher").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'save_subject_teacher',
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass('alert alert-danger');
                    $("#addMessage").removeClass('alert alert-success');
                    $(".btn-save").html('Saving ...');
                },
                success: function (data) {
                    if (data.response == '0') {
                        $.each(data.errors, function (i, v) {
                            $("#addMessage").append('* ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Not Saved');
                    }
                    else {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Saved');
                        $(".content").load('show_subject_teachers');
                        $("#save_subject_teacher")[0].reset();
                    }
                }
            });
        });

        $(document).on('click', '.btn-delete', function () {

            $("#subject_teacher").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');

        });

        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass('alert alert-danger');
            $("#updateMessage").removeClass('alert alert-success');
            $(".btn-update").html('Save');
            $.ajax({
                url: 'edit_subject_teacher',
                method: 'get',
                data: {
                    subject_teacher:$(this).attr('data-id')
                },
                beforeSend: function () {
                    
                },
                success: function (data) {
                    $("#edit_subject_teacher").val(data.id);
                    $("#edit_teacher").append('<option value="'+data.teacher_id+'" selected>' + '# ' + data.teachers.teacher_id + ' -- ' + data.teachers.teacher_name +'</option>');
                    $("#edit_class_section").append('<option value="'+data.class_section_id+'" selected>' + '# ' + data.class.class_title + ' -- ' + data.class.section_name +'</option>');
                    $("#edit_subject_title").val(data.subject_title);
                    $("#edit_lecture_start_time").val(data.lecture_start_time);
                    $("#edit_lecture_end_time").val(data.lecture_end_time);
                } 
            });
            $("#editModal").modal('show');
        });

        $("#update_subject_teacher").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'update_subject_teacher',
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass('alert alert-danger');
                    $("#updateMessage").removeClass('alert alert-success');
                    $(".btn-update").html('Updating ...');
                },
                success: function (data) {
                    if (data.response == '0') {
                        $.each(data.errors, function (i, v) {
                            $("#updateMessage").append('* ' + v + '<br>');
                        });
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Not Saved');
                    }
                    else {
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);
                        $(".btn-update").html('Saved');
                        $(".content").load('show_subject_teachers');
                        // $("#update_subject_teacher")[0].reset();
                    }
                }
            });
        });
    });
</script>

@endsection