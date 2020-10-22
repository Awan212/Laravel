
<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 h4 font-weight-bold text-primary float-left">Courses List</h6>
        <button class="float-right btn btn-success btn-add ml-2">Add Course</button>
        <button class="float-right btn btn-primary print">Print</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subjects Combination</th>
                        <th>Practical Subjects</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Subjects Combination</th>
                        <th>Practical Subjects</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($subjects as $key => $subject)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $subject->subjects }}</td>
                        <td>{{ $subject->practical_subjects }}</td>
                        <td class="noprint">
                            <button class="btn btn-success btn-edit" data-id="{{ $subject->id }}">
                                <i class="fas fa-edit"></i>Edit
                            </button>
                            <button class="btn btn-danger delete-btn" data-id="{{ $subject->id }}">
                                <i class="fas fa-trash"></i>Remove
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </div>
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
