@extends('admin.layouts.app')
@section('content')

@if(Session::has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<!-- active student -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 h4 font-weight-bold float-left text-primary">Student List</h6>
    <button class="btn float-right btn-primary print">Print</button>
  </div>
  <div class="card-body">
    <div class="content"></div>
  </div>
</div>
<!-- active student -->

<!-- struck off studnet -->
<div class="card mb-4">
  <div class="card-header">
    <h3 class="float-left h2 text-primary font-weight-bold">Struck Off Student</h3>
    <button class="btn btn-primary btn-print-struck-off float-right">Print</button>
  </div>
  <div class="card-body">
    <div id="StruckOffStudent"></div>
  </div>
</div>
<!-- struck off student -->

<!-- Leave Student list -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 h4 font-weight-bold float-left text-primary">Leave Student List</h6>
    <button class="btn float-right btn-primary btn-print-leave-student">Print</button>

  </div>
  <div class="card-body">
    <div id="leave_student_list"></div>
  </div>
</div>
<!-- Leave student list -->

<div class="card shadow">
  <div class="card-header">
    <h1 class="h2 text-dark float-left">Class Student</h1>
    <button class="btn btn-primary btn-class-student-print float-right">Print</button>
  </div>
  <div class="card-body">
    <label for="class_section">Class Section:</label>
    <select name="search_class_student" id="search_class_student" class="form-control custom-select mb-4">
      @foreach($data['classes'] as $class)
      <option id="class{{$class->id}}" value="{{ $class->id }}">{{ $class->class_title }} -- {{ $class->section_name }}
      </option>
      @endforeach
    </select>
    <div id="class_base_student"></div>
  </div>
</div>

<!-- edit Modal -->
<div class="modal fade bottom" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateStudentProfileFrom" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <input type="hidden" name="student_id" id="student_id">
          <div class="file-upload w-25 m-auto">
            <img src="" id="student_profile" width="100%" height="100%" />
          </div>
          <input type="file" name="editStudentProfile" id="editStudentProfile" accept="image/gif, image/jpeg, image/png"
            class="form-control w-25 m-auto" />

          <div id="message" class="mt-2"></div>

          <div class="form-group-row">
            <div class="col-sm-6 m-auto">
              <label for="name">Roll No:</label>
              <input type="text" name="roll_no" id="roll_no" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="name">Name:</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="father_name">Father Name:</label>
              <input type="text" name="father_name" id="father_name" class="form-control">
            </div>
          </div>

          <div class="from-group row">
            <div class="col-sm-6">
              <label for="class">Class & Sections:</label>
              <select name="class_section" id="class_section" class="form-control">
                @foreach($data['classes'] as $class)
                <option id="class{{$class->id}}" value="{{ $class->id }}">{{ $class->class_title }} --
                  {{ $class->section_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label for="nic">CNIC #:</label>
              <input type="text" name="cnic" id="cnic" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="email">Email:</label>
              <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="dob">date of Birh</label>
              <input type="date" name="dob" id="dob" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="gender">Gender</label>
              <select name="gender" id="gender" class="form-control">
                <option value="" id="disabled" disabled selected hidden>Choose Gender</option>
                <option id="male" value="male">Male</option>
                <option id="female" value="female">Female</option>
                <option id="other" value="other">Other</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="address">Addres:</label>
              <input type="text" name="address" id="address" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="for">Religion</label>
              <select name="religion" id="religion" class="form-control">
                <option value="" disabled selected hidden>Choose Religion</option>
                <option id="islam" value="islam">Islam</option>
                <option id="other-religion" value="other">Other</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="guardian_name">Guardian Name:</label>
              <input type="text" id="guardian_name" class="form-control" name="guardian_name">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <label for="guardian_cnic">Guardian CNIC:</label>
              <input type="text" name="guardian_cnic" id="guardian_cnic" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="guardian_phone_no">Guardian Phone #</label>
              <input type="text" name="guaridan_phone" id="guardian_phone" class="form-control">
            </div>
          </div>

          <label for="Guardian_occoption">Guardian Occoption</label>
          <input type="text" name="guardian_occopa" id="guardian_occopa" class="form-control">

          <label for="Leave">Leave</label>
          <select name="student_status" id="student_status" class="form-control">
            <option id="yesLeave" value="0">Yes</option>
            <option id="notLeaved" value="1">No</option>
          </select>

          <label for="struckOff">Struck Off</label>
          <select name="struck_off" id="struck_off" class="form-control">
            <option id="yesStruckOff" value="1">Yes</option>
            <option id="notStruckOff" value="0">No</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
          <button class="btn btn-success update-btn">Procced</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- edit Modal -->

<!-- Delete Modal -->
<div class="modal fade bottom" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel"
  aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="delete_student" method="post">
        <div class="modal-body text-center">

          <i class="fa fa-exclamation-triangle fa-8x text-warning" aria-hidden="true"></i>

          <p class="h2 mt-2">Confirm to delete it?</p>
          @csrf
          <input type="hidden" name="student_id" id="student_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
          <button class="btn btn-danger">Procced</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Modal -->


@endsection

@section('script')
<script>
  $(document).ready(function () {
    //display student list
    $('.content').load('show_students');
    $("#leave_student_list").load('leave_student_list');
    $("#StruckOffStudent").load('struck_off_student_list');
    //profile previw
    $('#editStudentProfile').change(function (event) {
      //alert($('#student_profile_pic').val());
      $('#student_profile').attr('src', URL.createObjectURL(event.target.files[0])).width('200px').height('100%');
    });

    $(".btn-print-struck-off").on('click', function () {
            $(".struck-off-student").printThis();
    });

    // print
    $(document).on('click', '.print', function () {
      $('.table-all-student-list').printThis({
        header: 'Students List',
      });
    });

    $(".btn-print-leave-student").on('click', function () {
      $(".table-leave-student").printThis();
    });

    $(".btn-class-student-print").on('click', function () {
      $(".class_base_student_list").printThis();
    });

    $(document).on('click', ".edit-btn", function () {
      $("#message").html('');
      $("#message").removeClass('alert alert-danger');
      $("#message").removeClass('alert alert-success');

      var student_roll = $(this).attr('data-id');
      $.ajax({

        url: 'edit_student',
        method: 'get',
        data: { student_roll_no: student_roll },
        success: function (data) {
          $("#student_id").val(data.id);
          $("#student_profile").attr('src', data.student_profile_pic);
          $("#roll_no").val(data.student_roll_no);
          $("#name").val(data.student_name);
          $("#father_name").val(data.student_father_name);
          $("#class_section").attr('selected', false);
          $("#class" + data.class_sections_id).attr('selected', true);
          // $("#class_section").append('<option value="' + data.class_sections_id + '" selected>' + data.class.class_title + ' --  ' + data.class.section_name + '</option>');
          $("#cnic").val(data.student_cnic);
          $("#email").val(data.student_email);
          $("#dob").val(data.dob);
          if (data.student_gender == 'male') {
            $("#male").attr('selected', true);
          } else if (data.student_gender == 'female') {
            $("#female").attr('selected', true);
          }
          else {
            $("#other").attr('selected', true);
          }
          $("#address").val(data.student_address);
          if (data.student_religion == 'islam') {
            $("#islam").attr('selected', true);
          }
          else if (data.student_religion == 'other') {
            $("#other-religion").attr('selected', true);
          }
          $("#guardian_name").val(data.student_guardian_name);
          $("#guardian_cnic").val(data.student_guardian_cnic);
          $("#guardian_phone").val(data.student_guardian_phone_no);
          $("#guardian_occopa").val(data.student_guardian_occopation)
          if (data.is_active == 1) {
            $("#notLeaved").attr('selected', true);
          }
          else {
            $("#yesLeave").attr('selected', true);
          }
          if (data.struck_off == 1) {
            $("#notStruckOff").attr('selected', false);
            $("#yesStruckOff").attr('selected', true);
          }
          else {
            $("#yesStruckOff").attr('selected', false);
            $("#notStruckOff").attr('selected', true);
          }
          $("#editModal").modal('show');
        }
      });


    });


    $(document).on('click', '.btn-edit-student', function () {
            $("#message").html('');
            $("#message").removeClass('alert alert-danger');
            $("#message").removeClass('alert alert-success');
            var student_roll = $(this).attr('data-id');
            $.ajax({
                url: 'edit_student',
                method: 'get',
                data: { student_roll_no: student_roll },
                success: function (data) {
                    $("#student_id").val(data.id);
                    $("#student_profile").attr('src', data.student_profile_pic);
                    $("#roll_no").val(data.student_roll_no);
                    $("#name").val(data.student_name);
                    $("#father_name").val(data.student_father_name);
                    $("#class_section").attr('selected', false);
                    $("#class" + data.class_sections_id).attr('selected', true);
                    // $("#class_section").append('<option value="' + data.class_sections_id + '" selected>' + data.class.class_title + ' --  ' + data.class.section_name + '</option>');
                    $("#cnic").val(data.student_cnic);
                    $("#email").val(data.student_email);
                    $("#dob").val(data.dob);
                    if (data.student_gender == 'male') {
                        $("#male").attr('selected', true);
                    } else if (data.student_gender == 'female') {
                        $("#female").attr('selected', true);
                    }
                    else {
                        $("#other").attr('selected', true);
                    }
                    $("#address").val(data.student_address);
                    if (data.student_religion == 'islam') {
                        $("#islam").attr('selected', true);
                    }
                    else if (data.student_religion == 'other') {
                        $("#other-religion").attr('selected', true);
                    }
                    $("#guardian_name").val(data.student_guardian_name);
                    $("#guardian_cnic").val(data.student_guardian_cnic);
                    $("#guardian_phone").val(data.student_guardian_phone_no);
                    $("#guardian_occopa").val(data.student_guardian_occopation)
                    if (data.is_active == 1) {
                        $("#yesLeave").attr('selected', false);
                        $("#notLeaved").attr('selected', true);
                    }
                    else {
                        $("#notLeaved").attr('selected', false);
                        $("#yesLeave").attr('selected', true);
                    }
                    if (data.struck_off == 1) {
                        $("#notStruckOff").attr('selected', false);
                        $("#yesStruckOff").attr('selected', true);
                    }
                    else {
                        $("#yesStruckOff").attr('selected', false);
                        $("#notStruckOff").attr('selected', true);
                    }
                    $("#editModal").modal('show');
                }

            });

        });

    // update studentr profile

    $(document).on('submit', "#updateStudentProfileFrom", function (e) {
      e.preventDefault();
      $.ajax({
        url: 'update_student',
        method: 'POST',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#message").html('');
          $("#message").removeClass('alert alert-danger');
          $("#message").removeClass('alert alert-success');
          $("#update-btn").append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
          if (data.response == '0') {
            $.each(data.error, function (i, v) {
              $("#message").append(v + '<br>');
            });
            $("#message").addClass(data.class);
          }
          else if (data.response == '1') {
            $("#message").append(data.message);
            $("#message").addClass(data.class);
            $("#editModal").animate({ scrollTop: 0 }, 600);
            $('.content').load('show_students');
            $("#StruckOffStudent").load('struck_off_student_list');
            search_class();
          }

        }

      });

    });

    //delete model
    $(document).on('click', ".delete-btn", function () {
      $("#student_id").val($(this).attr('data-id'));
      $("#deleteModal").modal('show');
    });

    function search_class() {
      $.ajax({
        url: 'search_class_base_student_list',
        method: 'get',
        data: {
          class_section_id: $('#search_class_student').val()
        },
        beforeSend: function () {
          $("#class_base_student").html('');
        },
        success: function (data) {
          $("#class_base_student").append(data);
        }
      });
    }

    $('#search_class_student').on('change', function () {
      search_class();

    });

  });
</script>
@endsection