<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClassSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $subjects = Subject::orderBy('subjects','DESC')->get();
        $data = [
            'subjects'  => $subjects
        ];
        return view('admin.class_sections.main',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $subjects = Subject::orderBy('subjects','ASC')->get();
        return view('admin.class_sections.create',compact('subjects'));
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
            'class_title'    => 'required',
            'section_name'   => 'required',
            'class_subjects' => 'required',
            'class_seats'    => 'required|integer',
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
        elseif(
            ClassSection::where('class_title',$request->class_title)
                        ->where('section_name',$request->section_name)
                        ->first()
            )
        {
            
            $data = [
                'response'  => 0,
                'errors'    => ['This Class with this section name already exsit'],
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            $data = new ClassSection;
            $data->class_title = $request->class_title;
            $data->section_name = $request->section_name;
            $data->subjects_id = $request->class_subjects;
            $data->seats = $request->class_seats;
            $check = $data->save();
            if($check)
            {
                $data = [
                    'response'  => 1,
                    'message'   => 'Class and section save successfuly.',
                    'class'     => 'alert alert-success'
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSection  $classSection
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSection $classSection)
    {
        //
        $classes = ClassSection::with('subjects')
                                ->orderBy('class_title','DESC')
                                ->get();
        $data = [
            'classes'   => $classes,
            
        ];
        return view('admin.class_sections.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassSection  $classSection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,ClassSection $classSection)
    {
        //
        $data = ClassSection::where('id', $request->class_section)
                              ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassSection  $classSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSection $classSection)
    {
        //
        $validator = Validator::make($request->all(),[
            'class_title'    => 'required',
            'section'        => 'required',
            'subjects'       => 'required',
            'seats'          => 'required|integer|min:20',
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
        elseif(
            ClassSection::where('id','!=',$request->class_section_id)
                        ->where('class_title',$request->class_title)
                        ->where('section_name', $request->section)
                        ->first()
            )
        {

            $data = [
                'response'  => 0,
                'errors'    => ['The class already have section with this name'],
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        } 
        else
        {
            $check = ClassSection::where('id',$request->class_section_id)
                                ->update([
                                    'class_title' => $request->class_title,
                                    'section_name'=> $request->section,
                                    'subjects_id' => $request->subjects,
                                    'seats'       => $request->seats,
                                ]);
            if($check)
            {
                $data = [
                    'response'  => 1,
                    'message'   => 'Class and section updated successfuly.',
                    'class'     => 'alert alert-success'
                ];
                return response()->json($data);
                
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSection  $classSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ClassSection $classSection)
    {
        //
        $delete  = ClassSection::where('id',$request->class_id)->delete();
        if($delete)
        {
            $request->session()->flash('message', 'Class and section removed successfuly');
            return redirect()->back();
        }
        else{
            
        }
    }
}
