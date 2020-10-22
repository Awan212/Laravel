<div class="card shadow">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="m-0 font-weight-bold float-left text-primary">Student Fee List</h2>
            </div>
            <div class="col-sm-4">
                <div class="float-right">
                    <button class="btn btn-primary btn-print">Print</button>
                    <button class="btn btn-success btn-add">Add</button>
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
                        <th>Total Fee</th>
                        <th>Paid Fee</th>
                        <th>Remaining Fee</th>
                        <th>Invoice Number</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th>Total Fee</th>
                        <th>Paid Fee</th>
                        <th>Remaining Fee</th>
                        <th>Invoice Number</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['students'] as $key => $student)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $student->students->student_name }}</td>
                        <td>#{{ $student->students->student_roll_no }}</td>
                        <td>{{ $student->students->class->class_title }} | {{ $student->students->class->section_name }}</td>
                        <td>Rs.{{ $student->student_fee }}</td>
                        <td>Rs.{{ $student->paid_fee }}</td>
                        <td>Rs.{{ $student->remaining_fee }}</td>
                        <td>{{ $student->invoice_number }}</td>
                        <td class="noprint">
                            <a href="student_fee_detail?student_fee={{ $student->id }}" class="btn btn-secondary">Detail</a>
                            <button class="btn btn-success btn-edit" data-id="{{ $student->id }}">Edit</button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $student->id }}">Remove</button>
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