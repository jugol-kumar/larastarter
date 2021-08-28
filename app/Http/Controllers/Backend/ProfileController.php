<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('backend.profiles.index');
    }

    public function update(Request $request){

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'avatar' => 'nullable|image'
        ]);

        // Get Logged in user.
        $user = Auth::user();

        // Update User Info
        $user->update([
           'name'  => $request->name,
           'email' => $request->email
        ]);

        // Upload image
        if ($request->hasFile('avatar')){
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('Profile Update Successfull', 'success');
        return back();
    }

    public function changePassword(){
        return view('backend.profiles.password');
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
           'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        $hashedPassword = $user->password;

        if ( Hash::check($request->current_password , $hashedPassword)){
            if (!Hash::check($request->password, $hashedPassword)){
                $user->update([
                   'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                return redirect()->route('login');
            }else{
                notify()->warning('New Password Can Not Be Same As Same Password', 'Warning');
            }
        }else{
            notify()->error('Current Password Not Match', 'Error');
        }
        return back();


    }



















}
