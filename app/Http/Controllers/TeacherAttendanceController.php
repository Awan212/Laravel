<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.teacher_attendance.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $teacher = Teacher::where('id', $request->teacher_id)
                            ->first();
        return response()->json($teacher);
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
            'teacher' => 'required',
            'attendance_date' => 'required|date_format:Y-m-d|before:tomorrow',
            'attendance'    => 'required',
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
            if(TeacherAttendance::where('teacher', $request->teacher)
                                ->where('attendance_date',$request->attendance_date)
                                ->first())
            {
                $data = [
                    'response'  => 0,
                    'errors'    => ['Oops Attandance of this date already marked.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $data = new TeacherAttendance;
                $data->teacher          = $request->teacher;
                $data->attendance_date = $request->attendance_date;
                $data->attendance       = $request->attendance;
                $check = $data->save();
                if($check)
                {
                    $data = [
                        'response'      => 1,
                        'message'       => ['Teacher attendance mark successfully.'],
                        'class'         => 'alert alert-success',
                    ];
                    return response()->json($data);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherAttendance  $teacherAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherAttendance $teacherAttendance)
    {
        //
        $teachers = Teacher::where('is_active', '1')
                                ->get();
        return view('admin.teacher_attendance.show',compact('teachers'));
    }


    public function detail(Request $request)
    {
        $request->session()->put('teacher_attendance',$request->teacher);
        return view('admin.teacher_attendance.detail.main');

    }

    Public function show_detail(Request $request)
    {
        $attendanceDetail = TeacherAttendance::with('teachers')
                                                ->orderBy('attendance_date','DESC')
                                                ->where('teacher', $request->session()->get('teacher_attendance'))
                                                ->get();
        return view('admin.teacher_attendance.detail.show',compact('attendanceDetail'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherAttendance  $teacherAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,TeacherAttendance $teacherAttendance)
    {
        //
        $attendance = TeacherAttendance::with('teachers')
                                        ->where('id',$request->attendance_id)
                                        ->first();
        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherAttendance  $teacherAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherAttendance $teacherAttendance)
    {
        //
        $validator = Validator::make($request->all(),[
            'attendance_id'        => 'required',
            'attendance_date'   => 'required|date_format:Y-m-d|before:tomorrow',
            'attendance'        => 'required',
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
            if(TeacherAttendance::where('id','!=',$request->attendance_id)
                                ->where('teacher',$request->teacher)
                                ->where('attendance_date', $request->attendance_date)
                                ->first())
            {
                $data = [
                    'response'  => 0,
                    'errors'    => ['Oops Attandance of this date already marked.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $check = TeacherAttendance::where('id', $request->attendance_id)
                                        ->update([
                                            'attendance_date'  => $request->attendance_date,
                                            'attendance'       => $request->attendance
                                        ]);
                if($check)
                {
                    $data = [
                        'response'      => 1,
                        'message'       => ['Teacher attendance update successfully.'],
                        'class'         => 'alert alert-success',
                    ];
                    return response()->json($data);
                }

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherAttendance  $teacherAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherAttendance $teacherAttendance)
    {
        //
    }

    public function mark_all_teacher_attendance(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'attendance_teacher_id.*' => 'required',    
            'teacher_attendance.*' => 'required',
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
            
            foreach($request->attendance_teacher_id as $key => $teacher)
            {
                if(TeacherAttendance::where('teacher', $teacher)
                                        ->where('attendance_date', date('Y-m-d'))
                                        ->first())
                {
                    
                }
                else
                {
                    $data = new TeacherAttendance;
                    $data->teacher = $teacher;
                    $data->attendance_date  = date('Y-m-d');
                    $data->attendance       = $request->teacher_attendance[$key];
                    $check = $data->save();
                }
                
            }
            if($check)
            {
                $data = [
                'response'  => 1,
                'message'    => ['All Teachers attendance marked'],
                'class'     => 'alert alert-success',
                ];
                return response()->json($data);
            }
            
        }
    }

    public function today_attendance()
    {
        $teacher_attendance = TeacherAttendance::with('teachers')
                                                ->orderBy('id', 'DESC')
                                                ->where('attendance_date', date('Y-m-d'))
                                                ->get();
        $data = [
            'teacher_attendance' => $teacher_attendance,
        ];                                        
        return view('admin.homePageDetail.TeacherAttendance', compact('data'));
    }
}
