<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Teacher List</h6>
        <button class="float-right btn btn-primary print">Print</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th> Name</th>
                        <th>Father Name</th>
                        <th>Phone #</th>
                        <th>Qualification</th>
                        <th>CNIC</th>
                        <th>Class Teacher</th>
                        <th>Email</th>
                        <th>D.o.B</th>
                        <th>Address</th>
                        <th>Religion</th>
                        <th>Ref Name</th>
                        <th>Ref NIC</th>
                        <th>Ref cell #</th>
                        <th>Designation</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th class="noprint" >Card</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Phone #</th>
                        <th>Qualification</th>
                        <th>CNIC</th>
                        <th>Class Teacher</th>
                        <th>Email</th>
                        <th>D.o.B</th>
                        <th>Address</th>
                        <th>Religion</th>
                        <th>Ref Name</th>
                        <th>Ref NIC</th>
                        <th>Ref cell #</th>
                        <th>Designation</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th class="noprint">Card</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($teachers as $key => $teacher)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div style="width:4.2rem; height:4.2rem; border-radius:50%; overflow:hidden;">
                                <img src="{{ $teacher->teacher_profile_pic }}" width="100%" height="100%" alt="">
                            </div>
                        </td>
                        <td>{{ $teacher->teacher_name }}</td>
                        <td>{{ $teacher->teacher_father_name }}</td>
                        <td>{{ $teacher->teacher_phone}}</td>
                        <td>{{ $teacher->teacher_qualification}}</td>
                        <td>{{ $teacher->teacher_nic }}</td>
                        <td>{{ $teacher->is_class_teacher }}</td>
                        <td>{{ $teacher->teacher_email }}</td>
                        <td>{{ $teacher->teacher_dob }}</td>
                        <td>{{ $teacher->teacher_address }}</td>
                        <td>{{ $teacher->teacher_religion }}</td>
                        <td>{{ $teacher->refrance_name }}</td>
                        <td>{{ $teacher->refrence_cnic }}</td>
                        <td>{{ $teacher->refrence_phone_no }}</td>
                        <td>{{ $teacher->teacher_designation }}</td>
                        <td>{{ $teacher->teacher_gender }}</td>
                        <td>
                            @if($teacher->is_active == '1')
                            Working
                            @else
                            Leave
                            @endif
                        </td>
                        <td class="noprint">
                            <button class="btn btn-primary card-print" data-id="{{ $teacher->id }}" data-toggle="tooltip" data-placement="top" title="Print Card">Print</button>
                        </td>
                        <td class="noprint">
                            <button class=" btn btn-success edit-btn" data-id="{{ $teacher->id }}" data-toggle="tooltip" data-placement="top" title="Edit Profile">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete"  data-id="{{ $teacher->id }}" data-toggle="tooltip" data-placement="top" title="Remove">
                                <i class="fa fa-trash" aria-hidden="true"></i>
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
