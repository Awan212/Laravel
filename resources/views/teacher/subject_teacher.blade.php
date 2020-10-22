@extends('teacher.layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h1 class="h3 text-primary font-weight-bold float-left">Subjects</h1>
        <button class="btn btn-primary btn-print float-right">Print</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Leacture Time</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Leacture Time</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($subjects as $key => $subject)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $subject->teachers->teacher_name }}</td>
                        <td>{{ $subject->class->class_title }}</td>
                        <td>{{ $subject->class->section_name }}</td>
                        <td>{{ $subject->subject_title }}</td>
                        <td>{{ $subject->lecture_start_time }} to {{ $subject->lecture_end_time }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection