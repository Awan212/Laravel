@extends('admin.layouts.app')
@section('content')

@isset($subjects)
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Add New Class or Section</h6>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="save_new_class_sections">
            
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif
            
            @if(Session::has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif
            
            @csrf
            
            <div class="form-group row">

                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="class_title" class="form-control form-control-user @error('class_title') is-invalid @enderror" value="{{ old('class_title')}}" id="class_title" placeholder="class_title" requicxzred>
                    @error('class_title')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <input type="text" name="section_name" class="form-control form-control-user @error('class_title') is-invalid @enderror" id="section_name" value="{{ old('section_name')}}" placeholder="Section name">
                    @error('section_name')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>


            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <select class="form-control @error('class_subjects') is-invalid @enderror" value="{{ old('class_subjects') }}" name="class_subjects" id="class_subjects" style="border-radius: 10rem; font-size:1.4rem;" requssfgadired>
                        <option value="" disabled selected hidden>Choose a subjects</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}" @if (old('class_subjects') == $subject->id) {{ 'selected' }} @endif>
                                    {{$subject->subjects}} | {{ $subject->practical_subjects }}
                                </option>  
                            @endforeach
                    </select>
                    @error('class_subjects')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 m-auto mb-3 mb-sm-0">
                    <input type="text" name="class_seats" class="form-control form-control-user @error('class_seats') is-invalid @enderror" value="{{ old('class_seats')}}" id="class_seats" placeholder="seats" requdsaired>
                    @error('class_seats')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <ul class="text-muted">
                <li>Class title like PG One Two .. 10th 11th 12th.</li>
                <li>Class section means that 12th class has 4 section A B C D.</li>
                <li>Possible Subjects Combination for that class and section.</li>
                <li>No of students that are possibly enrolled in that section and class.</li>
            </ul>

            <button class="btn  btn-success  btn-lg w-25 m-auto text-center">Save</button>
        </form>
    </div>
</div>
@else 
@endisset
@endsection

@section('script')
    
@endsection