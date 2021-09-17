@extends('layouts.app')

<?php
 use App\Http\Controllers\postController;
?>


<head>
<title>All Posts</title>
</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			
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
