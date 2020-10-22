<?php

namespace App\Http\Controllers;

use App\Models\StudentFeeDetail;
use Illuminate\Http\Request;
use App\Models\StudentFee;
Use App\Models\StudentAttendance;
use Illuminate\Support\Facades\Validator;
use PDF;
use Carbon;

class StudentFeeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $request->session()->put('student_fee_id',$request->student_fee);
        $student_fee = StudentFee::with('students')
                                ->where('id', $request->student)
                                ->first();
        return view('admin.student_fee.detail.main',compact('student_fee'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentFeeDetail  $studentFeeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $student = StudentFee::with('students')
                                ->where('id', $request->session()->get('student_fee_id'))
                                ->first();

        $fee = StudentFeeDetail::with('student_fees')
                                ->where('student_fee',$request->session()->get('student_fee_id'))
                                ->get();
        $data = [
            'student'  => $student,
            'fee'      => $fee
         ];

        return view('admin.student_fee.detail.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentFeeDetail  $studentFeeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,StudentFeeDetail $studentFeeDetail)
    {
        //return response()->json($request->all());
        $fee_detail = StudentFeeDetail::with('student_fees')
                                        ->where('id', $request->student_fee_detail_id)
                                        ->first();
        return response()->json($fee_detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentFeeDetail  $studentFeeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentFeeDetail $studentFeeDetail)
    {
        //
        $validator = Validator::make($request->all(),[
            'student_fee_detail_id' => 'required',
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
            if($request->is_paid == 1 and ($request->paid_date == ''))
            {
                $data = [
                    'response'  => 0,
                    'errors'    => ['Please provide date at which fee pay because you select yes in pay option.'],
                    'class'     => 'alert alert-danger'
                ];
    
                return response()->json($data);
            }
            elseif($request->is_paid == 0)
            {
                
                $check = StudentFeeDetail::where('id', $request->student_fee_detail_id)
                                        ->update([
                                            'fee_of_month' => $request->fee_of_month,
                                        ]);
                if($check)
                {
                    $data = [
                        'response'  => 1,
                        'message'    => ['Student fee detail is updated successfully.'],
                        'class'     => 'alert alert-success'
                    ];
        
                    return response()->json($data);
                }
            }
            elseif($request->is_paid == 1 and ($request->paid_date != ''))
            {
                $check = StudentFeeDetail::where('id', $request->student_fee_detail_id)
                                            ->update([
                                                'paid_date' => $request->paid_date,
                                                'is_paid'   => $request->is_paid
                                            ]);
                if($check)
                {
                    $fee = StudentFeeDetail::where('id',$request->student_fee_detail_id)->first();
                    $paidFee = $fee->fee_amount;
                    $mainFee = StudentFee::where('id',$request->session()->get('student_fee_id'))->first(); 
                    $totalPaidFee = $mainFee->paid_fee;
                    $GrandPaidFee = $totalPaidFee + $paidFee;
                    $remaining_fee = $mainFee->student_fee - $GrandPaidFee;
                    $check = StudentFee::where('id', $request->session()->get('student_fee_id'))
                                        ->update([
                                            'paid_fee' => $GrandPaidFee,
                                            'remaining_fee' => $remaining_fee,
                                        ]);
                    if($check)
                    {
                        $data = [
                            'response'  => 1,
                            'message'    => ['Student fee detail is updated successfully.'],
                            'class'     => 'alert alert-success'
                        ];
            
                        return response()->json($data);
                    }

                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentFeeDetail  $studentFeeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentFeeDetail $studentFeeDetail)
    {
        //
    }


    public function fee_voucher(Request $request)
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
        // return response()->json($data);
       
}
}
