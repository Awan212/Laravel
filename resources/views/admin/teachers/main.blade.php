<!-- teacher phone no field is missing  -->

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

<div class="content"></div>






<!-- teacher card Modal -->
<div class="modal fade bottom" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="cardModalPreviewLabel"
  aria-hidden="true">
  <div class="modal-dialog   modal-lg  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Teacher Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <div class="row teacher-card">
          <div class="col-sm-4">
            <div style="width: 200px; height: 220px;">
              <img src="" id="teacherCardProfile" alt="" width="100%" height="100%">
            </div>
            <div class="w-75 m-auto text-center">
              <span>Teacher #</span>
              <p id="teacherId"></p>
            </div>
          </div>

          <div class="col-sm-8">
            <h1 class="text-center">The Jinnah School</h1>
            <div class="row">

              <div class="col-sm-6">
                <span class="d-block">Teacher Name:</span>
                <span class="d-block h4 name"></span>
              </div>

              <div class="col-sm-6">
                <span class="d-block">Father Name:</span>
                <span class="d-block h4 father"></span>
              </div>

            </div>

            <div class="row">

              <div class="col-sm-6">
                <span class="d-block">Date of Birth:</span>
                <Address class="d-block h5 dob"></Address>
              </div>

              <div class="col-sm-6">
                <span class="d-block">Class Teacher:</span>
                <span class="d-block h5 class"></span>
              </div>

            </div>


            <div class="row">

              <div class="col-sm-6">
                <span class="d-block">Address:</span>
                <Address class="d-block h5 address"></Address>
              </div>

              <div class="col-sm-6">
                <span class="d-block">CNIC #:</span>
                <span class="d-block h5 cnic"></span>
              </div>

            </div>

          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
        <button class="btn btn-danger card-print-out">Print</button>
      </div>
    </div>
  </div>
</div>
<!-- teacher card Modal -->




<!-- edit teacher modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="editTeacherModalTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTeacherModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="spinner">
          <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>


        <form id="updateTeacherProfile" method="post" enctype="multipart/form-data">
          <div id="message" class="m-2"></div>
          @csrf
          <div class="w-25 m-auto">
            <div class="mb-2" style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%;">
              <img src="" id="teacher_profile_pic" alt="" width="100%" height="100%">
            </div>
            <input type="file" name="teacher_profile" id="teacher_profile" class="form-control form-control-file">
          </div>


          <div class="form-group row mt-2">
            <div class="col-sm-6 m-auto">
              <input type="hidden" name="teacher_id" id="teacher_id">
            </div>
          </div>

          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="name">Name:</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-sm-6">
              <label for="father_name">Father Name:</label>
              <input type="text" name="father_name" id="father_name" class="form-control">
            </div>
          </div>

          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="qualification">Qualification:</label>
              <input type="text" name="qualification" id="qualification" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="number">Phone Number:</label>
              <input type="text" name="phone_number" id="phone_number" class="form-control">
            </div>
          </div>

          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="class_teacher">Class Teacher</label>
              <select name="class_teacher" id="class_teacher" class="form-control">
                <option id="yesClassTeacher" value="yes">Yes</option>
                <option id="noClassTeacher" value="no">No</option>
              </select>
            </div>

            <div class="col-sm-6">
              <label for="cnic">CNIC:</label>
              <input type="text" name="cnic" id="cnic" class="form-control">
            </div>
          </div>


          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="dob">Date of Birth:</label>
              <input type="date" name="dob" id="dob" class="form-control">
            </div>
          </div>

          <div class="form-group row mt-2">
            <div class="col-sm-6 m-auto">
              <label for="address">Address</label>
              <input type="text" name="address" id="address" class="form-control">
            </div>
          </div>


          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="religion">Religion</label>
              <select name="religion" id="religion" class="form-control">
                <option id="islam" value="islam">Islam</option>
                <option id="other" value="other">Other</option>
              </select>
            </div>

            <div class="col-sm-6">
              <label for="ref_name">Refrence Name:</label>
              <input type="text" name="ref_name" id="ref_name" class="form-control">
            </div>
          </div>


          <div class="form-group row mt-2">

            <div class="col-sm-6">
              <label for="ref_nic">Refrence CNIC:</label>
              <input type="text" name="ref_cnic" id="ref_cnic" class="form-control">
            </div>

            <div class="col-sm-6">
              <label for="ref_phone">Refrence Phone:</label>
              <input type="tel" name="ref_phone" id="ref_phone" class="form-control">
            </div>
          </div>


          <div class="form-group row mt-2">
            <div class="col-sm-6">
              <label for="designation">Teacher Designation:</label>
              <input type="text" name="designation" id="designation" class="form-control">
            </div>

            <div class="col-sm-6 pt-4 ">
              <label for="gender">Gender:</label>
              <input type="radio" class="m-2" name="gender" id="male" value="male" checked>
              <span>Male</span>
              <input type="radio" name="gender" id="female" value="female" class="m-2">
              <span>Female</span>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6 m-auto">
              <select name="status" id="status" class="form-control">
                <option id="working" value="1">Working</option>
                <option id="leave" value="0">Leave</option>
              </select>
            </div>
          </div>

          <hr>
          <div class="form-group row">
            <div class="col-sm-6">
              <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
            </div>

            <div class="col-sm-6">
              <button class="btn btn-success ml-auto float-right btn-update">Procced</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit teacher modal -->

<!-- wqarning modal -->
<div class="modal fade animate__animated animate__pulse" id="warningModal" tabindex="-1" role="dialog"
  aria-labelledby="warningModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Warning!</h4>
          <p>If you delete this teacher then due to your this action if he/she is class teacher than his/her  also remove from class teacher section and if he/she is subjeect teacher than his/her data also remove from subject teachers sections.</p>
          <hr>
          <p class="mb-0">Whenever you need to, perform this action give notice to your seniors.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-procced-to-delete">Procced</button>
      </div>
    </div>
  </div>
</div>
<!-- warning modal -->

<!-- Delete Modal -->
<div class="modal fade " id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="delete_teacher" method="post">
          <div class="modal-body text-center">
              <i class="fa fa-exclamation-triangle fa-8x text-warning" aria-hidden="true"></i>
              <p class="h2 mt-2">Confirm to delete it?</p>
              @csrf
              <input type="hidden" name="teacher_id" id="teacher_screat">
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

    $(".content").load('show_teachers');

    $(document).on('click', ".print", function () {
      $(".table").printThis();
    });

    // card print
    $(document).on('click', ".card-print", function () {
      $.ajax({
        url: 'teacher_card',
        method: 'get',
        data: {
          teacher_id: $(this).attr('data-id')
        },
        beforeSend: function () {
          $("#teacherCardProfile").attr('src', ' ');
          $("#teacherId").html(' ');
          $(".name").html(' ');
          $(".father").html(' ');
          $(".dob").html(' ');
          $(".class").html(' ');
          $(".address").html(' ');
          $(".cnic").html(' ');
        },
        success: function (data) {
          $("#teacherCardProfile").attr('src', data.teacher_profile_pic);
          $("#teacherId").append(data.teacher_id);
          $(".name").append(data.teacher_name);
          $(".father").append(data.teacher_father_name);
          $(".dob").append(data.teacher_dob);
          $(".class").append(data.is_class_teacher);
          $(".address").append(data.teacher_address);
          $(".cnic").append(data.teacher_nic);
          $("#cardModal").modal('show');
        }
      });
    });

    $(document).on('click', ".card-print-out", function () {
      $(".teacher-card").printThis();
    });

    // preview teacher profile on edit

    $("#teacher_profile").on('change', function () {
      $("#teacher_profile_pic").attr('src', URL.createObjectURL(event.target.files[0])).width('200px').height('200px');
    });

    // edit teacher
    $(document).on('click', ".edit-btn", function () {
      $("#message").html('');
      $("#message").removeClass('alert alert-success');
      $("#message").removeClass('alert alert-danger');
      $.ajax({
        url: 'edit_teacher',
        method: 'get',
        data: {
          id: $(this).attr('data-id')
        },
        beforeSend: function () {
          $("#editTeacherModal").modal('show');
        },
        success: function (data) {
          $("#teacher_profile_pic").attr('src', data.teacher_profile_pic);
          $("#teacher_id").val(data.teacher_id);
          $("#name").val(data.teacher_name);
          $("#father_name").val(data.teacher_father_name);
          $("#qualification").val(data.teacher_qualification);
          $("#phone_number").val(data.teacher_phone);
          if (data.is_class_teacher == 'yes') {
            $("#yesClassTeacher").attr('selected', true);
          }
          else {
            $("#noClassTeacher").attr('selected', true);
          }
          $("#cnic").val(data.teacher_nic);
          $("#email").val(data.teacher_email);
          $("#dob").val(data.teacher_dob);
          $("#address").val(data.teacher_address);
          if (data.teacher_religion == 'islam') {
            $("#islam").attr('selected', true);
          }
          else {
            $("#other").attr('selected', true);
          }
          $("#ref_name").val(data.refrance_name);
          $("#ref_cnic").val(data.refrence_cnic);
          $("#ref_phone").val(data.refrence_phone_no)
          $("#designation").val(data.teacher_designation);
          if (data.teacher_gender == 'male') {
            $("#male").attr('checked', true);
          }
          else {
            $("#female").attr('checked', true);
          }
          if (data.is_active == '1') {
            $("#working").attr('selected', true);
          }
          else {
            $("#leave").attr('selected', true);
          }
          $("#spinner").addClass('d-none');
        }
      });
    });

    $("#updateTeacherProfile").on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: 'update_teacher_profile',
        method: 'post',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $("#message").html('');
          $("#message").removeClass('alert alert-success');
          $("#message").removeClass('alert alert-danger');
          $(".btn-update").append('<span class="ml-2 spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
          $(".btn-update").html('Procced');
          if (data.response == '0') {
            $.each(data.errors, function (i, v) {
              $("#message").append('*' + ' ' + v + '<br>');
            });
            $("#editTeacherModal").animate({ scrollTop: 0 }, 600);
            $("#message").addClass(data.class);

          }
          else if (data.response == '1') {

            $("#message").append(data.messages);
            $("#editTeacherModal").animate({ scrollTop: 0 }, 600);
            $("#message").addClass(data.class);
            $(".content").load('show_teachers');
          }

        }
      });

    });

    $(document).on('click',".btn-delete",function () {
      $("#warningModal").modal('show');
    });

    $(document).on('click',".btn-procced-to-delete",function(){
      // alert($(".btn-delete").attr('data-id'));
      $("#warningModal").modal('hide');
      $("#teacher_screat").val($(".btn-delete").attr('data-id'));
      $("#deleteModal").modal('show');
    });
  });
</script>
@endsection