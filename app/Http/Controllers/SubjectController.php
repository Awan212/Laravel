<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PDF;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subjects = Subject::orderBy('subjects','ASC')->get();
        return view('admin.subjects.main',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.subjects.create');
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
            'subjects' => 'required|unique:subjects',
        ]);
        if($validator->fails()){
            $data = [
                'response'  => 0,
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            $data = new Subject;
            $data->subjects = $request->subjects;
            $data->practical_subjects = $request->practical_subjects;
            $check = $data->save();
            if($check)
            {
                $data = [
                    'response'  => 1,
                    'message'    => 'New Subjects add successfuly',
                    'class'     => 'alert alert-success'
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
        $subjects = Subject::orderBy('id','DESC')->get();
        return view('admin.subjects.show',compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Subject $subject)
    {
        //
        $data = Subject::where('id',$request->subject_id)->first();
        return response()->json($data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $validator = Validator::make($request->all(),[
            'subjects' => 'required',
            
        ]);
        if($validator->fails()){
            $data = [
                'response' => 0,
                'errors'   => $validator->errors()->all(),
                'class'    => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            if(Subject::where('id', '!=' , $request->subjects_id)
                        ->where('subjects' , $request->subjects)
                        ->first())
            {
                $data = [
                    'response' => 0,
                    'errors'   => ['These already subject exists in system.'],
                    'class'    => 'alert alert-danger'
                ];
                return response()->json($data);
               
            }
            else
            {
                $check = Subject::where('id',$request->subjects_id)
                                    ->update([
                                        'subjects'=> $request->subjects,
                                        'practical_subjects' => $request->practical
                                    ]);
                if($check)
                {
                    $data = [
                        'response' => 1,
                        'message'   => ['Subject update successfully.'],
                        'class'    => 'alert alert-success'
                    ];
                    return response()->json($data);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        //
        $delete  = Subject::where('id',$request->subject_id)->delete();
        if($delete)
        {
            $request->session()->flash('message', 'Subject removed successfuly');
            return redirect()->to('subjects');
        }
    }

}
