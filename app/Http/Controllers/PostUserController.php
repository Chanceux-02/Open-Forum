<?php

namespace App\Http\Controllers;
use \App\Models\PostUser;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PostUserController extends Controller
{
    //

    public function create(Request $request){

        // dd($request);

        $validated = $request->validate([
            
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:6'

        ]);

        $validated['password'] = bcrypt( $validated['password']);
        PostUser::create($validated);

        // return redirect('/register')->with('message', 'Register successfuly');
    }

}
