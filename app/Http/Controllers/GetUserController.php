<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetUserController extends Controller
{
    //

    public function index(){

        $title = 'Home Page';
          // return view('index')->with(['title' => $title]);
          // $users = DB::table('users')->get();
          //   $post = Post::all()->orderByDesc('created_at');
          // dd($post);
          // $picturePath = storage_path('app/post');

          
          $post = DB::table('post')->orderByDesc('created_at')->get();
          $users = DB::table('users')->orderByDesc('created_at')->get();

          $data =[

            'post' => $post,
            'user' => $users, 
            'title' => $title,

          ];

          // $datas = DB::table('post')
          //   ->join('users', 'post.user_id', '=', 'users.users_id')
          //   // ->join('profiles', 'users.user_id', '=', 'profiles.user_id')
          //   ->select('post.*', 'users.first_name', 'users.last_name', 'users.profile_pic')
          //   ->get();

          
            $datas = DB::table('users')
            ->join('post', 'users.user_id', '=', 'post.user_id')
            ->select('users.*', 'post.*')
            ->orderByDesc('post.created_at')
            ->get();

            
          $data =[

            'data' => $datas,
            'title' => $title,

          ];

          return view('index', $data);

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
