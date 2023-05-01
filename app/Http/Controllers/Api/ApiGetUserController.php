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

    public function index(){

        $title = 'Home Page';
  
        $post = DB::table('post')->orderByDesc('created_at')->get();
        $users = DB::table('users')->orderByDesc('created_at')->get();
  
        $data =[
          'post' => $post,
          'user' => $users, 
          'title' => $title,
        ];
  
          $datas = DB::table('users')
          ->join('post', 'users.user_id', '=', 'post.user_id')
          ->select('users.*', 'post.*')
          ->orderByDesc('post.created_at')
          ->get();
          // dd($datas);
  
          $likes = DB::table('post')
          ->leftJoin('likes', 'post.post_id', '=', 'likes.post_id')
          ->groupBy('post.post_id', 'post.post_title', 'post.post_content', 'post.image_name', 'post.user_id', 'post.post_created', 'post.updated_at', 'post.created_at')
          ->select('post.*', DB::raw('COUNT(likes.like_id) AS likes_count'))
          ->get();
          // dd($likes);
  
          // dd($liked);
          $user = auth()->id();
          $liked =  DB::table('likes')->select('post_id as liked_id')->where('user_id', $user)->get();
          // dd($liked);
  
          $comment_counts = DB::table('post')
          ->leftJoin('comments', 'post.post_id', '=', 'comments.post_id')
          ->select('post.post_id', DB::raw('COUNT(comments.comment_id) AS comment_count'))
          ->groupBy('post.post_id')
          ->get();
  
          $data =[
            'info' => $datas,
            'title' => $title,
            'like' => $likes,
            'liked' => $liked,
            'answers' => $comment_counts
          ];
  
          return response()->json($data, 200);
     }

     public function profile($id){

        $title = 'User Profile';
        // $user = auth()->id();

        $users = User::findOrFail($id);
        $dataP = DB::table('post')
        ->WHERE('user_id', $users->user_id)
        ->orderByDesc('created_at')
        ->get();

        $user = auth()->id();
        $liked =  DB::table('likes')->select('post_id as liked_id')->where('user_id', $user)->get();
        
        $likes = DB::table('post')
        ->leftJoin('likes', 'post.post_id', '=', 'likes.post_id')
        ->groupBy('post.post_id', 'post.post_title', 'post.post_content', 'post.image_name', 'post.user_id', 'post.post_created', 'post.updated_at', 'post.created_at')
        ->select('post.*', DB::raw('COUNT(likes.like_id) AS likes_count'))
        ->get();

        
        $comment_counts = DB::table('post')
        ->leftJoin('comments', 'post.post_id', '=', 'comments.post_id')
        ->select('post.post_id', DB::raw('COUNT(comments.comment_id) AS comment_count'))
        ->groupBy('post.post_id')
        ->get();



        $datas = [
          'user' => $users,
          'data' => $dataP,
          'like' => $likes,
          'liked' => $liked,
          'answers' => $comment_counts,
          'title' => $title

        ];

        return response()->json($datas, 200);
    }

    public function edit($id){
        $title = 'Edit Profile';
        // $user = auth()->id();
        $usersData = User::findOrFail($id);

        $datas = [
            'title' => $title,
            'userData' => $usersData,
        ];
   
        return response()->json($datas, 200);      
    }

    public function editPost($id){
        $title = 'Edit Post';
        $usersData = Post::findOrFail($id);

        $datas = [
            'postData' => $usersData,
            'title' => $title
        ];
        return response()->json($datas, 200);      
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

      public function comment($id){
        $title = 'Post Comments';
  
        $datas = DB::table('users')
        ->join('post', 'users.user_id', '=', 'post.user_id')
        ->select('users.*', 'post.*')->where('post_id', $id)
        ->orderByDesc('post.created_at')
        ->get();
  
        $likes = DB::table('post')
        ->leftJoin('likes', 'post.post_id', '=', 'likes.post_id')
        ->groupBy('post.post_id', 'post.post_title', 'post.post_content', 'post.image_name', 'post.user_id', 'post.post_created', 'post.updated_at', 'post.created_at')
        ->select('post.*', DB::raw('COUNT(likes.like_id) AS likes_count'))
        ->get();
  
        $comment_counts = DB::table('post')
        ->leftJoin('comments', 'post.post_id', '=', 'comments.post_id')
        ->select('post.post_id', DB::raw('COUNT(comments.comment_id) AS comment_count'))
        ->groupBy('post.post_id')
        ->get();
        
        $votes = DB::table('comments')
        ->leftJoin('comment_vote', 'comments.comment_id', '=', 'comment_vote.comment_id')
        ->select('comments.comment_id', DB::raw('count(comment_vote.vote_id) as vote'))
        ->groupBy('comments.comment_id')
        ->get();
        
        $comment = DB::table('users')
        ->join('comments','users.user_id', '=', 'comments.user_id')
        ->join('post', 'comments.post_id', '=', 'post.post_id')
        ->select('users.*', 'comments.*', 'post.*')->where('post.post_id', $id)
        ->get();
        
        $user = auth()->id();
        $liked =  DB::table('likes')->select('post_id as liked_id')->where('user_id', $user)->get();
        $voted =  DB::table('comment_vote')->select('comment_id as voted_id')->where('user_id', $user)->get();
        
        $datas = [
          'info' => $datas,
          'like' => $likes,
          'liked' => $liked,
          'votes' => $votes,
          'voted' => $voted,
          'comment' => $comment,
          'answers' => $comment_counts,
          'title'=> $title
        ];
  
        return response()->json($datas, 200);      
    }

    public function editCom($id){
        $title = 'Edit Comment';
        $com = Comment::findOrFail($id);
        $datas = [
          'comData' => $com,
          'id' => $com,
          'title' => $title
        ];
        return response()->json($datas, 200);     
    }

    public function search(Request $req, $id){

        $title = 'Result Page';
  
        $search = $req->input('srchText');
        $datas = DB::table('users')
        ->join('post', 'users.user_id', '=', 'post.user_id')
        ->select('users.*', 'post.*')
        ->where('post_title', 'like', '%'.$search.'%')
        ->get();
  
        $likes = DB::table('post')
        ->leftJoin('likes', 'post.post_id', '=', 'likes.post_id')
        ->groupBy('post.post_id', 'post.post_title', 'post.post_content', 'post.image_name', 'post.user_id', 'post.post_created', 'post.updated_at', 'post.created_at')
        ->select('post.*', DB::raw('COUNT(likes.like_id) AS likes_count'))
        ->get();
  
        // $user = auth()->id();
        $liked =  DB::table('likes')->select('post_id as liked_id')->where('user_id', $id)->get();
        // dd($liked);
  
        $comment_counts = DB::table('post')
        ->leftJoin('comments', 'post.post_id', '=', 'comments.post_id')
        ->select('post.post_id', DB::raw('COUNT(comments.comment_id) AS comment_count'))
        ->groupBy('post.post_id')
        ->get();
  
        $data =[
          'info' => $datas,
          'title' => $title,
          'like' => $likes,
          'liked' => $liked,
          'answers' => $comment_counts,
        ];
        
        if ($datas->count() === 0) {
          return view('errors.noResult')->with(['title'=> $title]);
        }
        return response()->json($data, 200);
      }
  
}
