@extends('teacher.layouts.app')


@section('content')

@if(isset($salaries))
<div class="card shadow mb-4 teacher-salary">
    <div class="card-header py-3">
        <h6 class="m-0 h2 font-weight-bold text-primary float-left">Salary
            Detail
        </h6>
        <button class="btn btn-primary float-right btn-print noprint"><i class="fas fa-print"></i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm " id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher Name & id</th>
                        <th>Salary</th>
                        <th>Advance Salary</th>
                        <th>Salary of month</th>
                        <th>Remaining Salary</th>
                        <th class="noprint">Print Slip</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Teacher Name & id</th>
                        <th>Salary</th>
                        <th>Advance Salary</th>
                        <th>Salary of month</th>
                        <th>Remaining Salary</th>
                        <th class="noprint">Print Slip</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($salaries as $key => $salary)
                    <tr class="{{$key+1}}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $salary->teachers->teacher_name }}
                            <small> #{{ $salary->teachers->teacher_id }}</small>
                        </td>
                        <td>Rs. {{ $salary->teacherSalary->salary }}</td>
                        <td>Rs. {{ $salary->advance_salary }}</td>
                        <td>{{ $salary->salary_of_month }}</td>
                        <td>{{ $salary->remaining_salary }}</td>
                        <td class="noprint">
                            @if($salary->is_paid == '0')
                                <p class="text-white text-center font-weight-bold bg-warning">Pending</p>
                            @else
                                <p class="text-white text-center font-weight-bold bg-success">Received</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            $(".table").printThis();
        });

        $(".btn-slip-print").on('click',function(){
            $("."+$(this).attr('data-id')).printThis();
        });
    });
</script>
@endsection
