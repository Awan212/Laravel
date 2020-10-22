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
                <h5 class="modal-title" id="exampleModalLongTitle">Add Student Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_student_fee">
                <div class="modal-body">
                    @csrf
                    <div id="addMessage"></div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student">Student:</label>
                            <select name="student" id="student" class="form-control">
                                <option value="" selected disabled>Choose student below</option>
                               
                                    @foreach($data['students'] as $student)
                                        <option value="{{ $student->id }}">{{ $student->student_name }} |
                                                    #{{ $student->student_roll_no }}</option>
                                    @endforeach
                            </select>

                        </div>

                        <div class="col-sm-6">
                            <label for="student_fee">Total Fee:</label>
                            <input type="number" name="student_fee" id="student_fee" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="paid_fee">Paid Fee:</label>
                            <input type="number" name="paid_fee" id="paid_fee" class="form-control" value="0">
                        </div>

                        <div class="col-sm-6">
                            <label for="remaining_fee">Remaining Fee:</label>
                            <input type="number" name="remaining_fee" id="remaining_fee" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" class="form-control">
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
<div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg rounded border-gray-700 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_student_fee">
                <div class="modal-body">
                    <div id="updateMessage"></div>
                    @csrf
                    <input type="hidden" name="student_fee_id" id="student_fee_id">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student">Student:</label>
                            <select name="edit_student" id="edit_student" class="form-control">

                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="edit_student_fee">Student Fee:</label>
                            <input type="number" name="edit_student_fee" id="edit_student_fee" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="edit_paid_fee">Paid Fee:</label>
                            <input type="number" name="edit_paid_fee" id="edit_paid_fee" class="border-red-50 w-full p-2
                                 border rounded
                                focus:border-green-700
                                focus:outline-none
                                text-lg
                                focus:shadow-outline">
                        </div>

                        <div class="col-sm-6">
                            <label for="edit_remaining_fee">Remaining Fee:</label>
                            <input type="number" name="edit_remaining_fee" id="edit_remaining_fee"
                                class="w-full p-2 border border-red-400 rounded text-lg focus:outline-none focus:shadow-outline ">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 m-auto">
                            <label for="edit_invoice_number">Invoice Number:</label>
                            <input type="text" name="edit_invoice_number" id="edit_invoice_number"
                                class="w-full p-2 text-lg rounded border focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button
                        class="bg-blue-800 text-white p-2 outline-none font-bold border-none rounded hover:bg-gray-500 hover:text-gray-800 hover:shadow-lg  focus:ouline-none focus:border-none">Save
                        changes</button>
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
            <form action="remove_student_fee" method="post">
                <div class="modal-body text-center">
                    @csrf
                    <input type="hidden" name="remove_student_fee_id" id="remove_student_fee_id">
                    <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
                    <p>Are you sure to delete student fee recored?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger" >Yes I'm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $(".content").load('show_student_fee');

        $("#paid_fee").on('change', function () {
            var paid_fee = $(this).val();
            var fee = $("#student_fee").val();
            $("#remaining_fee").val(fee - paid_fee);
        });

        $("#edit_paid_fee").on('change', function () {
            var paid_fee = $(this).val();
            var fee = $("#edit_student_fee").val();
            $("#edit_remaining_fee").val(fee - paid_fee);
        });

        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });

        $(document).on('click', '.btn-add', function () {
            $("#addMessage").html('');
            $("#addMessage").removeClass();
            $(".btn-save").html('Save');
            $("#addModal").modal('show');
        });

        $("#add_student_fee").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'add_student_fee',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass();
                    $(".btn-save").html('Saving ...');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $.each(data.errors, function (i, v) {
                            $("#addMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Try Again');
                    }
                    else {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                        $(".btn-save").html('Saved');
                        $(".content").load('show_student_fee');
                    }

                }
            });
        });

        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass();
            $.ajax({
                url: 'edit_student_fee',
                method: 'get',
                data: {
                    student_fee_id: $(this).attr('data-id'),
                },
                beforeSend: function () { },
                success: function (data) {
                    $("#student_fee_id").val(data.id);
                    $("#edit_student").append('<option value="' + data.student + '" selected>' + data.students.student_name + ' | #' + data.students.student_roll_no + '</option>');
                    $("#edit_student_fee").val(data.student_fee);
                    $("#edit_paid_fee").val(data.paid_fee);
                    $("#edit_remaining_fee").val(data.remaining_fee);
                    $("#edit_invoice_number").val(data.invoice_number);
                    $("#editModal").modal('show');
                }
            });
        });

        $("#update_student_fee").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_student_fee',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: 'JSON',
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
                        $(".content").load('show_student_fee');
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);

                    }
                }
            });
        });

        $(document).on('click', '.btn-delete', function () {
            $("#remove_student_fee_id").val($(this).attr('data-id'));
            $("#deleteModal").modal('show');
        });
    });
</script>
@endsection