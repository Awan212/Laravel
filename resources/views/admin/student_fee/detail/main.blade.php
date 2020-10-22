@extends('admin.layouts.app')


@section('content')


<div class="content"></div>



<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update fee detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_student_fee_detail">
                <div class="modal-body">
                    @csrf
                    <div id="updateMessage"></div>
                    <input type="hidden" name="student_fee_detail_id" id="student_fee_detail_id">
                    <div class="form-group row">

                      <div class="col-sm-6">
                          <label for="invoice_number">Invoice Number:</label>
                          <input type="text" name="invoice_number" id="invoice_number" class="form-control" disabled>
                      </div>

                        <div class="col-sm-6">
                            <label for="fee_amount">Fee Amount:</label>
                            <input type="number" name="fee_amount" id="fee_amount" class="form-control" disabled>
                        </div>

                    </div>

                    <div class="form-group row">
                        

                        <div class="col-sm-6">
                            <label for="fee's_month">Fee's Month:</label>
                            <input type="date" name="fee_of_month" id="fee_of_month" class="form-control">
                        </div>


                        <div class="col-sm-6">
                            <label for="paid_date">Paid Date:</label>
                            <input type="date" name="paid_date" id="paid_date" class="form-control">
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 m-auto">
                            <label for="is_paid">Paid</label>
                            <select name="is_paid" id="is_paid" class="form-control">
                                <option value="" selected hidden disabled>Select paid option</option>
                                <option value="1" id="yesPaid">Yes Paid</option>
                                <option value="0" id="noPaid">No't yet</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit modal -->

<div class="row fee-voucher d-none" id="#feeVoucher">
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <h1>The Grammer School</h1>
            </div>
            <div class="col-sm-12 m-auto">
                <h3>Parent Copy</h3>
            </div>
            <div class="col-sm-10 ml-auto">
                <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4 id="studentName">Student Name</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Father Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4 id="FatherName">Father Name</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Class: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Class and Section</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Fee of Month: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Dec 22, 2020</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee </th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tfoot >
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rs. 12,000</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dec 2020</td>
                            <td>Rs.12,000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-8 m-auto">
                <span>Fine chrge 100 rupees per day after due date.</span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <h1>The Grammer School</h1>
            </div>
            <div class="col-sm-12 m-auto">
                <h3>Bank Copy</h3>
            </div>
            <div class="col-sm-10 ml-auto">
                <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Student Name</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Father Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Father Name</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Class: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Class and Section</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Fee of Month: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Dec 22, 2020</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee </th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tfoot >
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rs. 12,000</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dec 2020</td>
                            <td>Rs.12,000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-8 m-auto">
                <span>Fine chrge 100 rupees per day after due date.</span>
            </div>
        </div>

    </div>

    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <h1>The Grammer School</h1>
            </div>
            <div class="col-sm-12 m-auto">
                <h3>Office Copy</h3>
            </div>
            <div class="col-sm-10 ml-auto">
                <h4>Last Date: {{ Carbon\Carbon::createFromDate(null, null, 10)->format('jS F Y') }}</h4>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Student Name</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Father Name: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Father Name</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Class: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Class and Section</h4>
                    </div>
                </div>    
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="heading">Fee of Month: </span>
                    </div>
                    <div class="col-sm-6">
                        <h4>Dec 22, 2020</h4>
                    </div>
                </div>    
            </div>
            <div class="col-sm-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee </th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tfoot >
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rs. 12,000</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dec 2020</td>
                            <td>Rs.12,000</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-8 m-auto">
                <span>Fine chrge 100 rupees per day after due date.</span>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $(".content").load('show_student_fee_detail');


        $(document).on('click', '.btn-print', function () {
            $(".table").printThis();
        });

        $(document).on('click', '.btn-edit', function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass();
            $.ajax({
                url: 'edit_student_fee_detail',
                method: 'get',
                data: {
                    student_fee_detail_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#student_fee_detail_id").val(data.id);
                    // $("#student").val(data.student_fees.students.student_name);
                    $("#invoice_number").val(data.invoice_number);
                    $("#fee_amount").val(data.fee_amount);
                    $("#fee_of_month").val(data.fee_of_month);
                    $("#paid_date").val(data.paid_date);
                    if(data.is_paid == '0')
                    {
                        $("#noPaid").attr('selected', true);
                    }
                    else
                    {
                        $("#yesPaid").attr('selected', true);
                    }
                    $("#editModal").modal('show');
                }
            });
        });


        $("#update_student_fee_detail").on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: 'update_student_fee_detail',
                method: 'post',
                data: new FormData(this),
                processData:false,
                dataType: 'JSON',
                contentType:false,
                cache:false,
                beforeSend:function()
                {
                    $("#updateMessage").html('');
                    $("#updateMessage").removeClass();
                },
                success:function(data)
                {
                    if(data.response == 0)
                    {
                        $.each(data.errors, function(i,v){
                            $("#updateMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#updateMessage").addClass(data.class);
                    }
                    else
                    {
                        $("#updateMessage").append(data.message);
                        $("#updateMessage").addClass(data.class);
                        $(".content").load('show_student_fee_detail');
                    }
                }
            });
        });

       
    });
</script>
@endsection