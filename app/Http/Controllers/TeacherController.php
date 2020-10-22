<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::orderby('id','ASC')->get();
       return view('admin.teachers.main',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$classes = ClassSection::orderBy('class_title','ASC')->get();
        return view('admin.teachers.create');
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
            'teacher_profile_pic'  => 'required|image|mimes:jpeg,bmp,png',
            'teacher_id'           => 'required|unique:teachers',
            'teacher_name'         => 'required',
            'teacher_father_name'  => 'required',
            'teacher_qualification'=> 'required',
            'teacher_phone'        => 'required|numeric|unique:teachers',
            'class'                => 'required',
            'teacher_nic'          => 'required|numeric|unique:teachers',
            'teacher_email'        => 'required|email|unique:teachers',
            'teacher_dob'          => 'required|before:25 years ago',
            'teacher_address'      => 'required|',
            'teacher_religion'     => 'required',
            'refrence_name'        => 'required',
            'refrence_cnic'        => 'required|numeric',
            'refrence_phone_no'    => 'required|numeric',
            'teacher_designation'  => 'required',
            'gender'               => 'required',
        ],[
            'teacher_dob.before' => 'Teacher age must be more than 25 year',
            'class.required' => 'Please check yes or no',
        ]);
        if($validator->fails())
        {

            return redirect()->back()->withErrors($validator)->withInput();

        }
        else
        {
            $data = new Teacher;
            $file = $request->file('teacher_profile_pic');
            $destinationPath = 'teacher_profile_pics';
            $file_name = time().$file->getClientOriginalName();
            $check = $file->move($destinationPath,$file_name);
            if($check)
            {

                $data->teacher_id = $request->teacher_id;
                $data->teacher_name = $request->teacher_name;
                $data->teacher_father_name = $request->teacher_father_name;
                $data->teacher_qualification = $request->teacher_qualification;
                $data->teacher_phone = $request->teacher_phone;
                $data->is_class_teacher = $request->class;
                $data->teacher_nic = $request->teacher_nic;
                $data->teacher_email = $request->teacher_email;
                $data->teacher_dob = $request->teacher_dob;
                $data->teacher_address = $request->teacher_address;
                $data->teacher_religion = $request->teacher_religion;
                $data->refrance_name = $request->refrence_name;
                $data->refrence_cnic = $request->refrence_cnic;
                $data->refrence_phone_no = $request->refrence_phone_no;
                $data->teacher_designation = $request->teacher_designation;
                $data->teacher_gender   = $request->gender;
                $data->teacher_profile_pic ='teacher_profile_pics/'.$file_name;
                $check = $data->save();
                if($check)
                {
                    $request->session()->flash('message','New teacher save successfully');
                    return redirect()->back();
                }
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Teacher $teacher)
    {
        //
        $teachers = Teacher::orderby('id','ASC')->get();
        return view('admin.teachers.show',compact('teachers'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Teacher $teacher)
    {
        //
        $teacher = Teacher::where('id',$request->id)
                            ->first();

        return response()->json($teacher);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $teacher = Teacher::where('teacher_id', $request->teacher_id)
                            ->first();
        $validator = Validator::make($request->all(), [
            'teacher_profile'       => 'image|mimes:jpeg,bmp,png',
            'name'                  => 'required',
            'father_name'           => 'required',
            'qualification'         => 'required',
            'phone_number'          => 'required|numeric|min:12',
            'class_teacher'         => 'required',
            'cnic'                  => 'required|numeric|min:13',
            'email'                 => 'required|email',
            'dob'                   => 'required|before:25 years ago',
            'address'               => 'required|',
            'religion'              => 'required',
            'ref_name'              => 'required',
            'ref_cnic'              => 'required|numeric|min:13',
            'ref_phone'             => 'required|numeric|min:12',
            'designation'           => 'required',
            'gender'                => 'required',
        ],[
            'teacher_dob.before' => 'Teacher age must be more than 25 year',
            'class.required' => 'Please check yes or no',
        ]);
        if($validator->fails())
        {
            $data = [
                'response'  => '0',
                'errors'     => $validator->errors()->all(),
                'class'     => 'alert alert-danger',
            ];

            return response()->json($data);
        }
        else
        {
            if($request->file('teacher_profile'))
            {
                $file = $request->file('teacher_profile');
                $destinationPath = 'teacher_profile_pics';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {
                    $update = Teacher::where('teacher_id',$request->teacher_id)
                    ->update([
                        'teacher_name'          => $request->name,
                        'teacher_father_name'   => $request->father_name,
                        'teacher_qualification' => $request->qualification,
                        'teacher_phone'         => $request->phone_number,
                        'is_class_teacher'      => $request->class_teacher,
                        'teacher_nic'           => $request->cnic,
                        'teacher_email'         => $request->email,
                        'teacher_dob'           => $request->dob,
                        'teacher_address'       => $request->address,
                        'teacher_religion'      => $request->religion,
                        'refrance_name'         => $request->ref_name,
                        'refrence_cnic'         => $request->ref_cnic,
                        'refrence_phone_no'     => $request->ref_phone,
                        'teacher_designation'   => $request->designation,
                        'teacher_gender'        => $request->gender,
                        'teacher_profile_pic'   => 'teacher_profile_pics/' . $file_name,
                        'is_active'             => $request->status,
                    ]);
                    if($update)
                    {
                        if($request->status == '1')
                        {
                            $update = User::where('nic_no',$request->cnic)
                                            ->update(['is_active','1']);

                        }
                        else
                        {
                            $update = User::where('nic_no',$request->cnic)
                                            ->update(['is_active','0']);
                        }
                        $data = [
                            'response'  => '1',
                            'messages'  => 'Teacher Profile Updated succefully',
                            'class'     => 'alert alert-success',
                        ];


                        return response()->json($data);

                    }
                }
            }
            else
            {
                $update = Teacher::where('teacher_id',$request->teacher_id)
                                    ->update([
                                        'teacher_name'          => $request->name,
                                        'teacher_father_name'   => $request->father_name,
                                        'teacher_qualification' => $request->qualification,
                                        'teacher_phone'         => $request->phone_number,
                                        'is_class_teacher'      => $request->class_teacher,
                                        'teacher_nic'           => $request->cnic,
                                        'teacher_email'         => $request->email,
                                        'teacher_dob'           => $request->dob,
                                        'teacher_address'       => $request->address,
                                        'teacher_religion'      => $request->religion,
                                        'refrance_name'         => $request->ref_name,
                                        'refrence_cnic'         => $request->ref_cnic,
                                        'refrence_phone_no'     => $request->ref_phone,
                                        'teacher_designation'   => $request->designation,
                                        'teacher_gender'        => $request->gender,
                                        'is_active'             => $request->status,
                                    ]);
                if($update)
                {
                    if($request->status == '1')
                    {
                        $update = User::where('nic_no',$request->cnic)
                                        ->update(['is_active' => '1']);

                    }
                    else
                    {
                        $update = User::where('nic_no',$request->cnic)
                                        ->update(['is_active' => '0']);
                    }
                    $data = [
                        'response'  => '1',
                        'messages'  => 'Teacher Profile Updated succefully',
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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Teacher $teacher)
    {
        //
        $check = Teacher::where('id',$request->teacher_id)->delete();
        $request->session()->flash('message', 'Teacher Profile removed successfully');
        return redirect()->back();

    }

    public function teacher_card(Request $request)
    {
        $card = Teacher::where('id',$request->teacher_id)
                        ->first();
        return response()->json($card);

    }
}
