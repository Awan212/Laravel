<!-- DataTales of Subjects -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Subject Teacher's List</h6>
        <button class="btn btn-success float-right btn-add">Add</button>
        <button class="btn btn-primary float-right mr-2 btn-print"><i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher Profile</th>
                        <th>Teacher Name</th>
                        <th>Class & Section</th>
                        <th>Subject</th>
                        <th>Lecture Time</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Teacher Profile</th>
                        <th>Teacher Name</th>
                        <th>Class & Section</th>
                        <th>Subject</th>
                        <th>Lecture Time</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @isset($subjectTeachers)
                        @foreach($subjectTeachers as $key => $subjectTeacher)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <div style="width:4rem; height:4rem; border-radius:50%; overflow:hidden;">
                                        <img src="{{ $subjectTeacher->teachers->teacher_profile_pic }}" alt="" width="100%" height="auto">
                                    </div>
                                </td>
                                <td>{{ $subjectTeacher->teachers->teacher_name}}</td>
                                <td>{{ $subjectTeacher->class->class_title}} -- {{ $subjectTeacher->class->section_name}}</td>
                                <td>{{ $subjectTeacher->subject_title}}</td>
                                <td>{{ $subjectTeacher->lecture_start_time }} -- {{ $subjectTeacher->lecture_end_time}} </td>
                                <td class="noprint">
                                    <button class="btn btn-primary btn-edit" data-id="{{ $subjectTeacher->id }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $subjectTeacher->id }}" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
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