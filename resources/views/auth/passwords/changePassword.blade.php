@extends('layouts.app')

@section('content')
<div class="card w-75 m-auto">
    <div class="card-header">
        <h2 class="h2 text-center text-dark">Change Password</h2>
    </div>
    <div class="card-body">
        @if(Session::has('message'))
            <div class="alert alert-warning">
                {{ Session::get('message') }}
            </div>        
        @endif
        <form action="change_password" class="w-75 m-auto"  method="post">
            @csrf
            <label for="password" class="control-label">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror"  autocomplete="off">
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            <label for="new-password" class="control-label">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
            
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="new-password-confirmation" class="control-label">Re-enter
                            Password</label>
            <input type="password" name="confirmation_new_password" id="confirmation_new_password" class="form-control @error('confirmation_new_password') is-invalid @enderror">

            @error('confirmation_new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-danger">Change Password</button>
            </div>
        </form>
    </div>
</div>
@endsection