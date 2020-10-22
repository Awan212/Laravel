<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = ClassSection::get();
        $data = [
            'classes' => $classes
        ];
        return view('admin.students.main',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classes = ClassSection::orderBy('class_title','ASC')->get();
        return view('admin.students.create',compact('classes'));
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
            'student_profile_pic' => 'required|image|mimes:jpeg,bmp,png',
            'student_roll_no' => 'required|unique:students',
            'student_name' => 'required',
            'student_father_name' => 'required',
            'class' => 'required',
            'student_cnic' => 'required|unique:students',
            'student_dob' => 'required',
            'student_gender' => 'required',
            'student_address' => 'required',
            'student_religion' => 'required',
            'guardian_name' => 'required',
            'guardian_cnic' => 'required',
            'guardian_phone_no' => 'required',
            'guardian_occopation' => 'required',

        ]);
        if($validator->fails()){
            return redirect()->to('add_students')->withErrors($validator)->withInput();
        }
        else
        {
            $check = ClassSection::where('id',$request->class)->first();
            $students = Student::where('class_sections_id',$request->class)->count();
            if($check->seats == $students )
            {
                $request->session()->flash('message', 'New Student add successfuly');
                return redirect()->to('add_students')->withInput();
            }
            else
            {
                $data = new Student;
                $file = $request->file('student_profile_pic');
                $destinationPath = 'student_profile_pics';
                $file_name = time().$file->getClientOriginalName();
                $check = $file->move($destinationPath,$file_name);
                if($check)
                {   
                    $data->student_profile_pic =    'student_profile_pics/'.$file_name;

                    $data->student_roll_no = $request->student_roll_no;
                    $data->student_name = $request->student_name;
                    $data->student_father_name = $request->student_father_name;
                    $data->class_sections_id = $request->class;
                    $data->student_cnic = $request->student_cnic;
                    $data->student_email = $request->student_email;
                    $data->dob = $request->student_dob;
                    $data->student_gender = $request->student_gender;
                    $data->student_address = $request->student_address;
                    $data->student_religion = $request->student_religion;
                    $data->student_guardian_name = $request->guardian_name;
                    $data->student_guardian_cnic = $request->guardian_cnic;
                    $data->student_guardian_phone_no = $request->guardian_phone_no;
                    $data->student_guardian_occopation = $request->guardian_occopation;
                    $check = $data->save();
                    if($check)
                    {
                        $check = User::create([
                            'user_role' => 'student',
                            'name' => $request->student_name,
                            'email' => $request->student_email,
                            'nic_no' => $request->student_cnic,
                            'password' => Hash::make('123456789'),
                            'user_profile_pic' => 'student_profile_pics/'.$file_name,
                        ]);
                        if($check)
                        {
                            $request->session()->flash('message', 'New Student add successfuly');
                            return redirect('add_students');
                        }
                    }
                }
                else
                {
                    $request->session()->flash('error', 'There is error in your user profile pic');
                    return redirect('add_students');  
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Student $student)
    {
        //
        
        $students = Student::with('class')
                            ->where('is_active', 1)
                            ->orderBy('id', 'DESC')
                            ->get();
        $data   = [
            'students' => $students
        ];
        return view('admin.students.show',compact('data'));
      
         
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Student $student)
    {
        //
        $student = Student::with('class')
                            ->where('student_roll_no',$request->student_roll_no)
                            ->first();
        
        return response()->json($student);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $validator = Validator::make($request->all(),[
            'editStudentProfile' => 'image|mimes:jpeg,bmp,png',
            'roll_no' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'class_section' => 'required',
            'cnic' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'guardian_name' => 'required',
            'guardian_cnic' => 'required',
            'guaridan_phone' => 'required',
            'guardian_occopa' => 'required',

        ]);
        if($validator->fails()){
            $data = [
                'response' => '0',
                'error' => $validator->errors()->all(),
                'class' => 'alert alert-danger',
            ];
            return response()->json($data);
        }
        else
        {
            $check = ClassSection::where('id',$request->class_section)->first();
            $students = Student::where('class_sections_id',$request->class_section)->count();
            if($check->seats == $students )
            {
                $data = [
                    'response' => '0',
                    'error' => ['The seats are full in this selected class.'],
                    'class' => 'alert alert-danger',
                ];
                return response()->json($data);
            }
            else
            {
                if($request->file('editStudentProfile'))
                {
                    $file = $request->file('editStudentProfile');
                    $destinationPath = 'student_profile_pics';
                    $file_name = time().$file->getClientOriginalName();
                    $check = $file->move($destinationPath,$file_name);
                    if($check)
                    {   

                        $data =Student::where('id' , $request->student_id)
                                    ->update([
                                        'student_profile_pic' => 'student_profile_pics/'.$file_name,
                                        'student_roll_no' => $request->roll_no,
                                        'student_name'    =>  $request->name,
                                        'student_father_name' => $request->father_name,
                                        'class_sections_id' => $request->class_section,
                                        'student_cnic'  => $request->cnic,
                                        'student_email' => $request->email,
                                        'dob'   => $request->dob, 
                                        'student_gender'    => $request->gender, 
                                        'student_address' => $request->address,
                                        'student_religion' => $request->religion,
                                        'student_guardian_name' => $request->guardian_name,
                                        'student_guardian_cnic' => $request->guardian_cnic,
                                        'student_guardian_phone_no' => $request->guaridan_phone,
                                        'student_guardian_occopation' => $request->guardian_occopa,
                                        'is_active'                    => $request->student_status,
                                        'struck_off'                   => $request->struck_off
                                    ]);
                    
                        if($data)
                        {
                            $data = [
                                'response'  => '1',
                                'message'   =>  'updated successfully',
                                'class'     => 'alert alert-success'

                            ];

                            return response()->json($data);
                        }
                    }
                }
                else
                {
                    $data =Student::where('id' , $request->student_id)
                                    ->update([
                                        'student_roll_no' => $request->roll_no,
                                        'student_name'    =>  $request->name,
                                        'student_father_name' => $request->father_name,
                                        'class_sections_id' => $request->class_section,
                                        'student_cnic'  => $request->cnic,
                                        'student_email' => $request->email,
                                        'dob'   => $request->dob, 
                                        'student_gender'    => $request->gender, 
                                        'student_address' => $request->address,
                                        'student_religion' => $request->religion,
                                        'student_guardian_name' => $request->guardian_name,
                                        'student_guardian_cnic' => $request->guardian_cnic,
                                        'student_guardian_phone_no' => $request->guaridan_phone,
                                        'student_guardian_occopation' => $request->guardian_occopa,
                                        'is_active'                    => $request->student_status,
                                        'struck_off'                   => $request->struck_off,
                                    ]);
                    
                    if($data)
                    {
                        $data = [
                            'response'  => '1',
                            'message'   =>  'updated successfully',
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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,Student $student)
    {
        //
        $student = Student::where('id',$request->student_id)
                        ->delete(); 
        if($student)
        {
            $request->session()->flash('message','Student Remove successfully');
            
            return redirect()->back();
            
        }
    }

    public function status(Request $request )
    {
        // dd($request->student_roll);
        $check = Student::where('student_roll_no',$request->student_roll)
                        ->first();
        if($check->is_active == '1')
        {
            $update = Student::where('student_roll_no',$request->student_roll)
                                ->update(['is_active'=> 0]);
            $request->session()->flash('message','Student status change successfully');
            return redirect()->back();    	
        }
        elseif($check->is_active == '0')
        {
            $update = Student::where('student_roll_no',$request->student_roll)
                                ->update(['is_active'=> 1]);
            
            $request->session()->flash('message','Student status change successfully');
            return redirect()->back();  
        }
    }

    public function student_card(Request $request)
    {
     
        $data = Student::with('class')
                        ->where('id',$request->student)
                        ->first();
        return view('admin.students.student_card',compact('data'));
            
        
    }
    public function struck_off_student()
    {
        $struck_off = Student::with('class')
                            ->where('struck_off', 1)
                            ->where('is_active', 1)
                            ->get();
        $data =[
            'struck_off'  => $struck_off,
        ];
        return view('admin.homePageDetail.StruckOffStudent', compact('data'));
    }


    public function class_base_Student(Request $request)
    {
        $students = Student::where('class_sections_id', $request->class_section_id)
                            ->get();
        $data = [
            'response' => 1,
            'students' => $students,
        ];
        return view('admin.students.classBaseStudent',compact('data'));
    }

    public function leave_student()
    {
        $students = Student::with('class')
                            ->where('is_active', 0)
                            ->get();
        $data = [
            'students' => $students,
        ];
        return view('admin.students.leave_student',compact('data'));
    }
}
