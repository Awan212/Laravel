<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassSection;
use App\Models\ClassTeacher;
use App\Models\StudentResult;
use App\Models\SalaryDetail;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use App\Models\User;
use App\Models\TeacherAttendance;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //

    public function subjects()
    {
        $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)->first();
        $subjects = SubjectTeacher::with('teachers', 'class')
                                    ->orderBy('lecture_start_time', 'ASC')
                                    ->where('teacher_id', $teacher->id)
                                    ->get();
        return view('teacher.subject_teacher', compact('subjects'));
    }

    public function salary(Request $request)
    {
        $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)->first();
        $salaries = SalaryDetail::with('teacherSalary','teachers')
                                ->where('teacher_id',$teacher['id'])
                                ->orderBy('id','DESC')
                                ->get();
        return view('teacher.salary',compact('salaries'));
    }

    Public function attendance()
    {
        $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)->first();
        $attendance = TeacherAttendance::with('teachers')
                                ->where('teacher',$teacher['id'])
                                ->orderBy('id','DESC')
                                ->get();
        $totalDays = TeacherAttendance::where('teacher',$teacher['id'])
                                        ->count();
        $present = TeacherAttendance::where('teacher',$teacher['id'])
                                        ->where('attendance', 'present')
                                        ->count();
        $absent = TeacherAttendance::where('teacher',$teacher['id'])
                                    ->where('attendance', 'absent')
                                    ->count();
        $leave = TeacherAttendance::where('teacher',$teacher['id'])
                                    ->where('attendance', 'leave')    
                                    ->count();
        $late = TeacherAttendance::where('teacher',$teacher['id'])
                                    ->where('attendance', 'late')
                                    ->count();

        $data = [
            'attendance' => $attendance,
            'total_days'  => $totalDays,
            'present'   => $present,
            'absent'    => $absent,
            'leave'     => $leave,
            'late'      => $late
        ];
        return view('teacher.attendance',compact('data'));
    }

    public function class_attendance()
    {
        $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)->first();
        if($teacher['is_class_teacher'] == 'yes')
        {
            $class = ClassTeacher::where('teachers_id', $teacher['id'])->first();
            if($class)
            {
                // dd($class);
                $ClassSection = ClassSection::where('id',$class['class_sections_id'])->first();
                $enrolledStudent     = Student::where('class_sections_id', $ClassSection['id'])->count();
                $students     = Student::where('class_sections_id', $ClassSection['id'])->get();
                $check = StudentAttendance::where('class_section',$ClassSection['id'])
                                            ->where('attendance_date',date('Y-m-d'))
                                            ->exists();
                $today_attendance   = StudentAttendance::with('students')
                                                        ->where('class_section', $ClassSection['id'])
                                                        ->where('attendance_date', date('Y-m-d'))
                                                        ->get();
                if($check)
                {
                    $data = [
                        'response'      => 'attendance_marked',
                        'classSection'  => $ClassSection,
                        'enrollStudent' => $enrolledStudent,
                        'students'      => $students,
                        'today_attendance' => $today_attendance,
                        'message' => 'You mark attendnace of today.',
                    ];
                    return view('teacher.class_attendance.main',compact('data'));
                }
                else
                {
                    $data = [
                        'response'      => 'not_attendance_marked',
                        'classSection'  => $ClassSection,
                        'enrollStudent' => $enrolledStudent,
                        'students'      => $students
                    ];
                    return view('teacher.class_attendance.main',compact('data'));
                }
            }
            else
            {
                $data = [
                    'response'      => 'error',
                    'message'       => 'There is something wrong. please inform admin',
                ];
                return view('teacher.class_attendance.main',compact('data'));
            }
        }
        else
        {
            $message = 'Your are not class teacher so you not use this service.';
            return view('teacher.class_attendance.main',compact('message'));
        }
    }

    public function mark_attendance(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'attendance.*' => 'required',
        ]);
        if($validator->fails())
        {
            $data = [
                'response'  => 0,
                'errors'    => ['Please mark attendance of all student.'],
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            for($i = 0; $i < count($request->student) ; $i++) {
                if($request->attendance[$i] == 'absent')
                {
                    if(StudentAttendance::where('student',$request->student[$i])
                                    ->where('attendance', 'absent')
                                    ->count()>5)
                    {
                        $data = new StudentAttendance;
                        $data->student = $request->student[$i];
                        $data->class_section = $request->class;
                        $data->attendance_date  = date('Y-m-d');
                        $data->attendance   = $request->attendance[$i];
                        $check = $data->save();
                        if($check)
                        {
                            $student = Student::where('id',$request->student[$i])
                                                ->update([
                                                    'struck_off' => 1
                                                ]);
                            if($student)
                            {
                                $student_nic = Student::where('id', $request->student[$i])
                                                        ->first();
                                $check = User::where('nic_no', $student_nic->student_cnic)
                                                ->update([
                                                    'is_active' => 0
                                                ]);
                            }
                        }
                    }
                    else
                    {
                        $data = new StudentAttendance;
                        $data->student = $request->student[$i];
                        $data->class_section = $request->class;
                        $data->attendance_date  = date('Y-m-d');
                        $data->attendance   = $request->attendance[$i];
                        $check = $data->save();
                        }
                   
                    
                }
                else
                {
                    $data = new StudentAttendance;
                    $data->student = $request->student[$i];
                    $data->class_section = $request->class;
                    $data->attendance_date  = date('Y-m-d');
                    $data->attendance   = $request->attendance[$i];
                    $check = $data->save();
                }
            }
            if($check)
            {
                $data = [
                    'response'  => 1,
                    'message'   => ['Attendnace mark successfully'],
                    'class'     => 'alert alert-success'
                ];
            }
            return response()->json($data);
        }
    }

    public function class_result()
    {
        $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)->first();
        $class = ClassTeacher::where('teachers_id', $teacher->id)->first();
        $data = StudentResult::where('class_sections', $class->class_sections_id)->get();
        return view('teacher.class_result',compact('data'));
    }
}
