<div class="table-responsive">
    <table class="table table-bordered class_base_student_list table-hover table-sm" id="dataTable1">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Picture</th>
                <th scope="col">Roll #</th>
                <th scope="col">Name</th>
                <th scope="col">Father Name</th>
                <th scope="col">NIC #</th>
                <th scope="col">Class & Section</th>
                <th scope="col">Email</th>
                <th scope="col">D.o.B</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Religon</th>
                <th scope="col">Guardian Name</th>
                <th scope="col">Guardian NIC</th>
                <th scope="col">Guardian cell #</th>
                <th scope="col">Guardian Occopation</th>
                <th scope="col">Studing/Leaved</th>
                <th scope="col">Struck Off</th>
                <th scope="col" class="noprint">Card</th>
                <th scope="col" class="noprint">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Picture</th>
                <th scope="col">Roll #</th>
                <th scope="col">Name</th>
                <th scope="col">Father Name</th>
                <th scope="col">NIC #</th>
                <th scope="col">Class & Section</th>
                <th scope="col">Email</th>
                <th scope="col">D.o.B</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Religon</th>
                <th scope="col">Guardian Name</th>
                <th scope="col">Guardian NIC</th>
                <th scope="col">Guardian cell #</th>
                <th scope="col">Guardian Occopation</th>
                <th scope="col">Studing/Leaved</th>
                <th scope="col">Struck Off</th>
                <th scope="col" class="noprint">Card</th>
                <th scope="col" class="noprint">Action</th>
            </tr>
        </tfoot>
        <tbody>

            @foreach($data['students'] as $key => $student)
            <tr scope="row">
                <td>{{$key+1}}</td>
                <td>
                    <div style="width:50px; height:50px; border-radius:100%; overflow: hidden;">
                        <img src="{{ $student->student_profile_pic }}" alt="" width="100%" height="auto">
                    </div>
                </td>
                <td># {{$student->student_roll_no}}</td>
                <td>{{$student->student_name}}</td>
                <td>{{$student->student_father_name}}</td>
                <td>{{$student->student_cnic}}</td>
                <td>{{$student->class->class_title}} | {{$student->class->section_name}}</td>
                <td>{{$student->student_email}}</td>
                <td>{{$student->dob}}</td>
                <td>{{$student->student_gender}}</td>
                <td>{{$student->student_address}}</td>
                <td>{{$student->student_religion}}</td>
                <td>{{$student->student_guardian_name}}</td>
                <td>{{$student->student_guardian_cnic}}</td>
                <td>{{$student->student_guardian_phone_no}}</td>
                <td>{{$student->student_guardian_occopation}}</td>
                <td>
                    @if($student->is_active == 0)
                        <p class="p-2 text-white bg-danger">Leaved</p>
                    @else
                        <p class="p-2 text-white bg-success">Studing</p>
                    @endif
                </td>
                <td>
                    @if($student->struck_off == 1)
                        <p class="p-2 text-white bg-danger">Struck Off</p>
                    @else
                        <p class="p-2 text-white bg-success">Studing</p>
                    @endif
                </td>
                <td class="noprint">
                    <button class="btn btn-primary card-print" data-id="{{ $student->id }}">Print</button>
                </td>
                <td colspan="2" class="noprint">
                    <button class="btn btn-success edit-btn" data-id={{ $student->student_roll_no }}>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger delete-btn" data-id="{{$student->id}}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $("#dataTable1").dataTable({
            scrollX:        true,
            paging:         true,

        });
    });
</script>