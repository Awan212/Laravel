@extends('admin.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Add Subjects Teacher</h6>
    </div>
    <div class="card-body">
        <form action="save_subject_teacher" method="post">
            @csrf

            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

            @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif

            <div class="from-group row mb-4">
                <div class="col-sm-6">
                    <select name="teachers_id" class="form-control custom-select @error('teachers_id') is-invalid @enderror ">
                        <option value="" disabled selected hidden>Choose a teacher</option>
                        @foreach($data['teachers'] as $teacher)
                        <option value="{{ $teacher->id }}" @if (old('teachers_id') == $teacher->id) {{ 'selected' }} @endif > {{$teacher->teacher_name}} </option>
                        @endforeach
                    </select>
                    @error('teachers_id')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <select name="class_sections_id" class="form-control custom-select @error('class_sections_id') is-invalid @enderror ">
                        <option value="" disabled selected hidden>Choose a class and section</option>
                        @foreach($data['classes'] as $class)
                        <option value="{{ $class->id }}" @if (old('class_sections_id') == $class->id) {{ 'selected' }} @endif > {{$class->class_title}} -- {{$class->section_name}} </option>
                        @endforeach
                    </select>
                    @error('class_sections_id')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row m-auto" >
                <div class="col-sm-4">
                    <input type="text" value="{{ old('subject_title') }}" class="form-control @error('subject_title') is-invalid @enderror" name="subject_title" id="subject_title" placeholder="Subject Title">
                    @error('subject_title')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <input type="time" value="{{ old('lecture_start_timing') }}" class="form-control @error('lecture_start_timing') is-invalid @enderror" name="lecture_start_timing" id="lecture_start_timing" placeholder="start time">
                    <label>Lecture Start Time</label>
                    @error('lecture_start_timing')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="col-sm-4">
                    <input type="time" value="{{ old('lecture_end_timing') }}" class="form-control @error('lecture_end_timing') is-invalid @enderror" name="lecture_end_timing" id="lecture_end_timing">
                    <label>Lecture End Time</label>
                    @error('lecture_end_timing')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-4">
                <div class="col-sm-6 m-auto">
                    <button class="btn btn-success btn-lg w-75 m-auto">Save</button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection
@section('script')


@endsection
