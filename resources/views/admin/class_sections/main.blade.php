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


@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ Session::get('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>

@endif

<div class="content"></div>



<!-- add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Class and Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_class_section">
        <div class="modal-body">
          @csrf
          <div id="addMessage"></div>
          <label for="class_title">Class Title *</label>
          <input type="text" name="class_title" class="form-control" id="add_class_title" placeholder="class_title"
            required>
          <label for="class_title">Section Name *</label>
          <input type="text" name="section_name" class="form-control" id="add_section_name" placeholder="Section Name">
          <label for="subjects">Subject List *</label>
          <select class="form-control" name="class_subjects" id="add_class_subjects" required>
            <option value="" disabled selected hidden>Choose a subjects</option>
            @foreach ($data['subjects'] as $subject)
            <option value="{{$subject->id}}">
              {{$subject->subjects}} | {{ $subject->practical_subjects }}
            </option>
            @endforeach
          </select>

          <label for="seats">Seats *</label>
          <input type="number" name="class_seats" class="form-control" id="add_class_seats" placeholder="seats"
            required>
          <ul class="text-muted mt-4">
            <li>Class title like PG One Two .. 10th 11th 12th.</li>
            <li>Class section means that 12th class has 4 section A B C D.</li>
            <li>Possible Subjects Combination for that class and section.</li>
            <li>No of students that are possibly enrolled in that section and class.</li>
          </ul>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
          <button class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- add modal -->


<!-- Edit Modal -->
<div class="modal fade animate__animated animate__backInDown" id="editModal" tabindex="-1" role="dialog"
  aria-labelledby="editModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Class & Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update_class_section">
        <div class="modal-body">
          @csrf
          <input type="hidden" name="class_section_id" id="class_section_id" class="form-control">
          <div id="updateMessage"></div>
          <label>Class</label>
          <input type="text" name="class_title" id="class_title" class="form-control">
          <label>Section</label>
          <input type=" text" name="section" id="section" class="form-control">
          <label>Subjects</label>
          <select name="subjects" id="subjects" class="form-control">
            <option value="" disabled selected hidden>Choose a subjects</option>
            @foreach( $data['subjects'] as $subject)
            <option id="subject{{ $subject->id }}" value="{{ $subject->id }}">{{ $subject->subjects }} --
              {{ $subject->practical_subjects }}
            </option>
            @endforeach
          </select>
          <label>Seats</label>
          <input type="number" name="seats" id="seats" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal -->

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
          <p>If you delete this class then due to your this action student which are enroll in this class also remove
            and subjects teachers,class teachers.</p>
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
<div class="modal fade animate__animated animate__heartBeat" id="deleteModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="delete_class_section" method="post">

        <div class="modal-body text-center">
          <i class="fa fa-exclamation-triangle fa-8x text-danger" aria-hidden="true"></i>
          <p class="h2 mt-2">Confirm to delete it?</p>
          @csrf
          <input type="hidden" name="class_id" id="class_id">
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

    $(".content").load('show_class_section');

    // print
    $(document).on('click', ".print", function () {
      $(".table").printThis({
        printContainer: true,
        header: 'Class & sections List',
      });

    });

    $(document).on('click', '.btn-add', function () {
      $("#addMessage").html('');
      $("#addMessage").removeClass();
      $("#addModal").modal('show');
      $('#add_class_section')[0].reset();
    });

    $("#add_class_section").on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: 'add_class_section',
        method: 'post',
        data: new FormData(this),
        processData: false,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        beforeSend: function () {
          $("#addMessage").html('');
          $("#addMessage").removeClass();
        },
        success: function (data) {
          if (data.response == 0) {
            $.each(data.errors, function (i, v) {
              $("#addMessage").append('*' + ' ' + v + '<br>');
            });
            $("#addMessage").addClass(data.class);
          }
          else {
            $("#addMessage").append(data.message);
            $("#addMessage").addClass(data.class);
            $(".content").load('show_class_section');
          }
        }
      });
    });
    // edit model
    $(document).on('click', ".btn-edit", function () {
      $("#updateMessage").html('');
      $("#updateMessage").removeClass();
      $.ajax({
        url: 'edit_class_section',
        method: 'get',
        data: {
          class_section: $(this).attr('data-id'),
        },
        success: function (data) {
          $("#class_section_id").val(data.id);
          $("#class_title").val(data.class_title);
          $("#section").val(data.section_name);
          $("#subject" + data.subjects_id).attr('selected', false);
          $("#subject" + data.subjects_id).attr('selected', true);
          $("#seats").val(data.seats)
          $("#editModal").modal('show');
        }
      });
    });

    $("#update_class_section").on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: 'update_class_section',
        method: 'post',
        data: new FormData(this),
        processData: false,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        beforeSend: function () {
          $("#updateMessage").html('');
          $("#updateMessage").removeClass();
        },
        success: function (data) {
          if (data.response == 0) {
            $.each(data.errors, function (i, v) {
              $("#updateMessage").append('*' + ' ' + v + '<br>');
            });
            $("#updateMessage").addClass(data.class);
          }
          else {
            $("#updateMessage").append(data.message);
            $("#updateMessage").addClass(data.class);
            $(".content").load('show_class_section');
          }
        }
      });
    });

    // warning model
    $(document).on('click', ".delete-btn", function () {
      $("#warningModal").modal('show');
    });

    // delete model
    $(".btn-procced-to-delete").on('click', function () {
      $("#warningModal").modal('hide');
      $("#class_id").val($('.delete-btn').attr('data-id'));
      $("#deleteModal").modal('show');
    });

  });
</script>
@endsection