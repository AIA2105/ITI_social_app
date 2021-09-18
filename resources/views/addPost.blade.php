@extends('layouts.app')

                       <?php
					   use Illuminate\Support\Facades\Auth;
					   $user_id = Auth::id();
					   $title = $body = ""; 
					   $output="";
					   $dbhost = "localhost";
						$dbuser = "root";
						$dbpass = "123";
						$dbname="social_app";
						$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $dbname);
					
						if(isset($_POST['addPost'])){
							if(!empty($_POST['title']) && !empty($_POST['body'])){
								$title= $_POST['title'];
								$body= $_POST['body'];
								if(! $conn ) {
									$output= 'Could not connect: ' . mysqli_error();
								}else{
									$output ="Connection Success!";
									$sql = "INSERT INTO posts (title ,body, users_id, created_at) VALUES ('$title','$body','$user_id', CURRENT_TIMESTAMP);";
									$retval = mysqli_query($conn, $sql);
									if(! $retval ) {
										$output= ' ⛔ Could not enter data: ' . mysqli_error($conn);
									}else{
										
										$output= " ✅ Post added successfully\n";
										$Message = urlencode(" 🟢  Posted Successfully\n ");
										header("Location: http://127.0.0.1:8000/allPosts?Message=$Message"); 
										exit();	
									}
							
								}
								
							}else{
								$output=" ⚠ Try to write something!";
								
							}
									
						}
								   
					   ?>

<head>
<title>Add New Post</title>
</head>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Post') }}</div>

                <div class="card-body">
				
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                        @csrf  
						@method('GET')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" autofocus>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body" style="height:300px;"> </textarea>

                              
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" name='addPost' class="btn btn-primary">
                                    {{ __('Share Now') }}
                                </button>

                          
                            </div>
						
                    </form>
                </div>
            </div>
			<p><?php echo $output ?></p>
        </div>
    </div>
</div>
@endsection
