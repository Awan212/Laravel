<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left"><a href="/teacher_salaries"><i class="fas fa-arrow-left fa-1x"></i></a> Teacher Salary Detail</h6>
        <button class="btn btn-success float-right btn-add" data-toggle="tooltip" data-placement="top" title="add">Add</button>
        <button class="btn btn-primary float-right mr-2 btn-print" data-toggle="tooltip" data-placement="left" title="Print"> <i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Salary</th>
                        <th>Advance Salary</th>
                        <th>Salary of Month</th>
                        <th>Remaing Salary</th>
                        <th>Paid</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Salary</th>
                        <th>Advance Salary</th>
                        <th>Salary of Month</th>
                        <th>Remaining Salary</th>
                        <th>Paid</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($salaries as $key =>  $salary)
                       <tr>
                            <td>{{ $key+1  }}</td>
                            <td>{{$salary->teachers->teacher_name}}
                                <small>#{{ $salary->teachers->teacher_id }}</small>
                            </td>
                            <td>{{ $salary->teacherSalary->salary }}</td>
                            <td>{{ $salary->advance_salary }}</td>
                            <td>{{ Carbon\Carbon::parse($salary->salary_of_month)->format('F Y')  }}</td>
                            <td>{{ $salary->remaining_salary }}</td>
                            <td>
                                <p class="text-white font-weight-bold bg-success txt-center p-1">Paid</p>
                            </td>
                            <td class="noprint">
                                <button class="btn btn-primary btn-edit" data-id="{{ $salary->id }}" data-toggle="tooltip" data-placement="top" title="Edit">Edit</button>
                                <button class="btn btn-danger btn-remove" data-id="{{ $salary->id }}" data-toggle="tooltip" data-placement="top" title="Remove">Remove</button>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
        $('#dataTable').DataTable();
    });
</script>
