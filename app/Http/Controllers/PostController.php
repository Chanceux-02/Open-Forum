<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Comment_vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            $fileTtile = $request->get('title');
            $fileContent = $request->get('content');
            $uniquName = $newFile->hashName();

            
            $getUser = auth()->id();
            $user = User::findOrFail($getUser);
            $lastName = $user->last_name;
            
            $toLowerCase = Str::lower($lastName);
            $rmvSpaces = Str::replace(' ','-', $toLowerCase);

            $fileToStore = 'post.'.$rmvSpaces.'.'.$uniquName;
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

    public function like(Request $request){

        $postID = $request->input('id');
        $user_id = auth()->id();
        // $like->user_id = $user_id;
        // $like->post_id = $postID;
        // $like->save();
        
        $like = DB::table('likes')
        ->WHERE('user_id', $user_id)
        ->WHERE('post_id', $postID)
        ->first();
        if(!$like){
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $postID;
            $like->save();
        }else{
            DB::table('likes')->where('user_id', $user_id)->where('post_id', $postID)->delete();
            $likes_count = Like::where('post_id', $postID)->count();
            return response()->json(['success' => true, 'likes_count' => $likes_count]);
        }

        // return redirect('/home')->with('message', 'liked!');
        $likes_count = Like::where('post_id', $postID)->count();
        return response()->json(['success' => true, 'likes_count' => $likes_count]);
    }
    public function updatePost(Request $req, $id){

        $newFile = $req->file('image');
        $fileTtile = $req->get('title');
        $fileContent = $req->get('content');
        $uniquName = $newFile->hashName();

        
        $getUser = auth()->id();
        $user = User::findOrFail($getUser);
        $lastName = $user->last_name;
        
        $toLowerCase = Str::lower($lastName);
        $rmvSpaces = Str::replace(' ','-', $toLowerCase);

        $fileToStore = 'post.'.$rmvSpaces.'.'.$uniquName;
        $newFile->storeAs('public/post/images', $fileToStore);
        // dd($request);

        // Do something with the file path (e.g. store it in a database)
        $post = Post::findOrFail($id);
        $post->post_title = $fileTtile;
        $post->post_content = $fileContent;
        $post->image_name = $fileToStore;
        $post->user_id = auth()->id();

        $post->update();

        return redirect('/user/profile')->with('message', 'Post Edited Successfuly!');

    }

    public function storeComment(Request $req, $id){
        $user = auth()->id();
        $comment = new Comment();

        $comment->content = $req->input('comment');
        $comment->post_id = $id;
        $comment->user_id = $user;

        $comment->save();
        return redirect('/show/comment/'. $id)->with('message', 'Post Created Successfuly!');
    }
    public function likeComment(Request $request){
        
        $postID = $request->input('postId');
        $user_id = auth()->id();
        $commentID = $request->input('comId');
        // dd($commentID);
        
        $comment_vote = DB::table('comment_vote')
        ->WHERE('user_id', $user_id)
        ->WHERE('post_id', $postID)
        ->WHERE('comment_id', $commentID)
        ->first();
        if(!$comment_vote){
            $comment_vote = new Comment_vote();
            $comment_vote->user_id = $user_id;
            $comment_vote->post_id = $postID;
            $comment_vote->comment_id = $commentID;
            $comment_vote->save();
        }else{
            DB::table('comment_vote')->where('user_id', $user_id)->where('post_id', $postID)
            ->where('comment_id', $commentID)->delete();
            $comment_votes_count = Comment_vote::where('comment_id', $commentID)->count();
            return response()->json(['success' => true, 'comment_count' => $comment_votes_count]);
        }

        // return redirect('/home')->with('message', 'liked!');
        $comment_votes_count = Comment_vote::where('comment_id', $postID)->count();
        return response()->json(['success' => true, 'comment_count' => $comment_votes_count]);
    }
}
