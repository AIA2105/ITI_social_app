@extends('layouts.app')


<?php
 use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Auth;


$user_id = Auth::id();
$post_id = $post->id;
$comment = $output = ""; 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "123";
$dbname="social_app";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $dbname);

if(isset($_POST['addComment'])){
	if(!empty($_POST['comment'])){
		$comment= $_POST['comment'];
		if(! $conn ) {
			$output= 'Could not connect: ' . mysqli_error();
		}else{
			$output ="Connection Success!";
			$sql = "INSERT INTO comments (body ,posts_id, users_id, created_at) VALUES ('$comment',$post_id,'$user_id', CURRENT_TIMESTAMP);";
			$retval = mysqli_query($conn, $sql);
			if(! $retval ) {
				$output= ' ⛔ Could not enter data: ' . mysqli_error($conn);
			}else{
				
				$output= " ✅ Comment added successfully\n";
				header("Location: ../postComments/$post_id"); 
				exit();
				
			}
	
		}
		
	}else{
		$output=" ⚠ Try to write something!";
		
	}
			
}
 
 
?>

<head>
<title>Post {{$post->id}}</title>
</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			@csrf  
			@method('GET')	
            <div class="card" style="margin-bottom: 50px;">
                <div class="card-header">
				<b style="font-size:150%;"> {{ postController::autherName($post->users_id) }} </b>	@ <small style="font-size:120%;">{{ $post->created_at }}</small> 
				
				</div>

                <div class="card-body">
							
				
				<b style="font-size:150%;"> {{$post->title}}</b>
				<br>
				<small style="font-size:120%;">{{$post->body}}</small>
				</div>
            </div>
					
			<div class="form-group row" style="padding-right: 16px; padding-left: 16px;">
				<textarea id="comment" type="text" class="form-control" name="comment" autofocus> </textarea>
            </div>
			
			<div class="form-group row">
				<div class="col-md-8">
				<button type="submit" name='addComment' class="btn btn-primary">
				{{ __('Comment') }}
				</button>
				<p style="float: right;"><?php echo $output ?></p>
				</div>
			</div>

			<P style="font-size:200%; text-align:center;">Comments</P>
			@foreach ($comments as $comment)
			<div class="card" style="margin-bottom: 50px;">
                <div class="card-body">
				<b> {{ postController::autherName($comment->users_id) }}</b> @ {{ $comment->created_at }}
				<br>
				{{$comment->body}}
				</div>
            </div>
			@endforeach
		</form>
        </div>
    </div>
</div>
@endsection
