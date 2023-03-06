<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;



class PostingController extends Controller
{
    public function store(Request $request){

        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt( $request->input('password') );

        $user->save();

        return redirect('/login')->with('message', 'Register successful');
    }
}
