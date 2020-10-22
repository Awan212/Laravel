<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['user_role'] == 'student')
        {
            return Validator::make($data, [
                'user_role' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nic_no' => ['required', 'string', 'integer',  'unique:users', 'exists:students,student_cnic'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        elseif($data['user_role'] == 'teacher')
        {
            return Validator::make($data, [
                'user_role' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nic_no' => ['required', 'string', 'integer',  'unique:users', 'exists:teachers,teacher_nic'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else
        {
            return Validator::make($data, [
                'user_role' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nic_no' => ['required', 'string', 'integer',  'unique:users', 'exists:admins,admin_cnic'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
                    'user_role' => $data['user_role'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'nic_no' => $data['nic_no'],
                    'password' => Hash::make($data['password']),
                ]);
    }
}
