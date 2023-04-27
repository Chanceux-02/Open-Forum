<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;


class ApiPostController extends Controller
{
    public function destroyCom($id){
        $com = Comment::findOrFail($id); 
        $com->delete();
        return response()->json(['message' => "Deleted Successful!"], 200);
    } 
}
