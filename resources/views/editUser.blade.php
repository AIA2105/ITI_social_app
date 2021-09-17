@extends('layouts.app')
<head>
<title>Edit User</title>
</head>


   <?php
   use Illuminate\Support\Facades\Auth;
   use App\Http\Controllers\userController;

   $user_id = Auth::id();
   $name = $address = $gender = $email= ""; 
   $output= $output2 = $output3 ="";
   $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "123";
	$dbname="social_app";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $dbname);

	if(isset($_POST['update'])){
		
		if (Hash::check($_POST['password_confirmation'], Auth::user()->password )) {
			$output= " ✅ password is correct\n";
			
			$name = $_POST['name'];
			$address = $_POST['address'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			
			if(! $conn ) {
			$output= 'Could not connect: ' . mysqli_error();
			}else{
				$output ="Connection Success!";
				$sql = "UPDATE users SET name= '$name' , address= '$address' , gender= '$gender' , email= '$email' , updated_at= CURRENT_TIMESTAMP WHERE id=$user_id;";
				$retval = mysqli_query($conn, $sql);
				if(! $retval ) {
					$output= ' ⛔ Could not enter data: ' . mysqli_error($conn);
				}else{
					
					$output= " ✅ Changed Successfully\n";
					
					header("Location: http://127.0.0.1:8000/allPosts"); 
					exit();		
				}

		}
	
			
		}else{
			$output= " ⛔ password is not correct\n";
		}
				
	}
	
	
	if(isset($_POST['delete'])){
		
		if (Hash::check($_POST['delete_password'], Auth::user()->password )) {
			$output3= " ✅ password is correct\n";
			
			if(! $conn ) {
			$output3= 'Could not connect: ' . mysqli_error();
			}else{
				$output3 ="Connection Success!";
				userController::destroy(Auth::user());
					
					$output3= " ✅ Deleted Successfully\n";
					
					header("Location: http://127.0.0.1:8000/"); 
					exit();		


		}
	
			
		}else{
			$output3= " ⛔ password is not correct\n";
		}
				
	}	
	
			   
   ?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                        @csrf
						@method('GET')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::user()->address }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						
						
						
						<div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('gender') }}</label>

                            <div class="col-md-6">
								<select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" >

									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name='update' class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
								<p><?php echo $output ?></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
				
        </div>
    </div>
</div>

<div style="padding-bottom:50px;"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password</div>
   
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
								@foreach ($errors->all() as $error)
								<p class="text-danger">{{ $error }}</p>
								@endforeach 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="padding-bottom:50px;"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete Account & Data</div>
   
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        @csrf 
   						@method('GET')
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
  
                            <div class="col-md-6">
                                <input id="delete_password" type="password" class="form-control" name="delete_password" autocomplete="delete_password">
                            </div>
                        </div>
  
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="delete">
                                    Delete
                                </button>
								<p><?php echo $output3 ?></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

