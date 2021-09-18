@extends('layouts.app')

<?php
 use App\Http\Controllers\postController;
 $message="";
 if(isset($_GET['Message'])){
    $message= $_GET['Message'];
}
 
?>

<script>
setTimeout(function() {
    $('#mydiv').fadeOut('fast');
}, 3000); // <-- time in milliseconds
</script>

<head>
<title>All Posts</title>
</head>
@section('content')

<div class="container">			
    <div class="row justify-content-center">
        <div class="col-md-8">
			<div id="mydiv"> <p style="font-size:130%;"><?php echo $message ?></p> </div>

			@foreach ($posts as $post)
            <div class="card" style="margin-bottom: 50px;">
                <div class="card-header">
				<b>🔵 {{ postController::autherName($post->users_id) }} </b>	@ {{ $post->created_at }} <a href="/postComments/{{$post->id}}" style="float: right;"> View</a>
				
				</div>

                <div class="card-body">
				<b> {{ $post->title }} </b>
				<br>
				{{ $post->body }}
				</div>
            </div>
			@endforeach

		
        </div>
    </div>
</div>
@endsection
