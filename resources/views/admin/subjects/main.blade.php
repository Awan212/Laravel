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

@error('subjects')
<div class="alert alert-danger">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror


<div class="content"></div>
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
                    <p>If you delete this subject then due to your this action class & sections which have these
                        subjects are also delete and also teachers and students.</p>
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
<div class="modal fade " id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalPreviewLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="delete_subject" method="post">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-triangle fa-8x text-warning" aria-hidden="true"></i>
                    <p class="h2 mt-2">Confirm to delete it?</p>
                    @csrf
                    <input type="hidden" name="subject_id" id="subject_id">
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


<!-- Edit Modal -->
<div class="modal fade animate__animated animate__backInDown" id="editModal" tabindex="-1" role="dialog"
    aria-labelledby="editModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Courses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_subjects">
                <div class="modal-body">
                    @csrf
                    <div id="updateMessage"></div>
                    <input type="hidden" name="subjects_id" id="subjects_id" class="form-control">
                    <label>Subjects</label>
                    <input type="text" name="subjects" id="subjects" class="form-control">
                    <label>Practical Subjects</label>
                    <input type="text" name="practical" id="practical" class="form-control">
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


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_new_cousre">
                <div class="modal-body">
                    <div id="addMessage"></div>
                    @csrf

                    <label for="subjects">Subject:</label>
                    <input type="text" name="subjects" class="form-control" id="subjects" placeholder="Subjects" required>

                    <label for="practical_subjects">Practical Subject:</label>
                    <input type="text" name="practical_subjects" class="form-control" id="practical_subjects"  placeholder="Practical subjects">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {

        $(".content").load('show_course_list');

        // print button
        $(document).on('click', ".print" ,function () {
            $(".table").printThis({
                printContainer: true,
                header: 'Subjects List',
                pageTitle: "Subject List",
            });

        });
        // warning before deletion
        $(document).on('click', ".delete-btn" ,function () {
            $("#warningModal").modal('show');
        });
        //show delete modal
        $(".btn-procced-to-delete").on('click', function () {
            $("#warningModal").modal('hide');
            $("#subject_id").val($(".delete-btn").attr('data-id'));
            $("#deleteModal").modal('show');
        });

        //show model to edit subjects
        // $(".btn-edit").on('click',function(){
        //     $("#subjects_id").val($(this).attr('data-subject-id'));
        //     $("#subjects").val($(this).attr('data-subjects'));
        //     $("#practical").val($(this).attr('data-practical'));
        //     $("#editModal").modal('show');
        // });

        $(document).on('click', ".btn-edit" ,function () {
            $("#updateMessage").html('');
            $("#updateMessage").removeClass();
            $.ajax({
                url: 'edit_subjects',
                method: 'get',
                data: {
                    subject_id: $(this).attr('data-id')
                },
                success: function (data) {
                    $("#subjects_id").val(data.id);
                    $("#subjects").val(data.subjects);
                    $("#practical").val(data.practical_subjects);
                    $("#editModal").modal('show');
                }
            });
        });

        $("#update_subjects").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'update_subjects',
                method: 'post',
                data: new FormData(this),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $("#updateMessage").html(' ');
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
                    }
                }
            });
        });


        $(document).on('click', ".btn-add" ,function () {
            $("#addMessage").html('');
            $("#addMessage").removeClass();
            $("#addModal").modal('show');
        });
        $("#save_new_cousre").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: 'save_new_course',
                method: 'post',
                data: new FormData(this),
                processData:false,
                dataType: 'JSON',
                contentType:false,
                cache:false,
                beforeSend:function()
                {
                    $("#addMessage").html('');
                    $("#addMessage").removeClass();
                },
                success:function(data)
                {
                    if(data.response == 0)
                    {
                        $.each(data.errors ,function(i,v){
                            $("#addMessage").append('*' + ' ' + v + '<br>');
                        });
                        $("#addMessage").addClass(data.class);
                    }
                    else
                    {
                        $("#addMessage").append(data.message);
                        $("#addMessage").addClass(data.class);
                    }
                }
            });
        })
    });
</script>

@endsection