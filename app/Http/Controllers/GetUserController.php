<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GetUserController extends Controller
{
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
    public function edit(){
      $title = 'Edit Profile';
      $user = auth()->id();
      $usersData = User::findOrFail($user);
 
      return view('pages.updateProfile', ['userData' => $usersData])->with(['title' => $title]);
    }
    public function editPost($id){
      $title = 'Edit Post';
      $usersData = Post::findOrFail($id);
      // dd($usersData);
      return view('pages.editPost', ['postData' => $usersData])->with(['title' => $title]);
    }
    public function editCom($id){
      $title = 'Edit Comment';
      $com = Comment::findOrFail($id);
      return view('pages.editCom', ['comData' => $com])->with(['title' => $title]);
    }

    //http get with some queries

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

        $data =[
          'info' => $datas,
          'title' => $title,
          'like' => $likes,
          'liked' => $liked
        ];

        // dd($data);
      return view('index', $data);
   }

    public function profile(){

        $title = 'User Profile';
        $user = auth()->id();
        // $user = DB::table('users')->where('id', $id)->firstOrFail();
        // Eloquent ORM vs. query builder.

        $users = User::findOrFail($user);
        // $dataP = $users->post;
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

        $datas = [
          'user' => $users,
          'data' => $dataP,
          'like' => $likes,
          'liked' => $liked
        ];

        return view('pages.userProfile', $datas)->with(['title' => $title]);
    }

    public function destroy($id){

      //Get an instance of the Storage Class
      $post = Post::findOrFail($id);
      $imgPostPath = $post->image_name;
      $user = auth()->id();
      $delImage = 'public/post/images/'. $imgPostPath;

      if(!Storage::exists($delImage)){
        Storage::delete($delImage);
        $post->delete();
        return redirect('/user/profile')->with(['message' => "Error!"]);
      }
      
      $post->delete();
      return redirect('/user/profile')->with(['message' => "Deleted Successful!"]);
      // return redirect('/user/profile/'. $user)->with(['message' => "Deleted Successful!"]);

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

      // $votes = DB::table('comments')
      // ->leftJoin('comment_vote', 'comment_vote.comment_id', '=', 'comments.comment_id')
      // ->groupBy( 'comments.post_id', 'comments.user_id', 'comments.content', 'comments.comment_id', 'comments.updated_at', 'comments.created_at',
      //   'comment_vote.post_id' ,'comment_vote.comment_id', 'comment_vote.vote_id', 'comment_vote.user_id', 'comment_vote.updated_at', 'comment_vote.created_at')
      // ->select('comments.*', DB::raw('COUNT(comment_vote.vote_id) AS com_count'))
      // ->get();

      $votes = DB::table('comments')
      ->leftJoin('comment_vote', 'comments.comment_id', '=', 'comment_vote.comment_id')
      ->select('comments.comment_id', DB::raw('count(comment_vote.vote_id) as vote'))
      ->groupBy('comments.comment_id')
      ->get();



      // foreach ($votes as $test) {
      //     print_r($test);
      // }

      // return;

      $user = auth()->id();
      $liked =  DB::table('likes')->select('post_id as liked_id')->where('user_id', $user)->get();
      // $voted =  DB::table('comment_vote')->select('comment_id as com_id')->where('user_id', $user)->get();

      // $comment = DB::table('comments')->get();
      $comment = DB::table('users')
      ->join('comments','users.user_id', '=', 'comments.user_id')
      ->select('users.*', 'comments.*')
      ->get();

      // dd($comment);

      $datas = [
        'info' => $datas,
        'like' => $likes,
        'liked' => $liked,
        'votes' => $votes,
        'comment' => $comment
      ];

      return view('pages.singlePost', $datas)->with(['title'=> $title]);

    }
   
}
