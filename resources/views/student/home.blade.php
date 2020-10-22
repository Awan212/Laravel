@extends('student.layouts.app')


@section('content')
@if(isset($data))

<div class="student-profile">
    <div class="row">
        <div class="col-sm-3 p-2  ">
            <div class="student-profile-img pr0">
                <img src="{{ $data->student_profile_pic }}" alt="" width="100%" height="100%">
            </div> 
        </div>
        <div class="col-sm-7 pl-1 student-profile-info ">
            <h1>{{ $data->student_name }}</h1>
            <small>#{{ $data->student_roll_no }}</small><br>
            <small>NIC: {{ $data->student_cnic }}</small>
            <p>{{ $data->class->class_title }} - {{ $data->class->section_name }}</p>
            <address>{{ $data->student_address  }}</address>
        </div>

        <div class="col-sm-2">
            <button class="btn-print noprint">Print</button>
        </div>
    </div>
    <div class="col-sm-12 down-section p-0">
        <div class="row p-3">
            
            <div class="col-sm-12 student-profile-detail-right">
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Father Name:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $data->student_father_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Date of Birth:</span>
                            </div>

                            <div class="col-md-6">
                                <span> {{ \Carbon\Carbon::parse($data->dob)->toFormattedDateString() }}</span>
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
                                <span>{{ $data->student_religion }}</span>
                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Phone Number:</span>
                            </div>

                            <div class="col-md-6">
                                <span> {{ $data->student_guardian_phone_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row down-section mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Guardian Name:</span>
                            </div>

                            <div class="col-md-6">
                                <span>{{ $data->student_guardian_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Guardian CNIC:</span>
                            </div>
                            <div class="col-md-6">
                                <span> {{ $data->student_guardian_cnic }} </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-bottom down-section mt-2">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="heading">Guardian Occupation:</span>
                            </div>
                            <div class="col-md-6">
                                <span>{{ $data->student_guardian_occopation }}</span>
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
$(document).ready(function(){
    $(".btn-print").on('click',function(){
        $(".student-profile").printThis();
    });
});
</script>

@endsection