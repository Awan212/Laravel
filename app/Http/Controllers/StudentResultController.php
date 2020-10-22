<?php

namespace App\Http\Controllers;

use App\Models\StudentResult;
use Illuminate\Http\Request;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Validator;
class StudentResultController extends Controller
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
            'class' => ClassSection::get(),
        ];
        return view('admin.student_result.main',compact('data'));
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
            'class_section' => 'required',
            'result_title' => 'required|max:100',
            'result'       => 'required|file|mimetypes:application/pdf, application/vnd.ms-excel'
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            if($request->file('result'))
            {
                $file = $request->file('result');
                $destinationPath = 'results';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {
                    $data = new StudentResult;
                    $data->class_sections = $request->class_section;
                    $data->result_title  = $request->result_title;
                    $data->result        = 'results/' . $file_name;
                    $check = $data->save();
                    if($check)
                    {
                        $data = [
                            'response'  => 1,
                            'message'   => 'Result Save successfully.',
                            'class'     => 'alert alert-success',
                        ];
                        return response()->json($data);
                    }
                }
            } 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentResult  $studentResult
     * @return \Illuminate\Http\Response
     */
    public function show(StudentResult $studentResult)
    {
        //
        $data = StudentResult::with('classes')
                                ->get();
        return view('admin.student_result.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentResult  $studentResult
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,StudentResult $studentResult)
    {
        //
        $data = StudentResult::where('id', $request->result_id)
                                ->first();
        return response()->json($data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentResult  $studentResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentResult $studentResult)
    {
        //
        $validator = Validator::make($request->all(), [
            'edit_class_section' => 'required',
            'edit_result_title'  => 'required|max:100',
            'edit_result'             => 'file|mimetypes:application/pdf, application/vnd.ms-excel'
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            if($request->file('edit_result'))
            {
                $file = $request->file('edit_result');
                $destinationPath = 'results';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {
                    $check = StudentResult::where('id', $request->result_id)
                                        ->update([
                                            'class_sections' => $request->edit_class_section,
                                            'result_title'  => $request->edit_result_title,
                                            'result'        => 'results/' . $file_name,
                                        ]);
                    if($check)
                    {
                        $data = [
                            'response'  => 1,
                            'message'   => 'Result update successfully.',
                            'class'     => 'alert alert-success',
                        ];
                        return response()->json($data);
                    }
                }
            }
            else
            {
               
                $check = StudentResult::where('id', $request->result_id)
                                        ->update([
                                            'class_sections' => $request->edit_class_section,
                                            'result_title'  => $request->edit_result_title,
                                        ]);
                if($check)
                {
                    $data = [
                        'response'  => 1,
                        'message'   => 'Result update successfully.',
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
     * @param  \App\Models\StudentResult  $studentResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,StudentResult $studentResult)
    {
        //
        $check = StudentResult::where('id', $request->remove_result_id)
                                ->delete();
        if($check)
        {
            $request->session()->flash('message', 'Result delete Successfully');
            return redirect()->back();
        }
    }
}
