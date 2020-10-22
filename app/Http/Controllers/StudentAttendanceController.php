<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = ClassSection::get();
        $students = Student::where('class_sections_id', '4')
                            ->get();
        $data   = [
            'classes'  => $classes,
            'students' => $students
        ];
        return view('admin.student_attendance.main',compact('data'));
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
            'student'           => 'required',
            'class'             => 'required',
            'attendance_date'   => 'required|date_format:Y-m-d|before:tomorrow',
            'attendance'        => 'required',
        ]);

        if($validator->fails())
        {
            $data = [
                'response'  => 0,
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            if(StudentAttendance::where('student',$request->student)
                                ->where('attendance_date',$request->attendance_date)
                                ->exists()
                                )
            {
                $data = [
                    'response'  => 0,
                    'errors'    => ['Student attendance already marked of that date.'],
                    'class'     => 'alert alert-danger'
                ];
                return response()->json($data);
            }
            else
            {
                $data = new StudentAttendance;
                $data->student = $request->student;
                $data->class_section    = $request->class;
                $data->attendance_date  = $request->attendance_date;
                $data->attendance       = $request->attendance;
                if($data->save())
                {
                    $data = [
                        'response'  => 1,
                        'message'    => 'Student attendance marked successfully.',
                        'class'     => 'alert alert-success'
                    ];
                    return response()->json($data);
                }
                else
                {
                    $data = [
                        'response'      => 0,
                        'errors'        => ['There is error please try again.'],
                        'class'         => 'alert alert-danger'
                    ];
                    return response()->json($data);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,StudentAttendance $studentAttendance)
    {
        //
        $validator = Validator::make($request->all(),[
            'class' => 'required'
        ]);
        if($validator->fails())
        {
            $data = [
                'response'  => 0,
                'message'   => 'Please select a class.',
                'class'     => 'alert alert-danger m-2',
            ];
            return response()->json($data);
        }
        else
        {
            $students = Student::where('class_sections_id', $request->class)
                                    ->get();
            return view('admin.student_attendance.show',compact('students'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, StudentAttendance $studentAttendance)
    {
        //
        $data = StudentAttendance::with('students', 'class')
                                    ->where('id',$request->attendance_id)
                                    ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        //
        // 'edit_student.required' => 'Please resfresh your page.',
        // 'edit_class.required'   => 'Please refresh your page their is internal error.',
        // 'edit_attendance_date.required' => 'Please provide attendance date filed.',
        $validator = Validator::make($request->all(),[
            'edit_attendance_id'    => 'required',
            'edit_student'          => 'required',
            'edit_class'            => 'required',
            'edit_attendance_date'  => 'required|date_format:Y-m-d|before:today',
            'edit_attendance'       => 'required',
        ],[
            'edit_attendance_id.required' => 'Please resfresh your page.',
        ],[
            'edit_student'  => 'student',
            'edit_attendance_date' => 'attendance date',
            'edit_class'            => 'class',
            'edit_attendance'       => 'attendance',
        ]);


        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            if(StudentAttendance::where('id', '!=', $request->edit_attendance_id)
                                    ->where('student', $request->edit_student)
                                    ->where('attendance_date', $request->edit_attendance_date)
                                    ->exists())
            {
                $data = [
                    'response' => 0,
                    'errors'    => ['Attendance of student with this date already exists.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $check = StudentAttendance::where('id', $request->edit_attendance_id)
                ->update([
                    'attendance_date' => $request->edit_attendance_date,
                    'attendance'    => $request->edit_attendance,
                    ]);
                if($check)
                {
                $data = [
                'response' => 1,
                'message'  => 'Student attendance update successfully',
                'class'    => 'alert alert-success',
                ];
                return response()->json($data);
                }
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,StudentAttendance $studentAttendance)
    {
        //
        $check = StudentAttendance::where('id', $request->delete_attendance_id)
                                    ->delete();
        if($check)
        {
            $request->session()->flash('message', 'Student attendance delete successfully');
            return redirect()->back();
        }
    }

    public function detail(Request $request)
    {
        $request->session()->put('student_attendance_id', $request->student);
        $data = [
            'student'       => Student::where('id', $request->session()->get('student_attendance_id'))->first(),
        ];
        return view('admin.student_attendance.detail.main',compact('data'));
    }

    public function show_detail(Request $request)
    {
        $attendances = StudentAttendance::with('students')
                                        ->orderBy('attendance_date','DESC')
                                        ->where('student', $request->session()->get('student_attendance_id'))
                                        ->get();

        return view('admin.student_attendance.detail.show',compact('attendances'));
    }
}
