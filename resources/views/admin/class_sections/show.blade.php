<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Class & Section List</h6>
        <button class="btn btn-success ml-2 float-right btn-add">Add New Class or Section</button>
        <button class="btn btn-primary float-right print">Print</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subjects </th>
                        <th>Practical Subjects</th>
                        <th>Seats</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subjects</th>
                        <th>Practical Subjects</th>
                        <th>Seats</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['classes'] as $key => $class)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $class->class_title }}</td>
                        <td>{{ $class->section_name }}</td>
                        <td>{{ $class->subjects->subjects }}</td>
                        <td>{{ $class->subjects->practical_subjects }}</td>
                        <td>{{ $class->seats }}</td>
                        <td class="noprint">
                            <button class="btn btn-success btn-edit" data-id="{{ $class->id }}"
                                data-class="{{ $class->class_title }}" data-section="{{ $class->section_name }}"
                                data-subject="{{ $class->subjects->id }}" data-seat="{{ $class->seats }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete-btn" data-id="{{ $class->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
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
    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('#dataTable').DataTable();
    });
</script>