<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetUserController extends Controller
{
    //

    public function index(){

        $title = 'Home Page';
        return view('index')->with(['title' => $title]);
    }

    public function login(){

        $title = 'Login Page';
        return view('auth.login')->with(['title' => $title]);
    }

    public function register(){

        $title = 'Register Page';
        return view('auth.register')->with(['title' => $title]);
    }

    public function createPost(){

        $title = 'Create Post';
        return view('pages.createPost')->with(['title' => $title]);
    }
}
