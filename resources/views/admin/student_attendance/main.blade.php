@extends('admin.layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8">
                <h4 class="m-0 font-weight-bold float-left text-primary">Student Attendance</h4>
            </div>
            <div class="col-sm-4">
                <button class="btn float-right btn-primary print">Print</button>
            </div>
        </div>
        <div id="showMessage"></div>
        <div class="form-group row">
            <div class="col-sm-6">
                <select name="class" id="class" class="form-control" required>
                    <option value="" disabled selected hidden>Select class and section</option>
                    @foreach($data['classes'] as $class)
                    <option value="{{ $class->id }}">{{ $class->class_title }} & {{ $class->section_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <button class="btn btn-success btn-show">Show</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</td>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Class & section</th>
                        <th class="noprint">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($data['students'] as $key => $student)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div class="profile-Img">
                                <img src="{{ asset($student->student_profile_pic) }}" alt="" width="100%" height="100%">
                            </div>
                        </td>
                        <td>{{ $student->student_name }}</td>
                        <td>#{{ $student->student_roll_no }}</td>
                        <td>{{ $student->class->class_title }} & {{ $student->class->section_name }}</td>
                        <td>
                            <a href="student_attendance_detail?student={{ $student->id }}" class="btn btn-secondary"
                                data-toggle="tooltip" data-placement="top" title="Show detail">Show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $(".btn-show").on('click', function () {
            $.ajax({
                url: 'show_class_base_student',
                method: 'get',
                data: {
                    class: $("#class").val()
                },
                beforeSend: function () {
                    $("#showMessage").html('');
                    $("#showMessage").removeClass();
                    $(".card-body").html('');
                    $(".card-body").html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
                },
                success: function (data) {
                    if (data.response == 0) {
                        $("#showMessage").append('*' + ' ' + data.message + '<br>');
                        $("#showMessage").addClass(data.class);
                        $(".card-body").html('');
                    }
                    $(".card-body").append(data);
                    $(".spinner-border").addClass('d-none');
                }
            });
        });
    });
</script>
@endsection
