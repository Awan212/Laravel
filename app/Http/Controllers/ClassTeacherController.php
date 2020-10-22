<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\ClassTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $check = ClassTeacher::select('teachers_id')->get();
        $teachers = Teacher::where('is_class_teacher','yes')
                            ->get();
        $classes = ClassSection::get();
        $classTeachers = ClassTeacher::with('teachers','class')->get();
        $teachers = Teacher::where('is_class_teacher','yes')
                            ->get();
        $data = [
            'classTeachers' => $classTeachers,
            'teachers' => $teachers,
            'classes'  => $classes,      
        ];
        
        return view('admin.teachers.class_teachers.main',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $teachers = Teacher::where('is_class_teacher','yes')->get();
        $classes = ClassSection::get();
        $data = [
            'teachers' => $teachers,
            'classes'  => $classes,
        ];
        return view('admin.teachers.class_teachers.create',compact('data'));
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
                'teacher_id' => 'required|unique:class_teachers,teachers_id',
                'class_sections_id'   => 'required|unique:class_teachers',
        ],[
            'teacher_id.required' => 'Please select a teacher',
            'teacher_id.unique'   => 'Already class teacher',
            'class_sections_id.required' => 'Please select a class'
        ]);
        if($validator->fails())
        {
            $data = [
                'response' => '0',
                'errors'   =>  $validator->errors()->all(),
                'class'    =>  'alert alert-danger',
            ];
            return response()->json($data);
            
            // return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            
            $data = new ClassTeacher;
            $data->teachers_id = $request->teacher_id;
            $data->class_sections_id = $request->class_sections_id;
            $check = $data->save();
            if($check)
            {
                $data = [
                    'response' => '1',
                    'message'   => 'Class teacher add successfully',
                    'class'    =>  'alert alert-success',
                ];
                return response()->json($data);

            }
            else
            {
                $data = [
                    'response' => '0',
                    'message'   => 'Class teacher not add',
                    'class'    =>  'alert alert-danger',
                ];
                return response()->json($data);
            }


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassTeacher  $classTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(ClassTeacher $classTeacher)
    {
        //
        $classTeachers = ClassTeacher::with('teachers','class')->get();
        $data = [
            'classTeachers' => $classTeachers,
        ];
        
        return view('admin.teachers.class_teachers.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassTeacher  $classTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,ClassTeacher $classTeacher)
    {
        //
        
        $data = ClassTeacher::with('teachers','class')
                            ->where('id', $request->class_teacher_id)
                            ->first();
        return response()->json($data);
         
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassTeacher  $classTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassTeacher $classTeacher)
    {
        //
        $validator = Validator::make($request->all(), [
            'update_class_sections_id' => 'required',
            'update_teacher_id'        =>  'required', 
        ], [
            'update_class_sections_id.required' => 'Please select class and section.',
            'update_teacher_id.required'        => 'Please select teacher.'

        ]);

        if($validator->fails())
        {
            $data = [
                'response'  => '0',
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger',
            ];
            return response()->json($data);
            
        }
       else
       {
           if(ClassTeacher::where('teachers_id',$request->update_teacher_id)
                            ->where('class_sections_id', $request->update_class_sections_id)
                            ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => [' This class is with this teacher already assign. '],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            elseif(ClassTeacher::where('teachers_id',$request->update_teacher_id)
                                ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => ['This teacher is already class teacher.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            elseif(ClassTeacher::where('class_sections_id',$request->update_class_sections_id)
                                ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => ['This class is already asign to other teacher.'],
                    'class'     => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                $check = ClassTeacher::where('id',$request->class_teacher_id)
                                        ->update([
                                                'teachers_id' =>  $request->update_teacher_id,
                                                'class_sections_id' => $request->update_class_sections_id
                                                ]);
                $data = [
                    'response'   => '1',
                    'message'    => 'Class Teacher updated successfully.',
                    'class'      => 'alert alert-success',
                ];
                return response()->json($data);
            }
       }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassTeacher  $classTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ClassTeacher $classTeacher)
    {
        //
        $check = ClassTeacher::where('id',$request->teacher_id)
                                ->delete();
        if($check)
        {
            $request->session()->flash('message', 'Class teacher remove successfully');
            return redirect()->back();
        }   
        
    }
}
