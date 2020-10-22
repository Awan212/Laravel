<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $teachers = Teacher::get();
        $classes = ClassSection::get();
        $data= [
            'teachers' => $teachers,
            'classes'  => $classes,
        ];
        return view('admin.teachers.subject_teachers.main',compact('data'));
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
            'teacher'               => 'required',
            'class_section'         => 'required',
            'subject_title'         => 'required',
            'lecture_start_time'    => 'required|date_format:H:i',
            'lecture_end_time'      => 'required|date_format:H:i|after:lecture_start_time',
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
        elseif(SubjectTeacher::where('class_section_id',$request->class_sectiond)
                                ->where('subject_title',$request->subject_title)
                                ->first()
                            )
        {
            $data = [
                'response'  => '0',
                'errors'    => ['This subject of that class and section is already assign.'],
                'class'     => 'alert alert-danger',
            ];
            
            return response()->json($data);
        }
        elseif(SubjectTeacher::where('teacher_id',$request->teacher)
                            ->where('class_section_id',$request->class_section)
                            ->where('subject_title',$request->subject_title)->first())
        {
            $data = [
                'response'  => '0',
                'errors'    => ['Already that teacher studing this subject to this class section.'],
                'class'     => 'alert alert-danger',
            ];
            
            return response()->json($data);

        }
        elseif(SubjectTeacher::where('teacher_id',$request->teacher)
                                ->where('lecture_start_time',$request->lecture_start_time)
                                ->first())
        {
            $data = [
                'response'  => '0',
                'errors'    => ['Teacher busy at that time.'],
                'class'     => 'alert alert-danger',
            ];
            
            return response()->json($data);
            
        }
        else
        {

            $data = new SubjectTeacher;
            $data->teacher_id = $request->teacher;
            $data->class_section_id = $request->class_section;
            $data->subject_title    = $request->subject_title;
            $data->lecture_start_time = $request->lecture_start_time;
            $data->lecture_end_time = $request->lecture_end_time;
            $check = $data->save();
            if($check)
            {
                $data = [
                    'response'  => '1',
                    'message'    => ' Subject Teacher add succesfully.',
                    'class'     => 'alert alert-success',
                ];
                
                return response()->json($data);

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectTeacher $subjectTeacher)
    {
        //
        $subjectTeachers = SubjectTeacher::with('teachers','class')->get();
        return view('admin.teachers.subject_teachers.show',compact('subjectTeachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,SubjectTeacher $subjectTeacher)
    {
        //
        
        $data = SubjectTeacher::with('teachers','class')
                                ->where('id',$request->subject_teacher)
                                ->first();

        return response()->json($data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectTeacher $subjectTeacher)
    {
        //
        $validator = Validator::make($request->all(), [  
                            'edit_teacher'              => 'required',
                            'edit_class_section'        => 'required',
                            'edit_subject_title'        => 'required',
                            'edit_lecture_start_time'   => 'required|date_format:H:i',
                            'edit_lecture_end_time'     => 'required|date_format:H:i|after:edit_lecture_start_time'
        ],[
            'edit_teacher.required'         => 'Please select teacher first.',
            'edit_class_section.required'   => 'Please select class and section.',
            'edit_subject_title.required'   => 'Please provide subject title', 
            'edit_lecture_start_time.required'       => 'Please provide lecture start time.',
            'edit_lecture_end_time.required'         => 'Please provide lecture end time.',
            'edit_lecture_end_time.after'            => 'Lecture end time must be after lecture start time.' 
        ]);
        
        if($validator->fails())
        {
            $data = [
                'response'  => '0',
                'errors'    => $validator->errors()->all(),
                'class'     => 'alert alert-danger'
            ];
            return response()->json($data);
        }
        else
        {
            if(SubjectTeacher::where('teacher_id', $request->edit_teacher)
                                ->where('class_section_id', $request->edit_class_section)
                                ->where('subject_title', $request->edit_subject_title)
                                ->where('lecture_start_time', $request->edit_lecture_start_time)
                                ->where('lecture_end_time', $request->edit_lecture_end_time)
                                ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => ['The subject of this class is already assign to that teacher at that time.'],
                    'class'     => 'alert alert-danger'
                ];
                return response()->json($data);  
            }
            elseif(SubjectTeacher::where('teacher_id',$request->edit_teacher)
                                    ->where('lecture_start_time', $request->edit_lecture_start_time)
                                    ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => ['The teacher is busy at that moment.'],
                    'class'     => 'alert alert-danger'
                ];
                return response()->json($data);  
            }
            elseif(SubjectTeacher::where('class_section_id', $request->edit_class_section)
                                    ->where('subject_title', $request->edit_subject_title)
                                    ->first())
            {
                $data = [
                    'response'  => '0',
                    'errors'    => ['That subject of this class is already assigned.'],
                    'class'     => 'alert alert-danger'
                ];
                return response()->json($data);
            }

            else
            {
                $check = SubjectTeacher::where('id',$request->edit_subject_teacher)
                                            ->update([
                                                'teacher_id' => $request->edit_teacher,
                                                'class_section_id' => $request->edit_class_section,
                                                'subject_title' => $request->edit_subject_title,
                                                'lecture_start_time' => $request->edit_lecture_start_time,
                                                'lecture_end_time' => $request->edit_lecture_end_time,
                                                
                                            ]);
                if($check)
                {
                    $data = [
                        'response'  => '1',
                        'message'    => 'Subject teacher updated successfully',
                        'class'     => 'alert alert-success'
                    ];
                    return response()->json($data);
                }

            }
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,SubjectTeacher $subjectTeacher)
    {
        //
        $check = SubjectTeacher::where('id', $request->subject_teacher)
                                    ->delete();

        if($check)
        {
            $request->session()->flash('message', 'Subject teacher removed successfully.');
            return redirect()->back();
        }

    }
}
