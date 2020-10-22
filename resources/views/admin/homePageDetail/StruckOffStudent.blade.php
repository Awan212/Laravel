<div class="table-responsive">
    <table class="table table-bordered struck-off-student table-sm" id="dataTable2" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Class & Section</th>
                <th>Phone Number</th>
                <th class="noprint">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Class & Section</th>
                <th>Phone Number</th>
                <th class="noprint">Action</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($data['struck_off'] as $key => $struckOff)
            <tr>
                <th>{{ $key + 1 }}</th>
                <th>{{ $struckOff->student_name }}</th>
                <th>#{{ $struckOff->student_roll_no }}</th>
                <th>{{ $struckOff->class->class_title}} | {{ $struckOff->class->section_name}}</th>
                <th>{{ $struckOff->student_guardian_phone_no }}</th>
                <th class="noprint">
                    <button class="btn btn-primary btn-edit-student"
                        data-id="{{ $struckOff->student_roll_no }}">Edit</button>
                    <!-- <button class="btn btn-danger btn-remove" data-id="{{ $struckOff->student_roll_no }}">Remove</button> -->
                </th>
            </tr>
            @endforeach
        </tbody>
        <tbody>
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function () {
        $("#dataTable2").dataTable();
    });
</script>