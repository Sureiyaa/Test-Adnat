<!DOCTYPE html>
<html>
<head>
	<title>Test Ruby</title>
	<style type="text/css">
		body
		{
			padding: 30px 0px 0px 100px;
		}
	</style>
</head>
<body>

<form method="post" action="signup.php">
		<h1><a href="">Adnat</a></h1>
		<h3>Sign Up</h3>
		<label>Name</label><br>
		<input type="text" name="name" required="">
		<br><br>
		<label>Email</label><br>
		<input type="email" name="email" required="">
		<br><br>
		<label>Password</label><br>
		<label>(6 characters minimum)</label><br>
		<input type="password" name="password"><br><br>
		<label>Confirm Password</label><br>
		<input type="password" name="repassword"><br><br>
		
		<button name="sign">Sign up</button><br>
		<a href="index.php">Login</a><br>
		
	</form>

</body>
</html>
<?php
	include('conn.php');

	if (isset($_POST['sign'])) 
{
	
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$repassword = trim($_POST['repassword']);


	$sql = "SELECT * from users where email_address = '$email'";
	$query = mysqli_query($con,$sql);
	
	if ($rows = mysqli_num_rows($query)>0) 
	{
		echo '<script>alert("Email is already registered with an account.")</script>';
		die();
	}
	
	if (strlen($password)<6) 
	{
		echo '<script>alert("Password is too short")</script>';
		die();
	}
	if ($password === $repassword) 
	{
		$sql = "INSERT INTO users(organisation_id,name,email_address,password) values ('0','$name','$email','$password')";
		$query = mysqli_query($con,$sql);
				

		if ($query) 
		{
			
			echo '<script>alert("sign up successful")</script>';
			echo '<script>window.location="index.php"</script>';
		}
		else
		{
			echo '<script>alert("sign up not success")</script>';
		}
	}
	else
	{
		echo '<script>alert("Confirm password does not match")</script>';
	}	
	




}


?>