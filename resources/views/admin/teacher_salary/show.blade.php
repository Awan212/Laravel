<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Class Teacher's List</h6>
        <button class="btn btn-success float-right btn-add">Add</button>
        <button class="btn btn-primary float-right mr-2 btn-print"> <i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Salary</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Salary</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($salaries as $key => $salary)
                    <tr class="TeacherSalaryPage">
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div class="TeacherProfile">
                                <img src="{{ asset($salary->teacher_profile_pic) }}" alt="" width="100%" height="100%">
                            </div>
                            <small >#{{ $salary->teacher_id}} </small>
                            <h5>{{ $salary->teacher_name }}</h5>

                        </td>
                        <td>{{ $salary->salary }}</td>
                        <td style="width: 300px;" class="noprint">
                            <a class="btn btn-secondary btn-detail" href="salary_detail?salary_id={{ $salary->id }}&teacher_id={{$salary->teacher}}">Detail</a>
                            <button class="btn btn-primary btn-edit" data-id="{{ $salary->id }}">Edit</button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $salary->id }}">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <ul>
            <li class="h5">Here those teacher display those are active.</li>
        </ul>
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
