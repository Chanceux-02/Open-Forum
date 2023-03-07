<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
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

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt( $request->input('password') );

        $user->save();

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
            // authentication not successful
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

}
