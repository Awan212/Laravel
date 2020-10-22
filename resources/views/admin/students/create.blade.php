@extends('admin.layouts.app')

@section('content')



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 h2 font-weight-bold text-primary">Add New Student</h6>
    </div>
    <div class="card-body">
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
        <form class="user" method="POST" action="save_new_student" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-3">
                    <div style="width:200px; height:200px; margin:auto" class="border bg-light">
                        <img class="" width='100%' height="100%" src="{{ asset('logo/school-logo.png') }}" alt=""
                            id="profile">
                    </div>
                    <input type="file" name="student_profile_pic"
                        class="mt-2 mb-2 form-control @error('student_profile_pic') is-invalid @enderror"
                        value="{{ old('student_profile_pic')}}" id="student_profile_pic" required>
                    @error('student_profile_pic')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="roll_no">Roll No:</label>
                    <input type="text" name="student_roll_no"
                        class="form-control  @error('student_roll_no') is-invalid @enderror"
                        value="{{ old('student_roll_no')}}" id="student_roll_no" placeholder="Student roll No" required>
                    @error('student_roll_no')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-9">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_name">Student Name* :</label>
                            <input type="text" name="student_name"
                                class="form-control @error('student_name') is-invalid @enderror"
                                value="{{ old('student_name')}}" id="student_name" placeholder="Student Name" required>
                            @error('student_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="father_name">Father Name* :</label>
                            <input type="text" name="student_father_name"
                                class="form-control @error('student_father_name') is-invalid @enderror"
                                id="student_father_name" value="{{ old('student_father_name')}}"
                                placeholder="Student Father Name" required>
                            @error('student_father_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="class_section">Class Section* :</label>
                            <select name="class" class="form-control custom-select @error('class') is-invalid @enderror" id="class"
                                required>
                                <option value="" disabled selected hidden>Choose a subjects</option>
                                @foreach ($classes as $class)
                                <option value="{{$class->id}}" @if(old('class')==$class->id) {{'selected'}}
                                    @endif>{{$class->class_title}} | {{$class->section_name}} |
                                    {{$class->subjects->subjects}} | {{ $class->subjects->practical_subjects }}</option>
                                @endforeach
                            </select>
                            @error('class')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_cnic">Student B-Form/CNIC* :</label>
                            <input type="number" name="student_cnic"
                                class="form-control @error('student_cnic') is-invalid @enderror"
                                value="{{ old('student_cnic')}}" id="student_cnic" placeholder="Student NIC" required>
                            @error('student_cnic')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="student_email">Student Email:</label>
                            <input type="email" name="student_email"
                                class="form-control @error('student_email') is-invalid @enderror"
                                id="student_email" value="{{ old('student_email')}}" placeholder="Student Email">
                            @error('student_email')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_dob">Student Date of Birth* :</label>
                            <input type="date" name="student_dob"
                                class="form-control @error('student_dob') is-invalid @enderror"
                                value="{{ old('student_dob')}}" id="student_dob" placeholder="Student Date of Birth"
                                required>
                            @error('student_dob')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="student_gender">Student Gender* :</label>
                            <select name="student_gender"
                                class="form-control custom-select @error('student_gender') is-invalid @enderror" id="student_gender"
                                value="{{ old('student_gender')}}" required>
                                <option value="" disabled selected hidden>Choose a gender</option>
                                <option value="male" @if (old('student_gender')=="male" ) {{ 'selected' }} @endif>Male
                                </option>
                                <option value="female" @if (old('student_gender')=="female" ) {{ 'selected' }} @endif>
                                    Female</option>
                                <option value="other" @if (old('student_gender')=="other" ) {{ 'selected' }} @endif>
                                    Other</option>
                            </select>
                            @error('student_gender')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="student_address">Student Address* :</label>
                            <input type="address" name="student_address"
                                class="form-control @error('student_address') is-invalid @enderror"
                                id="student_address" value="{{ old('student_address')}}" placeholder="Student Address"
                                required>
                            @error('student_address')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="student_religion">Student Religion* :</label>
                            <select name="student_religion"
                                class="form-control custom-select @error('student_religion') is-invalid @enderror"
                                id="student_religion" value="{{ old('student_religion')}}" required>
                                <option value="" disabled selected hidden>Choose a religion</option>
                                <option value="islam" @if(old('student_religion')=='islam' ) {{'selected'}} @endif>Islam
                                </option>
                                <option value="other" @if(old('student_religion')=='other' ) {{'selected'}} @endif>Other
                                </option>
                            </select>
                            @error('student_religion')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="student_guardian">Guardian Name* :</label>
                            <input type="text" name="guardian_name"
                                class="form-control @error('guardian_name') is-invalid @enderror"
                                id="guardian_name" value="{{ old('guardian_name')}}" placeholder="Guardian Name"
                                required>
                            @error('guardian_name')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="guardian_cnic">Guadian CNIC* :</label>
                            <input type="number" name="guardian_cnic"
                                class="form-control @error('guardian_cnic') is-invalid @enderror"
                                value="{{ old('guardian_cnic')}}" id="guardian_cnic" placeholder="Guardian NIC"
                                required>
                            @error('guardian_cnic')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="guardian_phone_num">Guadian Phone No* :</label>
                            <input type="tel" name="guardian_phone_no"
                                class="form-control @error('guardian_phone_no') is-invalid @enderror"
                                id="guardian_phone_no" value="{{ old('guardian_phone_no')}}"
                                placeholder="Guardian Phone No" required>
                            @error('guardian_phone_no')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="guardian_occupation">Guardian Occupation* :</label>
                            <input type="text" name="guardian_occopation"
                                class="form-control @error('guardian_occopation') is-invalid @enderror"
                                value="{{ old('guardian_occopation')}}" id="guardian_occopation"
                                placeholder="Guardian Occopation" required>
                            @error('guardian_occopation')
                            <span class="invalid-feedback ml-4" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button class="btn  btn-success  btn-lg w-25 m-auto text-center">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Student</h6>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="save_new_student" enctype="multipart/form-data">

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
                        <img class="" width='100%' height="100%" src="{{ Auth::user()->user_profile_pic }}" alt=""
                            id="profile">
                    </div>
                    <input type="file" name="student_profile_pic"
                        class="mt-2 form-control form-control-file @error('student_profile_pic') is-invalid @enderror"
                        value="{{ old('student_profile_pic')}}" id="student_profile_pic" requihggred>
                    @error('student_profile_pic')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                    <input type="text" name="student_roll_no"
                        class="form-control form-control-user @error('student_roll_no') is-invalid @enderror"
                        value="{{ old('student_roll_no')}}" id="student_roll_no" placeholder="Student roll No"
                        reqdfhuired>
                    @error('student_roll_no')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="student_name"
                        class="form-control form-control-user @error('student_name') is-invalid @enderror"
                        value="{{ old('student_name')}}" id="student_name" placeholder="Student Name" requigsdred>
                    @error('student_name')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="student_father_name"
                        class="form-control form-control-user @error('student_father_name') is-invalid @enderror"
                        id="student_father_name" value="{{ old('student_father_name')}}"
                        placeholder="Student Father Name">
                    @error('student_father_name')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <select name="class" class="form-control  @error('class') is-invalid @enderror" id="class"
                        requgsired>
                        <option value="" disabled selected hidden>Choose a subjects</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}" @if(old('class')==$class->id) {{'selected'}}
                            @endif>{{$class->class_title}} | {{$class->section_name}} | {{$class->subjects->subjects}} |
                            {{ $class->subjects->practical_subjects }}</option>
                        @endforeach
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
                    <input type="text" name="student_cnic"
                        class="form-control form-control-user @error('student_cnic') is-invalid @enderror"
                        value="{{ old('student_cnic')}}" id="student_cnic" placeholder="Student NIC" reqgsuired>
                    @error('student_cnic')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="email" name="student_email"
                        class="form-control form-control-user @error('student_email') is-invalid @enderror"
                        id="student_email" value="{{ old('student_email')}}" placeholder="Student Email">
                    @error('student_email')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" name="student_dob"
                        class="form-control form-control-user @error('student_dob') is-invalid @enderror"
                        value="{{ old('student_dob')}}" id="student_dob" placeholder="Student Date of Birth"
                        reqgfsduired>
                    @error('student_dob')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <select name="student_gender" class="form-control  @error('student_gender') is-invalid @enderror"
                        id="student_gender" value="{{ old('student_gender')}}">
                        <option value="" disabled selected hidden>Choose a gender</option>
                        <option value="male" @if (old('student_gender')=="male" ) {{ 'selected' }} @endif>Male</option>
                        <option value="female" @if (old('student_gender')=="female" ) {{ 'selected' }} @endif>Female
                        </option>
                        <option value="other" @if (old('student_gender')=="other" ) {{ 'selected' }} @endif>Other
                        </option>
                    </select>
                    @error('student_gender')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="address" name="student_address"
                        class="form-control form-control-user @error('student_address') is-invalid @enderror"
                        id="student_address" value="{{ old('student_address')}}" placeholder="Student Address">
                    @error('student_address')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name="student_religion"
                        class="form-control  @error('student_religion') is-invalid @enderror" id="student_religion"
                        value="{{ old('student_religion')}}" resfdquired>
                        <option value="" disabled selected hidden>Choose a religion</option>
                        <option value="islam" @if(old('student_religion')=='islam' ) {{'selected'}} @endif>Islam
                        </option>
                        <option value="other" @if(old('student_religion')=='other' ) {{'selected'}} @endif>Other
                        </option>
                    </select>
                    @error('student_religion')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="guardian_name"
                        class="form-control form-control-user @error('guardian_name') is-invalid @enderror"
                        id="guardian_name" value="{{ old('guardian_name')}}" placeholder="Guardian Name">
                    @error('guardian_name')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="guardian_cnic"
                        class="form-control form-control-user @error('guardian_cnic') is-invalid @enderror"
                        value="{{ old('guardian_cnic')}}" id="guardian_cnic" placeholder="Guardian NIC" requgfsdired>
                    @error('guardian_cnic')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="guardian_phone_no"
                        class="form-control form-control-user @error('guardian_phone_no') is-invalid @enderror"
                        id="guardian_phone_no" value="{{ old('guardian_phone_no')}}" placeholder="Guardian Phone No">
                    @error('guardian_phone_no')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row">
                <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                    <input type="text" name="guardian_occopation"
                        class="form-control form-control-user @error('guardian_occopation') is-invalid @enderror"
                        value="{{ old('guardian_occopation')}}" id="guardian_occopation"
                        placeholder="Guardian Occopation" reqgdsfuired>
                    @error('guardian_occopation')
                    <span class="invalid-feedback ml-4" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <ul class="text-muted">
                <li>Possible Subjects Combination.</li>
                <li>Like Urdu English Math Physics Islamiat Bio and Chemistry</li>
                <li>Practical Subjects are like Physics Bio and Chemistry</li>
            </ul>
            <button class="btn  btn-success  btn-lg w-25 m-auto text-center">Save</button>
        </form>
    </div>
</div>-->
@endsection



@section('script')
<script>
    $(document).ready(function () {
        $('#student_profile_pic').change(function (event) {
            //alert($('#student_profile_pic').val());
            $('#profile').attr('src', URL.createObjectURL(event.target.files[0])).width('200px');
        });
    });
</script>
@endsection