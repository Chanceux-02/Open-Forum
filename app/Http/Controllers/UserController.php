<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User();
        // dd($request);
        $file = $request->hasFile('profilePic');
       
        if($file){

            $profilePic = $request->file('profilePic');
            $profileN = $request->input('last_name');
            $picName = $profilePic->hashName();
            $newPicName = 'user-' . $profileN . '-' . $picName;
            $profilePic->storeAs('public/user/profile-pics', $newPicName);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->profile_pic = $newPicName;
            $user->email = $request->input('email');
            $user->password = bcrypt( $request->input('password') );
            // dd($user);
            $user->save();
        }
        return redirect('/')->with('message', 'Register successful!');
    }


    public function login(Request $request){
        // dd($request);
        $validated = Validator::make($request->all(),[

            "email" => ['required', 'email'],
            "password" => 'required'
        ]);
        if ($validated->fails()) {
            return redirect('/')
            ->withErrors($validated)
            ->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['email' => 'Login Failed'])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect('/home')->with('message', 'Login successful!');
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout successful');
    }

    public function update(Request $request){
        // dd($request);
        $file = $request->hasFile('profilePic');
        // dd($file);
        if(!$file){
            // dd('$file');
        }

        $newFile = $request->file('profilePic');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $hashed_fileName = $newFile->hashName();

        $toLowerCase = Str::lower($last_name);
        $rmvSpaces = Str::replace(' ','-', $toLowerCase);
        $fileToStore = 'user.'.$rmvSpaces.'.'.$hashed_fileName;
        $newFile->storeAs('public/user/profile-pics', $fileToStore);

        $userId = auth()->id();
        $user = User::findOrFail($userId);
        $userProfilePic = $user->profile_pic;


        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->profile_pic = $fileToStore;

        $locatDelete = 'public/user/profile-pics/' . $userProfilePic;

        if(!Storage::exists($locatDelete)){
            $user->update();
            return redirect('/user/profile')->with('message', 'Profile updated Successfuly!');
        }

        Storage::delete($locatDelete);
        $user->update();
        return redirect('/user/profile')->with('message', 'Profile updated Successfuly!');
    }
}
