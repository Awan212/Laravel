@extends('admin.layouts.app')

@section('content')
@if(Session::has('message'))
    <div class="alert alert-warning">
        {{ Session::get('message') }}
    </div>
@endif
<div class="content"></div>

<!-- add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_result">
                <div class="modal-body">
                    @csrf
                    <div id="addMessage"></div>
                    <label for="class">Class & Section</label>
                    <select name="class_section" id="class_section" class="form-control">
                        <option value="" selected disabled hidden>Choose your desired class:</option>
                        @isset($data)
                        @foreach($data['class'] as $class)
                        <option value="{{ $class->id }}">{{ $class->class_title }} | {{ $class->section_name }}
                        </option>
                        @endforeach
                        @endisset
                    </select>

                    <label for="result_tile">Result Title</label>
                    <input type="text" name="result_title" id="result_title" class="form-control">

                    <label for="result">Upload Result</label>
                    <input type="file" name="result" id="result" class="form-control-file"
                        accept="application/pdf,application/vnd.ms-excel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_result">
                <div class="modal-body">
                    @csrf
                    <div id="updateMessage"></div>
                    <label for="class">Class & Section</label>
                    <input type="hidden" name="result_id" id="result_id">
                    <select name="edit_class_section" id="edit_class_section" class="form-control">
                        <option value="" selected disabled hidden>Choose your desired class:</option>
                        @isset($data)
                        @foreach($data['class'] as $class)
                        <option id="class{{ $class->id }}" value="{{ $class->id }}">{{ $class->class_title }} |
                            {{ $class->section_name }} </option>
                        @endforeach
                        @endisset
                    </select>

                    <label for="result_tile">Result Title</label>
                    <input type="text" name="edit_result_title" id="edit_result_title" class="form-control">

                    <label for="result">Upload Result</label>
                    <input type="file" name="edit_result" id="edit_result" class="form-control-file"
                        accept="application/pdf,application/vnd.ms-excel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
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
            <form action="remove_result" method="post">
                <div class="modal-body text-center">
                    @csrf
                    <input type="hidden" name="remove_result_id" id="remove_result_id">
                    <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                    <p>Are you sure to delete student result?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button  class="btn btn-danger">Yes I'm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete Modal -->
@endsection


@section('script')
<script>
    $(document).ready(function () {

        $(".content").load('show_results');
        $(document).on('click', ".btn-add-result", function () {
            $("#addMessage").html('');
            $("#addMessage").removeClass();
            $("#addModal").modal('show');
        });
        $("#add_result").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'add_result',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass();
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#addMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                    }
                    else {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                        $(".content").load('show_results');
                    }
                }
            });
        });

        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass();
            $.ajax({
                url: 'edit_result',
                method: 'get',
                data: {
                    result_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#result_id").val(data.id);
                    $("#class" + data.class_sections).attr('selected', false);
                    $("#class" + data.class_sections).attr('selected', true);
                    $("#edit_result_title").val(data.result_title);
                    $("#editModal").modal('show');

                }
            });
        });

        $("#update_result").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_result',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: "JSON",
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass();
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#updateMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateMessage").addClass(data.class);
                    }
                    else {
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);
                        $(".content").load('show_results');
                    }
                }
            });
        });

        $(document).on('click', '.btn-remove', function(){
            $("#remove_result_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });
    });
</script>
@endsection