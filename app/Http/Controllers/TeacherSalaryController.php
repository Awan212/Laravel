<?php

namespace App\Http\Controllers;

use App\Models\TeacherSalary;
use Illuminate\Http\Request;
Use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class TeacherSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::where('is_active','1')->get();
        Return view('admin.teacher_salary.main',compact('teachers'));
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
            'teacher'           => 'required|unique:teacher_salaries',
            'salary'            => 'required|numeric',
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
            $data = new TeacherSalary;
            $data->teacher = $request->teacher;
            $data->salary = $request->salary;
            $check = $data->save();
            if($check)
            {
                $data = [
                    'response'  => 1,
                    'message'    => 'Teacher salary add successfuly',
                    'class'     => 'alert alert-success',
                ];
                return response()->json($data);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherSalary  $teacherSalary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,TeacherSalary $teacherSalary)
    {
        //
        // SELECT * From teacher_salaries JOIN teachers on teacher_salaries.teacher = teachers.id WHERE teachers.is_active = 1
        $salaries = DB::table('teacher_salaries')
                        ->join('teachers','teacher_salaries.teacher', '=', 'teachers.id')
                        ->where('teachers.is_active', '=', '1')
                        ->select('teacher_salaries.id','teacher_salaries.teacher','teacher_salaries.salary','teachers.teacher_profile_pic','teachers.teacher_name','teachers.teacher_id')
                        ->get();
        // dd($salaries);
        // $salaries   = TeacherSalary::with(['teachers',function($query) {
           //                         $query->where('is_active','1');
             //                       }])
               //                     ->get();

        Return view('admin.teacher_salary.show',compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherSalary  $teacherSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request,TeacherSalary $teacherSalary)
    {
        //
        $data = TeacherSalary::with('teachers')
                                ->where('id',$request->salary_id)
                               ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherSalary  $teacherSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSalary $teacherSalary)
    {
        //
        $validator = Validator::make($request->all(),[
            'edit_teacher' => 'required',
            'edit_salary'  => 'required|numeric'
        ],[
            'edit_salary.required' => 'Please provide salary.',
            'edit_salary.numeric'  => 'Salary must be in digits.'
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
            $check = TeacherSalary::where('id',$request->edit_salary_id)
                                    ->update([
                                        'teacher'   => $request->edit_teacher,
                                        'salary'    => $request->edit_salary,

                                    ]);
            if($check)
            {
                $data = [
                    'response'      => 1,
                    'message'       => 'Teacher  salary updated successfully.',
                    'class'         => 'alert alert-success',
                ];
                return response()->json($data);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherSalary  $teacherSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TeacherSalary $teacherSalary)
    {
        //
        $delete = TeacherSalary::where('id', $request->salary_id)
                                ->delete();

        if($delete)
        {
            $request->session()->flash('message', 'Teacher salary delete successfully');
            return redirect()->back();
        }
    }
}
