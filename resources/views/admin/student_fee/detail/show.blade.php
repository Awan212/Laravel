<div class="teacher-attendance-report ">
    <span id="heading">Fee Report</span>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Name:</span>
                </div>
                <div class="col-md-6">
                    <span>{{ $data['student']->students->student_name }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Roll No:</span>
                </div>
                <div class="col-md-6">
                    <span># {{ $data['student']->students->student_roll_no }}</span>
                </div>
            </div>
        
        </div>
        <div class="col-md-6">
            <div class="row">
            <div class="col-md-6">
                    <span class="heading">Total Fee:</span>
                </div>
                <div class="col-md-6">
                    <span>Rs.{{ $data['student']->student_fee }}</span>
                </div>
            </div>

                    
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Paid fee:</span>
                </div>
                <div class="col-md-6">
                    <span>Rs.{{ $data['student']->paid_fee }}</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <span class="heading">Remaining Fee:</span>
                </div>
                <div class="col-md-6">
                    <span>Rs.{{ $data['student']->remaining_fee }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="h1 text-primary font-weight-bold">Fee Vouchers List</h1>
            </div>
            <div class="col-sm-4">
                <div class="float-right">
                    
                    <button class="btn btn-primary btn-print">Print</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</td>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th>Invoice Number</th>
                        <th>Fee Amount</th>
                        <th>Fee's Month</th>
                        <th>Paid date</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student</td>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th>Invoice Number</th>
                        <th>Fee Amount</th>
                        <th>Fee's Month</th>
                        <th>Paid date</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach($data['fee'] as $key => $fee)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $fee->student_fees->students->student_name }}</td>
                            <td>#{{ $fee->student_fees->students->student_roll_no }}</td>
                            <td>{{ $fee->student_fees->students->class->class_title }} | {{ $fee->student_fees->students->class->section_name }} </td>
                            <td>{{$fee->invoice_number}}</td>
                            <td>Rs.{{ $fee->fee_amount }}</td>
                            <td>{{ \Carbon\Carbon::parse($fee->fee_of_month)->toFormattedDateString()}} </td>
                            <td>{{ $fee->paid_date }}</td>
                            <td class="noprint">
                                @if($fee->is_paid == '0' and $fee->fee_of_month <= \Carbon\Carbon::create(null, null, 1)->toDateString() )
                                <a href="print_fee_voucher?voucher={{$fee->id}}" target="_blank"
                                    class="btn btn-primary print-fee-voucher">Print Slip</a>
                                @else
                                @endif
                                <button class="btn btn-success btn-edit" data-id="{{ $fee->id }}">Edit</button>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>