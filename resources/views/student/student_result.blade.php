@extends('student.layouts.app')

@section('content')
@isset($data)
<div class="card shadow ">
    <div class="card-header">
        <h1 class="h3 text-dark float-left">Student Results</h1>
    </div>
    <div class="card-body">
    <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class & Section</th>
                        <th>Result Title</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Class & Section</th>
                        <th>Result Title</th>
                        <th>Result</th>
                    </tr>
                </tfoot>
                <tbody>
                   @foreach($data as $key => $result)
                   <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $result->classes->class_title }} | {{ $result->classes->section_name }} </td>
                       <td>{{ $result->result_title }}</td>
                       <td>
                           <a href="/{{$result->result}}" class="btn btn-success">View</a>
                           <a href="/{{$result->result}}" class="btn btn-success" download="{{ $result->result_title }}">Download</a>
                       </td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
</div>
@else
<h1 class="text-dark">There is something wrong please contact to admin.</h1>
@endisset
@endsection