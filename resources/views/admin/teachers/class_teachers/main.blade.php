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
<div class="modal fade bottom" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_class_teacher" method="post">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                    <p class="h2 mt-2">Confirm to delete it?</p>
                    @csrf
                    <input type="hidden" name="teacher_id" id="teacher_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger">Procced</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal -->


<!-- add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Class Teachers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addClassTeacher">
                    <div id="messages"></div>
                    @csrf
                    <select name="teacher_id" class="form-control custom-select" id="teacher_id_new">
                        <option value="" disabled selected hidden>Choose a teacher</option>
                        @foreach($data['teachers'] as $teacher)
                        {{ $teacher }}
                        <option value="{{ $teacher->id }}">
                            #{{ $teacher->teacher_id }} -- {{$teacher->teacher_name}}
                        </option>
                        @endforeach
                    </select>

                    <select name="class_sections_id" class="form-control custom-select mt-2 ">
                        <option value="" disabled selected hidden>Choose a class</option>
                        @foreach($data['classes'] as $class)
                        <option value="{{ $class->id }}" @if (old('class_sections_id')==$class->id) {{ 'selected' }}
                            @endif>{{$class->class_title}} -- {{ $class->section_name }}</option>
                        @endforeach
                    </select>
                    <hr>
                    <div class="m-auto w-50 mt-4">
                        <button class="btn btn-success w-100  btn-add-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- add modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Class Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="updateMessage"></div>
                <form id="updateClassTeacher" method="post">
                    @csrf
                    <input type="hidden" name="class_teacher_id" id="class_teacher_id">
                    <label for="update_teacher_id">Teachers</label>
                    <select name="update_teacher_id" class="form-control custom-select" id="update_teacher_id">
                        <option value="" disabled selected hidden>Choose a teacher</option>
                        @foreach($data['teachers'] as $teacher)
                        <option value="{{ $teacher->id }}">
                            #{{ $teacher->teacher_id }} -- {{$teacher->teacher_name}}
                        </option>
                        @endforeach
                    </select>

                    <label for="class_sections">Class & Sections</label>
                    <select name="update_class_sections_id" class="form-control custom-select" id="update_class_sections_id">
                        <option value="" disabled selected hidden>Choose a class</option>
                        @foreach($data['classes'] as $class)
                        <option value="{{ $class->id }}" >
                            {{ $class->class_title }} -- {{ $class->section_name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  class="btn btn-success float-right btn-update">Save changes</button>
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

        $(".content").load('show_class_teachers');

        $(document).on('click', ".btn-print", function () {
            $('.table').printThis();
        });

        $(document).on('click', ".btn-add" ,function () {
            $("#messages").html('');
            $("#messages").removeClass('alert alert-success');
            $("#messages").removeClass('alert alert-danger');
            $("#addModal").modal('show');
        });

        $("#addClassTeacher").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'save_class_teacher',
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#messages").html('');
                    $("#messages").removeClass('alert alert-success');
                    $("#messages").removeClass('alert alert-danger');
                    $(".btn-add-save").html('Saving <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                },
                success: function (data) {
                    if (data.response == '0') {
                        $.each(data.errors, function (i, v) {
                            $("#messages").append('*' + ' ' + v + '<br>');
                        });
                        $("#messages").addClass(data.class);
                        $(".btn-add-save").html('Not Saved');
                    }
                    else if (data.response == '1') {
                        $("#messages").append(data.message);
                        $("#messages").addClass(data.class);
                        $(".btn-add-save").html('Saved');
                        $(".content").load('show_class_teachers');
                        $(this)[0].reset();
                    }
                }
            });
        });

        $(document).on('click','.btn-edit',function(){
            // alert($(this).attr('data-id'));
            $(".btn-update").html('Save changes');
            $("#updateMessage").html('');
            $("#updateMessage").removeClass('alert alert-success');
            $("#updateMessage").removeClass('alert alert-danger');
            $.ajax({
                url: 'edit_class_teacher',
                method : 'get',
                data: {
                    class_teacher_id: $(this).attr('data-id')
                },
                success:function(data)
                {
                   $("#class_teacher_id").val(data.id);
                   $("#update_teacher_id").append('<option value="'+data.teachers_id+'" selected>' + ' # ' + data.teachers.teacher_id  + ' -- ' + data.teachers.teacher_name + '</option>');
                   $("#update_class_sections_id").append('<option value="'+data.class_sections_id+'" selected>' + data.class.class_title  + ' -- ' + data.class.section_name + '</option>');

                }

            });
            $("#editModal").modal('show');
        });

        $("#updateClassTeacher").on('submit',function(e){
            e.preventDefault();
            $("#updateMessage").html('');
            $.ajax({
                url: 'update_class_teacher',
                method: 'post',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function()
                {
                    $(".btn-update").html('Updating ..');
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass('alert alert-success');
                    $("#updateMessage").removeClass('alert alert-danger');
                },
                success:function(data)
                {
                 if(data.response == '0')
                 {
                     $.each(data.errors, function(i,v)
                     {
                        $("#updateMessage").append('*' + v + '<br>');
                     });
                     $("#updateMessage").addClass(data.class);
                 } 
                 else
                 {
                     $("#updateMessage").append(data.message);
                     $("#updateMessage").addClass(data.class);
                     $(".btn-update").html('Updated');
                 }  

                }


            });
        });
        $(document).on('click', ".btn-delete", function () {
            // alert($(this).attr('data-id'));
            $("#teacher_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });
    });
</script>
@endsection