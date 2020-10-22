<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\StudentFeeDetail;
use App\Models\TeacherAttendance;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_role == 'student')
        {
            if(Auth::user()->is_active == '1')
            {
                $data = Student::with('class')->where('student_cnic',Auth::user()->nic_no)->first();
                return view(Auth::user()->user_role.'/home',compact('data'));
            }
            else
            {
                Auth::logout();
                return redirect('login');
            }
        }
        elseif(Auth::user()->user_role == 'admin')
        {
            $date = Carbon::createFromDate(null, null, 1)->format('Y-m-d');
            if(Auth::user()->is_active == '1')
            {
                $students = Student::count();
                $teachers = Teacher::count();
                $classes  = ClassSection::count();
                $teacher_list = Teacher::where('is_active', 1)
                                        ->orderBy('id', 'DESC')
                                        ->get(); 
                $teacher_attendance = TeacherAttendance::with('teachers')
                                                        ->orderBy('id', 'DESC')
                                                        ->where('attendance_date', date('Y-m-d'))
                                                        ->get();
                $data = [
                    'students'  => $students,
                    'teachers'  => $teachers,
                    'teacher_list'  => $teacher_list,
                    'classes'   => $classes,
                    'class'     => ClassSection::orderBy('id', 'DESC')->get(),
                    'teacher_attendance' => $teacher_attendance,
                    'users'     => User::count(),
                    'late_fee'  => StudentFeeDetail::with('student_fees')
                                                    ->where('is_paid', 0)
                                                    ->whereDate('fee_of_month', '<=' , $date)
                                                    ->get(),
                    'struck_off'  => Student::with('class')
                                                    ->where('struck_off', 1)
                                                    ->where('is_active', 1)
                                                    ->get(),
                ];
                return view(Auth::user()->user_role.'/home',compact('data'));
            }
            else
            {
                Auth::logout();
                return redirect('login');
            }
        }
        elseif(Auth::user()->user_role == 'teacher')
        {
            if(Auth::user()->is_active == '1')
            {
                $teacher = Teacher::where('teacher_nic',Auth::user()->nic_no)
                                    ->first();
                return view(Auth::user()->user_role.'/home',compact('teacher'));
            }
            else
            {
                Auth::logout();
                return redirect('login');
            }
        }

    }
}
