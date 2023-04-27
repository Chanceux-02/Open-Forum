<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApiGetUserController extends Controller
{
    public function test(){
        $usersData = User::all();
        return response()->json($usersData, 200);
    }
  
}
