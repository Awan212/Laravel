<?php

namespace App\Http\Controllers;

use App\Models\SalaryDetail;
use App\Models\TeacherSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $request->session()->put('salary_id',$request->salary_id);
        $salary = TeacherSalary::with('teachers')
                                ->orderBy('id', 'DESC')
                                ->where('teacher',$request->teacher_id)
                                ->first();
        return view('admin.teacher_salary.detail.main',compact('salary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
                'salary_id'    => 'required',
                'teacher_id'    => 'required',
                'advance_salary'=> 'required|numeric',
                'month_salary'  => 'required|date_format:Y-m',
                'rem_salary'    => 'required|numeric',
        ],[
            'is_paid.required' => 'Please select yes or no in paying option.'
        ]);
        if($validator->fails())
        {
            $data  = [
                'response'  => 0,
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            if(SalaryDetail::where('teacher_id', $request->teacher_id)
                            ->where('salary_of_month', $request->month_salary)
                            ->first())
            {
                $data  = [
                    'response'  => 0,
                    'errors'    => ['Salary of this month already exist.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $data = new SalaryDetail;
                $data->salary_id        = $request->salary_id;
                $data->teacher_id       = $request->teacher_id;
                $data->advance_salary   = $request->advance_salary;
                $data->salary_of_month  = $request->month_salary;
                $data->remaining_salary = $request->rem_salary;
                $check = $data->save();
                if($check)
                {
                    $data  = [
                        'response'  => 1,
                        'message'    => 'Teacher Salary add successfully',
                        'class'     => 'alert alert-success',
                    ];
                    return response()->json($data);
                }
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,SalaryDetail $salaryDetail)
    {
        //
        $salaries = SalaryDetail::with('teacherSalary','teachers')
                                ->where('salary_id',$request->session()->get('salary_id'))
                                ->OrderBy('id','DESC')
                                ->get();
        return view('admin.teacher_salary.detail.show',compact('salaries'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,SalaryDetail $salaryDetail)
    {
        //
        $data = SalaryDetail::with('teacherSalary','teachers')
                            ->where('id',$request->salary_id)
                            ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryDetail $salaryDetail)
    {
        //
        $validator = Validator::make($request->all(),[
                'edit_advance_salary'   => 'numeric',
                'edit_month_salary'     => 'required|date_format:Y-m',
                'edit_rem_salary'       => 'required|numeric',
        ],[
            'edit_advance_salary.required'  => 'Please provide advance salary. If no advance use 0 in field',
            'edit_advance_salary.numeric'   => 'Advance salary must be in numbers.',
            'edit_month_salary.required'    => 'Please provide month of salary.',
            'edit_month_salary.date_format' => 'Month of salary in form of month-year.',
            'edit_rem_salary.required'      => 'Please provide remaining salary.',
            'edit_rem_salary.numeric'       => 'Remaining salary must be in numbers.',
        ]);
        if($validator->fails())
        {
            $data = [
                'response'  => 0,
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger',

            ];

            return response()->json($data);
        }
        else
        {
            if(SalaryDetail::where('id', '!=', $request->salary_detail_id)
                            ->where('teacher_id', $request->teacher_id)
                            ->where('salary_of_month', $request->edit_month_salary)
                            ->first())
            {
                $data  = [
                    'response'  => 0,
                    'errors'    => ['Salary of this month already exist.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $check = SalaryDetail::where('id',$request->salary_detail_id)
                                    ->update([
                                        'advance_salary'    => $request->edit_advance_salary,
                                        'salary_of_month'   => $request->edit_month_salary,
                                        'remaining_salary'  => $request->edit_rem_salary,
                                    ]);
                if($check)
                {
                    $data  = [
                        'response'  => 1,
                        'message'    => 'Teacher Salary update successfully',
                        'class'     => 'alert alert-success',
                    ];
                    return response()->json($data);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryDetail  $salaryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,SalaryDetail $salaryDetail)
    {
        //
        $check = SalaryDetail::where('id',$request->detail_id)
                                ->delete();
        if($check)
        {
            $request->session()->flash('message' , 'Salary detail removed Successfully ');
            return redirect()->back();
        }

    }
}
