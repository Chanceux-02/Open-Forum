<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => "Register Failed!"], 400);
        }

        $user = new User();
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
            $user->save();
        }
        return response()->json(['message' => "Successfuly Registered!"], 200);
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
<<<<<<< HEAD
            return response()->json(['message' => "log in failed!"], 400);
        }

        $request->session()->regenerate();
        return response()->json(['message' => "logged in Successful!"], 200);
=======
            return response()->json(['message' => "Login Failed!"], 400);
        }

        $request->session()->regenerate();
        return response()->json(['message' => "Login successful!"], 200);
>>>>>>> master
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => "Logout successful!"], 200);

<<<<<<< HEAD
        return response()->json(['message' => "logged out Successful!"], 200);
=======
>>>>>>> master
    }


    public function update(Request $request, $id){
        $file = $request->hasFile('profilePic');
        // $first_name = $request->input('first_name');
        // dd($file);
        if(!$file){
            // dd($file);
        }
        
        $newFile = $request->file('profilePic');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $bio = $request->input('bio');
        $email = $request->input('email');
        $password = $request->input('password');
        $hashed_fileName = $newFile->hashName();

        $toLowerCase = Str::lower($last_name);
        $rmvSpaces = Str::replace(' ','-', $toLowerCase);
        $fileToStore = 'user.'.$rmvSpaces.'.'.$hashed_fileName;
        $newFile->storeAs('public/user/profile-pics', $fileToStore);

        // $userId = auth()->id();
        $userId = $id;
        $user = User::findOrFail($userId);
        $userProfilePic = $user->profile_pic;


        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->bio = $bio;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->profile_pic = $fileToStore;

        $locatDelete = 'public/user/profile-pics/' . $userProfilePic;

        if(!Storage::exists($locatDelete)){
            $user->update();
            return response()->json(['message' => "Profile updated Successfuly!"], 200);
        }

        Storage::delete($locatDelete);
        $user->update();
        return response()->json(['message' => "Profile updated Successfuly!"], 200);
    }

    
}
