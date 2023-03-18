<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request){
        // dd($request);
        $file = $request->hasFile('image');
        // dd($file);
        if($file){
            $newFile = $request->file('image');
            $fileTopic = $request->get('topic');
            $fileTtile = $request->get('title');
            $fileContent = $request->get('content');
            $uniquName = $newFile->hashName();
            $fileToStore = 'post.'.$fileTopic.'.'.$uniquName;
            $newFile->storeAs('public/post/images', $fileToStore);
            // dd($request);

            // Do something with the file path (e.g. store it in a database)
            $post = new Post();
            $post->post_title = $fileTtile;
            $post->post_content = $fileContent;
            $post->image_name = $fileToStore;
            $post->user_id = auth()->id();

            $post->save();

            return redirect('/home')->with('message', 'Post Created Successfuly!');
        }
    }

}
