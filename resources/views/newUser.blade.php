		<?php
		
		use \App\Http\Controllers\userController;
		
         // define variables and set to empty values
          $nameErr = $genderErr = $addressErr = $emailErr = $passwordErr = $confirm_passwordErr = $acceptErr =""; 
          $name = $gender = $address = $email = $password = $confirm_password = $accept = $output=" ";
		  $welcome=true;
		  
		  function test_input($data) {
			  $data = trim($data);
			  $data = stripslashes($data);
			  $data = htmlspecialchars($data);
			  return $data;
			}

		if (empty($_GET["name"])) {
		   $nameErr = "Name is required";
		   $welcome=false;
		}else {
		   $name = test_input($_GET["name"]);
	    }
			
		if (empty($_GET["address"])) {
		   $addressErr = "Address is required";
		   $welcome=false;
		}else {
		   $address= test_input($_GET["address"]);
		}
		
		if (empty($_GET["gender"])) {
		   $genderErr = "Gender is required";
		   $welcome=false;
		}else {
		   $gender= test_input($_GET["gender"]);
		}
		
		 if (empty($_GET["email"])) {
		   $emailErr = "Email is required";
		   $welcome=false;
		}else {
		   $email = test_input($_GET["email"]);
		}
		
		 if (empty($_GET["password"])) {
		   $passwordErr = "Password is required";
		   $welcome=false;
		}else {
		   $password = $_GET["password"];
		}
		
		if (empty($_GET["confirm_password"])) {
		   $confirm_passwordErr = "Password is required";
		   $welcome=false;
		}else if($_GET["password"] != $_GET["confirm_password"]){
			$confirm_passwordErr = "Passwords are not identical";
		}else {
		   $confirm_password = $_GET["confirm_password"];
		}
		
		
		if (empty($_GET["accept"])) {
			$acceptErr = "Acceptance is required";
			$welcome=false;
		}else if($_GET["accept"]=="accept"){
			$accept="ok";
		}
		
		
		$output = "";
			
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "123";
			$dbname="social_app";
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $dbname);
		
		
		if($welcome){
			
			if(! $conn ) {
					die('Could not connect: ' . mysqli_error());
		    }else{
				$output ="Connection Success!";
				if(isset($_GET['Add'])){
					
					//userController::register($name, $address, $gender, $email, $password);
					return view('allPosts');
					
				}
							
			}
			
	
		}
		
		
		if (isset($_GET['login'])) {
			return view('welcome');
		}
		
		
		
		?>


    
			<form method="GET" >  
			
			<table cellspacing="15">
		  

			 <tr>
				<td>Name</td>
				<td><input type="text" name="name" style="width:200px" ></td>
				<td><?php echo $nameErr ?></td>	 
			 </tr>
		  
			  <tr>
				<td>Gender</td>
				<td><input type="radio" name="gender" value="male"><span style="padding-right:60px;">Male</span>
				<input type="radio" name="gender" value="male">Female
				</td>
				<td><?php echo $genderErr ?></td>
			  </tr>	

			  <tr>
				<td>Address</td>
				<td><input type="text" name="address" style="width:200px" ></td>
				<td><?php echo $addressErr ?></td>
			  </tr>
			  
			  <tr>
				<td>Email</td>
				<td><input type="email" name="email" style="width:200px;"> </input></td>
				<td><?php echo $emailErr ?></td>
			  </tr>
			  
			  <tr>
				<td>Password</td>
				<td><input type="password" name="password" style="width:200px;"> </input></td>
				<td><?php echo $passwordErr ?></td>
			  </tr>	

			  <tr>
				<td>Confirm Password</td>
				<td><input type="password" name="confirm_password" style="width:200px;"> </input></td>
				<td><?php echo $confirm_passwordErr ?></td>
			  </tr>				  

				
			  <tr>
			  <td>
				</td>
				<td>
				 <input type="checkbox" name="accept" value="accept">I accept the terms and privacy policy.
				</td>
				<td><?php echo $acceptErr ?></td>
			  </tr>
			  
			  
			  <tr></tr>
			  
			  <tr>
				<td> </td>
				<td>
				  <span style="padding-right:20px;">
					<input name = "Add" type = "submit" id = "add" value = "SignUp" style="width:130px">
				  </span>
				  <span style="padding-right:20px;">
					<input name = "login" type = "submit" id = "login" value = "login">
				  </span>					  
				</td>
			  </tr>
		  
			</table>
			
			<p><?php echo $output ?></p>
			
		</form>
	
	





