<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Class Teacher's List</h6>
        <button class="btn btn-success float-right btn-add">Add</button>
        <button class="btn btn-primary float-right mr-2 btn-print"> <i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher Profile</th>
                        <th>Teacher id & Name</th>
                        <th>Class & Section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Teacher Profile</th>
                        <th>Teacher id & Name</th>
                        <th>Class & Section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach($data['classTeachers'] as $key => $classTeacher)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div style="width:3rem; height:3rem; border-radius:50%; overflow:hidden;">
                                <img src="{{ $classTeacher->teachers->teacher_profile_pic }}" alt="" width="100%"
                                    height="auto">
                            </div>
                        </td>
                        <td>#{{ $classTeacher->teachers->teacher_id }} -- {{$classTeacher->teachers->teacher_name}}</td>
                        <td>{{ $classTeacher->class->class_title }} -- {{ $classTeacher->class->section_name }}</td>
                        <td class="noprint">
                            <button class="btn btn-primary btn-edit" data-id="{{ $classTeacher->id }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="{{ $classTeacher->id }}" data-toggle="tooltip" data-placement="top" title="Remove">
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
    $(document).ready(function() {
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
        $('#dataTable').DataTable();
    });
</script>