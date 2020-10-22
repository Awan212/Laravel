@extends('admin.layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Teacher</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="save_new_teacher" enctype="multipart/form-data">

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
                @csrf

                <div class="form-group row">
                    <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                        <div style="width:200px; height:200px; margin:auto">
                            <img class="" width='100%' height="100%" src="{{ Auth::user()->user_profile_pic }}" alt="" id="profile">
                        </div>
                        <input type="file" name="teacher_profile_pic" class="mt-2 form-control form-control-file @error('teacher_profile_pic') is-invalid @enderror" value="{{ old('teacher_profile_pic')}}" id="teacher_profile_pic"  requihggred>
                        @error('teacher_profile_pic')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                        <input type="text" name="teacher_id" class="form-control form-control-user @error('teacher_id') is-invalid @enderror" value="{{ old('teacher_id')}}" id="student_roll_no" placeholder="Teacher Id " reqdfhuired>
                        @error('teacher_id')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="teacher_name" class="form-control form-control-user @error('teacher_name') is-invalid @enderror" value="{{ old('teacher_name')}}" id="teacher_name" placeholder="Teacher Name" requigsdred>
                        @error('teacher_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="teacher_father_name" class="form-control form-control-user @error('teacher_father_name') is-invalid @enderror" id="teacher_father_name" value="{{ old('teacher_father_name')}}" placeholder="Teacher Father Name">
                        @error('teacher_father_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="teacher_qualification" class="form-control form-control-user @error('teacher_qualification') is-invalid @enderror" value="{{ old('teacher_qualification')}}" id="teacher_qualification" placeholder="Teacher Qualification" requigsdred>
                        @error('teacher_qualification')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="tel" name="teacher_phone" class="form-control form-control-user @error('teacher_phone') is-invalid @enderror" value="{{ old('teacher_phone')}}" id="teacher_phone" placeholder="Teacher Phone Number" requigsdred>
                        @error('teacher_phone')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <ul>
                    <li>If assign as class teacher select select from dropdown.</li>
                </ul>
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                            <select name="class" class="form-control custom-select  @error('class') is-invalid @enderror" id="class"  requgsired>
                                <option  disabled selected hidden>Choose a option</option>
                                <option value="yes" @if(old('class') == 'yes') {{'selected'}} @endif>Yes</option>
                                <option value="no" @if(old('class') == 'no') {{'selected'}} @endif>No</option>
                            </select>
                        @error('class')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="teacher_nic" class="form-control form-control-user @error('teacher_nic') is-invalid @enderror" value="{{ old('teacher_nic')}}" id="teacher_nic" placeholder="Teacher NIC" reqgsuired>
                        @error('teacher_nic')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="email" name="teacher_email" class="form-control form-control-user @error('teacher_email') is-invalid @enderror" id="teacher_email" value="{{ old('teacher_email')}}" placeholder="Teacher Email">
                        @error('teacher_email')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                        <input type="date" name="teacher_dob" max="2002-12-30"class="form-control form-control-user @error('teacher_dob') is-invalid @enderror" value="{{ old('teacher_dob')}}" id="teacher_dob" placeholder="Teacher Date of Birth" reqgfsduired>
                        @error('teacher_dob')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="address" name="teacher_address" class="form-control form-control-user @error('teacher_address') is-invalid @enderror" id="teacher_address" value="{{ old('teacher_address')}}" placeholder="Teacher Address">
                        @error('teacher_address')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">

                        <select name="teacher_religion" class="form-control  custom-select @error('teacher_religion') is-invalid @enderror" id="teacher_religion" value="{{ old('teacher_religion')}}" resfdquired>
                            <option value="" disabled selected hidden>Choose a religion</option>
                            <option value="islam" @if (old('teacher_religion') == "islam") {{ 'selected' }} @endif>Islam</option>
                            <option value="other" @if (old('teacher_religion') == "otherr") {{ 'selected' }} @endif>Other</option>
                        </select>
                        @error('teacher_religion')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="refrence_name" class="form-control form-control-user @error('refrence_name') is-invalid @enderror" id="refrence_name" value="{{ old('refrence_name')}}" placeholder="Refrence Name">
                        @error('refrence_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="refrence_cnic" class="form-control form-control-user @error('refrence_cnic') is-invalid @enderror" value="{{ old('refrence_cnic')}}" id="refrence_cnic" placeholder="Refrence NIC" requgfsdired>
                        @error('refrence_cnic')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="refrence_phone_no" class="form-control form-control-user @error('refrence_phone_no') is-invalid @enderror" id="refrence_phone_no" value="{{ old('refrence_phone_no')}}" placeholder="refrence Phone No">
                        @error('refrence_phone_no')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                        <input type="text" name="teacher_designation" class="form-control form-control-user @error('teacher_designation') is-invalid @enderror" value="{{ old('teacher_designation')}}" id="teacher_designation" placeholder="Teacher Designation" reqgdsfuired>
                        @error('teacher_designation')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 m-auto text-center">
                        <label class="radio-inline">Gender:</label>
                            <label class="radio-inline">
                                <input type="radio" class="m-2  @error('gender') is-invalid @enderror" name="gender" value="female" @if(old('gender') == 'female') {{'checked'}} @endif checked>Female
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="m-2  @error('gender') is-invalid @enderror" name="gender" value="male" @if(old('gender') == 'male') {{'checked'}} @endif>Male
                            </label>
                            @error('gender')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <ul class="text-muted">
                    <li>Teacher Designation mean is he/she permanent, visiting, Internee.</li>
                    <li>Like Urdu English Math Physics Islamiat Bio and Chemistry</li>
                    <li>Practical Subjects are like Physics Bio and Chemistry</li>
                </ul>
                <button class="btn  btn-success  btn-lg w-25 m-auto text-center">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#teacher_profile_pic').change(function(event){
            //alert($('#student_profile_pic').val());
	        $('#profile').attr('src',URL.createObjectURL(event.target.files[0])).width('200px');
        });
    });
</script>

@endsection
