@extends('admin.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Class Teacher</h6>
    </div>
    <div class="card-body">
        <form action="save_class_teacher" method="POST">
            
            @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @csrf
            
            <select name="teacher_id" class="form-control custom-select @error('teacher_id') is-invalid @enderror ">
                <option value="" disabled selected hidden>Choose a teacher</option>
                @foreach($data['teachers'] as $teacher)
                <option value="{{ $teacher->id }}" @if (old('teacher_id') == $teacher->id) {{ 'selected' }} @endif > {{$teacher->teacher_name}} </option>
                @endforeach
            </select>
            @error('teacher_id')
                <span class="invalid-feedback ml-4" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <select name="class_sections_id" class="form-control custom-select mt-2 @error('class_sections_id') is-invalid @enderror">
                <option value="" disabled selected hidden>Choose a class</option>
                @foreach($data['classes'] as $class)
                <option value="{{ $class->id }}"  @if (old('class_sections_id') == $class->id) {{ 'selected' }} @endif>{{$class->class_title}} -- {{ $class->section_name }}</option>
                @endforeach
            </select>
            @error('class_sections_id')
                <span class="invalid-feedback ml-4" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="m-auto w-25 mt-4">
                <button class="btn btn-success w-100 btn-lg mt-4">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection
