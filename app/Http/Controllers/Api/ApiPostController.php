<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment_vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ApiPostController extends Controller
{
    public function destroyCom($id){
        $com = Comment::findOrFail($id); 
        $com->delete();
        return response()->json(['message' => "Deleted Successful!"], 200);
    }
    public function destroy($id){

        $post = Post::findOrFail($id);
        $imgPostPath = $post->image_name;
        $user = auth()->id();
        $delImage = 'public/post/images/'. $imgPostPath;
  
        if(!Storage::exists($delImage)){
          Storage::delete($delImage);
          $post->delete();
          return response()->json(['message' => "Error!"], 200);
        }
        
        $post->delete();
        return response()->json(['message' => "Deleted Successful!"], 200);
  
    }

    public function store(Request $request, $uid){
        // dd($request);
        $file = $request->hasFile('image');
        // dd($file);
        if($file){
            $newFile = $request->file('image');
            $fileTtile = $request->get('title');
            $fileContent = $request->get('content');
            $uniquName = $newFile->hashName();

            
            // $getUser = auth()->id();
            $user = User::findOrFail($uid);
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
            $post->user_id = $uid;

            $post->save();

            return response()->json(['message', 'Post Created Successfuly!'], 200);
        }
    }

    public function like(Request $request, $pid, $uid){

        $postID = $request->input('id');
        $user_id = auth()->id();
        // $like->user_id = $user_id;
        // $like->post_id = $postID;
        // $like->save();
        
        $like = DB::table('likes')
        ->WHERE('user_id', $uid)
        ->WHERE('post_id', $pid)
        ->first();
        if(!$like){
            $like = new Like();
            $like->user_id = $uid;
            $like->post_id = $pid;
            $like->save();
        }else{
            DB::table('likes')->where('user_id', $uid)->where('post_id', $pid)->delete();
            $likes_count = Like::where('post_id', $pid)->count();
            return response()->json(['success' => true, 'likes_count' => $likes_count]);
        }

        // return redirect('/home')->with('message', 'liked!');
        $likes_count = Like::where('post_id', $pid)->count();
        return response()->json(['success' => true, 'likes_count' => $likes_count], 200);
    }
    public function updatePost(Request $req, $uid, $pid){
        $newFile = $req->file('image');
        $fileTtile = $req->get('title');
        $fileContent = $req->get('content');
        $uniquName = $newFile->hashName();

        
        $getUser = auth()->id();
        $user = User::findOrFail($uid);
        $lastName = $user->last_name;
        
        $toLowerCase = Str::lower($lastName);
        $rmvSpaces = Str::replace(' ','-', $toLowerCase);

        $fileToStore = 'post.'.$rmvSpaces.'.'.$uniquName;
        $newFile->storeAs('public/post/images', $fileToStore);
        // dd($request);

        // Do something with the file path (e.g. store it in a database)
        $post = Post::findOrFail($pid);
        $post->post_title = $fileTtile;
        $post->post_content = $fileContent;
        $post->image_name = $fileToStore;
        $post->user_id = $uid;

        $post->update();

        return response()->json(['success' => true, 'Post Edited Successfuly!'], 200);

    }

    public function storeComment(Request $req, $uid, $pid){
        // $user = auth()->id();
        $comment = new Comment();

        $comment->content = $req->input('comment');
        $comment->post_id = $pid;
        $comment->user_id = $uid;

        $comment->save();
        return response()->json(['success' => true, 'Post Created Successfuly'], 200);
    }

    public function likeComment(Request $request, $uid){
        
        $postID = $request->input('postId');
        // $user_id = auth()->id();
        $commentID = $request->input('comId');
        // dd($commentID);
        
        $comment_vote = DB::table('comment_vote')
        ->WHERE('user_id', $uid)
        ->WHERE('post_id', $postID)
        ->WHERE('comment_id', $commentID)
        ->first();
        if(!$comment_vote){
            $comment_vote = new Comment_vote();
            $comment_vote->user_id = $uid;
            $comment_vote->post_id = $postID;
            $comment_vote->comment_id = $commentID;
            $comment_vote->save();
        }else{
            DB::table('comment_vote')->where('user_id', $uid)->where('post_id', $postID)
            ->where('comment_id', $commentID)->delete();
            $comment_votes_count = Comment_vote::where('comment_id', $commentID)->count();
            return response()->json(['success' => true, 'comment_count' => $comment_votes_count], 200);
        }

        // return redirect('/home')->with('message', 'liked!');
        $comment_votes_count = Comment_vote::where('comment_id', $commentID)->count();
        return response()->json(['success' => true, 'comment_count' => $comment_votes_count], 200);
    }

    public function editCom(Request $req, $uid){
        $comment = $req->input('com');
        $id = $req->input('id');
        $postID = $req->input('postId');
        $com = Comment::findOrFail($id);
        // $user_id = auth()->id();
        $comID = $com->user_id;
        $com->content = $comment;
        $new_uid = $uid;
        $toInt_uid = (int) $new_uid;
        $check = $comID !== $toInt_uid;
        
        if($check){
            $com = "";
            return response()->json(['failed' => 'Edit comment failed!', 'postId'=> $postID], 400);
        }
        $com->update();
        return response()->json(['success' => 'Edit comment successful!', 'postId'=> $postID], 200);

    }   
}
