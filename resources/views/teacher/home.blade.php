@extends('teacher.layouts.app')


@section('content')
@isset($teacher)


<div class="teacher-profile">
    <div class="row">
        <div class="col-sm-3 p-2  ">
            <div class="teacher-profile-img ">
                <img src="{{ $teacher->teacher_profile_pic }}" alt="" width="100%" height="100%">
            </div> 
        </div>
        <div class="col-sm-7 pl-1 teacher-profile-info ">
            <h1>{{ $teacher->teacher_name }}</h1>
            <small>#{{ $teacher->teacher_id }}</small><br>
            <small>NIC: {{ $teacher->teacher_nic }}</small>
            <p>{{ $teacher->teacher_gender  }}</p>
            <p>{{ $teacher->teacher_designation }}</p>
            <address>{{ $teacher->teacher_address }}</address>
        </div>

        <div class="col-sm-2">
            <button class="btn-print noprint">Print</button>
        </div>
    </div>
    <div class="col-sm-12 down-section p-0">
        <div class="row p-3">
            
            <div class="col-sm-12 teacher-profile-detail-right">
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Father Name:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $teacher->teacher_father_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Date of Birth:</span>
                            </div>

                            <div class="col-md-6">
                                <span> {{ \Carbon\Carbon::parse($teacher->teacher_dob)->toFormattedDateString() }}</span>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="row down-section">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Religion:</span>
                            </div>

                            <div class="col-md-6">
                                <span>{{ $teacher->teacher_religion }}</span>
                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Phone Number:</span>
                            </div>

                            <div class="col-md-6">
                                <span> {{ $teacher->teacher_phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row down-section mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Mail:</span>
                            </div>

                            <div class="col-md-6">
                                <span>{{ $teacher->teacher_email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Qualification:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $teacher->teacher_qualification }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  down-section mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Reference Name:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $teacher->refrance_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Reference CNIC:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $teacher->refrence_cnic }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom down-section mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Reference Phone #:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $teacher->refrence_phone_no }}</span>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>

@else
@endisset
@endsection


@section('script')

<script>
    $(document).ready(function () {

        $(".btn-print").on('click', function () {
            $(".teacher-profile").printThis();
        });
       
    });
</script>
@endsection
