<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFee;
use App\Models\StudentFeeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'students' => Student::get(),
            'fees'     => StudentFee::get(),
        ];
        return view('admin.student_fee.main',compact('data'));
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
        $validator = Validator::make($request->all(), [
            'student'        => 'required|unique:student_fees',
            'student_fee'    => 'required|integer',
            'paid_fee'       => 'required|integer',
            'remaining_fee'  => 'required|integer',
            'invoice_number' => 'required|unique:student_fees',
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
            $data = new StudentFee;
            $data->student        = $request->student;
            $data->student_fee    = $request->student_fee;
            $data->paid_fee       = $request->paid_fee;
            $data->remaining_fee  = $request->remaining_fee;
            $data->invoice_number = $request->invoice_number;
            $check = $data->save();
            if($check)
            {
                $lastinseredId = $data->id;  
                $date = Carbon::createFromDate(null, null, 1); // 2019-03-1
                $fee = round($request->student_fee / 12); 
                for($i = 0; $i<=11; $i++)
                {   
                    if($i == 0)
                    {
                        $data = new StudentFeeDetail;
                        $data->student_fee     = $lastinseredId;
                        $data->fee_amount      = $fee; 
                        $data->invoice_number  = $request->invoice_number.'-'.$i;
                        $data->fee_of_month    = $date->format('Y-m-d'); 
                        $check = $data->save();   
                    }
                    else
                    {
                        $data = new StudentFeeDetail;
                        $data->student_fee     = $lastinseredId;
                        $data->fee_amount      = $fee; 
                        $data->invoice_number  = $request->invoice_number.'-'.$i;
                        $data->fee_of_month    = $date->addMonth()->format('Y-m-d'); 
                        $check = $data->save();   
                    }
                    
                } 
                if($check)
                {
                    $data = [
                        'response'  => 1,
                        'message'   => 'Student fee save successfully.',
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
     * @param  \App\Models\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function show(StudentFee $studentFee)
    {
        //
        $data = [
            'students' => StudentFee::with('students')->get(),
        ];
        return view('admin.student_fee.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,StudentFee $studentFee)
    {
        //
        $data = StudentFee::with('students')
                            ->where('id',$request->student_fee_id)
                            ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentFee $studentFee)
    {
        //
        $validator = Validator::make($request->all(), [
            'student_fee_id'      => 'required',
            'edit_student'        => 'required',
            'edit_student_fee'    => 'required|integer',
            'edit_paid_fee'       => 'required|integer',
            'edit_remaining_fee'  => 'required|integer',
            'edit_invoice_number' => 'required',
        ], [],[
            'edit_student'        => 'student',
            'edit_student_fee'    => 'student fee',
            'edit_paid_fee'       => 'paid fee',
            'edit_remaining_fee'  => 'remaining fee',
            'edit_invoice_number' => 'invoice number',
            ]);
        if($validator->fails())
        {
            $data = [
                'response'      =>  0,
                'errors'        => $validator->errors()->all(),
                'class'         => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else 
        {
            if(StudentFee::where('id' , '!=' , $request->student_fee_id)
                            ->where('student',$request->edit_student)
                            ->exists())
            {

            }
            elseif (StudentFee::where('id', '!=', $request->student_fee_id)
                                ->Where('invoice_number', $request->edit_invoice_number)
                                ->exists())
            {
                # code...
            }
            else
            {
                $check = StudentFee::where('id', $request->student_fee_id)
                                    ->update([
                                        'student'        => $request->edit_student,
                                        'student_fee'    => $request->edit_student_fee,
                                        'paid_fee'       => $request->edit_paid_fee,
                                        'remaining_fee'  => $request->edit_student_fee  - $request->edit_paid_fee,
                                        'invoice_number' => $request->edit_invoice_number
                                    ]);
                if($check)
                {
                    $data = [
                        'response'  => 1,
                        'message'   => 'Student fee updated successfully.',
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
     * @param  \App\Models\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,StudentFee $studentFee)
    {
        //
        $check = StudentFee::where('id', $request->remove_student_fee_id)
                            ->delete();
        if($check)
        {
            $request->session()->flash('message', 'Student fee record remove successfully.');
            return redirect()->back();
        }

    }
}
