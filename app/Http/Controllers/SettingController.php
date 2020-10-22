<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class SettingController extends Controller
{
    //

    public function index()
    {
        return view('auth.passwords.changePassword');
    }

    public function changePassword(Request $request)
    {
        if(Auth::Check())
        {   

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => ['required', 'same:new_password', 'min:8'],
                'confirmation_new_password' => 'required|same:new_password', 
            ],[]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            else
            {
                $currentPassword = Auth::User()->password;
                if(Hash::check($request->current_password, $currentPassword))
                {
                    $userId = Auth::User()->id;
                    $user = User::find($userId);
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    $request->session()->flash('message', 'Your password has been updated successfully.');
                    return redirect()->back();
                }
                else
                {
                    $request->session()->flash('message', 'Sorry, your current password was not recognised. Please try again.');
                    return redirect()->back();
                }
            }
        }
        else
        {
            // Auth check failed - redirect to domain root
            return redirect()->to('/');
        }
    }

    public function bannedPasswords(){
        return [
            'password', '12345678', '123456789', 'baseball', 'football', 'jennifer', 'iloveyou', '11111111', '222222222', '33333333', 'qwerty123'
        ];
    }

}
