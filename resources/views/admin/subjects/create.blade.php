@extends('admin.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Add New Courses</h6>
    </div>
    <div class="card-body">
        <form class="user" method="POST" action="save_new_subjects">
            @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>    
            @endif
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="subjects" class="form-control form-control-user @error('subjects') is-invalid @enderror" value="{{ old('subjects')}}" id="subjects" placeholder="Subjects" required>
                    @error('subjects')
                        <span class="invalid-feedback ml-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="practical_subjects" class="form-control form-control-user" id="practical_subjects" value="{{ old('practical_subjects')}}" placeholder="Practical subjects">
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
</div>
@endsection