<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFeeDetail;
use App\Models\StudentAttendance;
use App\Models\StudentFee;
use App\Models\StudentResult;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Carbon;

class StudentController extends Controller
{
    //
    public function attendance(Request $request)
    {

        $student = Student::where('student_cnic', Auth::user()->nic_no)
                                ->first();
        $attendance =   StudentAttendance::with('students')
                                        ->orderBY('id', 'DESC')
                                        ->where('student',$student->id)
                                        ->get();
        $total_days =   StudentAttendance::where('student',$student->id)
                                            ->count();  
        $present = StudentAttendance::where('student',$student->id)
                                    ->where('attendance', 'present')
                                    ->count();
        $absent = StudentAttendance::where('student',$student->id)
                                    ->where('attendance', 'absent')
                                    ->count();

        $leave = StudentAttendance::where('student',$student->id)
                                    ->where('attendance', 'leave')
                                    ->count();
        $late = StudentAttendance::where('student',$student->id)
                                    ->where('attendance', 'late')
                                    ->count();
        $data = [
            'attendance'      => $attendance,
            'total_days'      => $total_days,
            'present'         => $present,
            'absent'          => $absent,
            'leave'           => $leave,
            'late'            => $late,  

         ];
        return view('student.attendance',compact('data'));
    }


    public function fee_vouchers(Request $request)
    {
        $student = StudentFee::with('students')
                                ->where('student', Auth::user()->id)
                                ->first();

        $fee = StudentFeeDetail::with('student_fees')
                                ->where('student_fee',$student->id)
                                ->get();
        $data = [
            'student'  => $student,
            'fee'      => $fee
         ];
        return view('student.fee_voucher',compact('data'));
    }

    public function fee_voucher(Request $request)
    {
        $student = Student::where('student_cnic', Auth::user()->nic_no)
                                ->first();
        $fee = StudentFee::where('student',$student->id)->first();
        $fee_detail = StudentFeeDetail::with('student_fees')
                                ->where('student_fee',$fee->id)
                                ->get();
        $data = [
            'fee'      => $fee_detail,
            'student'  => $student
         ];
        return view('student.fee_voucher',compact('data'));
    }

    public function student_result()
    {
        $student = Student::where('student_cnic', Auth::user()->nic_no)
                                ->first();
        $data = StudentResult::where('class_sections', $student->class_sections_id)
                                ->get();
        return view('student.student_result', compact('data'));
    }

    public function print_fee_voucher(Request $request)
    {
        
        $fee   =   StudentFeeDetail::with('student_fees')
                                        ->where('id', $request->voucher)
                                        ->first();
        $attendance_fine = StudentAttendance::where('attendance', 'absent')
                                             ->whereYear('attendance_date',  Carbon\Carbon::parse($fee->fee_of_month)->format('Y'))
                                             ->whereMonth('attendance_date', Carbon\Carbon::parse($fee->fee_of_month)->format('m'))
                                             ->count();
        $data = [
            'fee' => $fee,
            'attendance_fine'   => $attendance_fine
        ];
        return view('student.feevoucher', compact('data'));
       
    }
}
