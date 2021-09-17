<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Comment;
use App\User;
use Auth;

class postController extends Controller
{
    
	
	
	public function addPost() {
		return view('addPost');
	}
	
	
	public static function allPosts()
    {
        $posts = Post::all()->sortByDesc("created_at");
		return view('allPosts')->with('posts',$posts);
    } 
	
	public static function myPosts()
    {
        $posts = Post::all()->where('users_id', Auth::user()->id)->sortByDesc("created_at");
		return view('myPosts')->with('posts',$posts);
    } 
	
	public function postComments($postId)
    {
        $post = Post::find($postId);
		$comments =  Comment::select('users_id','body','created_at')->where('posts_id', $post -> id)->get()->sortByDesc("created_at");
		
		return view('postComments')->with('post',$post) ->with('comments',$comments);
	}
	
	
	public static function autherName($autherId)
    {
        $auther= User::find($autherId);
		return $auther->name;
    }
	
	
}
