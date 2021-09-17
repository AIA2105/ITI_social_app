<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Hash;
use Auth;

class userController extends Controller
{
	
	
	
	public function editUser() {		
		return view('editUser');
	}
	
	
	public static function destroy(User $user)
	{
		$posts = Post::where('users_id', $user->id)->pluck('id');
		Comment::where('users_id', $user->id)->delete();
		Post::where('users_id', $user->id)->delete();
		$user->delete();
	}


    public static function changePassword($password) {}

	
    public static function register($name, $address, $gender, $email, $password) {
		$user = new User; 
		$user->name = $name; 
		$user->gender = $gender; 
		$user->address = $address;
		$user->email = $email;
		$user->password = $password; 
		$user->save(); 
		return $user;
		
	}
}
