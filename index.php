<?php 
	session_start();
	if (isset($_SESSION['id'])) 
	{
		header("location:first.php");
		
	}

?>
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

<form method="post" action="index.php">
		<h1><a href="">Adnat</a></h1>
		<h3>Login</h3>
		<label>Email</label><br>
		<input type="email" name="email" required="">
		<br><br>
		<label>Password</label><br>
		<input type="password" name="password"><br><br>
		<input type="checkbox" name=""><br>
		<label>Remember Me</label><br><br>
		<button name="login">Login</button><br>
		<a href="signup.php">Sign Up</a><br>
		<a href="#">Forget your password?</a>
	</form>

</body>
</html>
<?php
 
include('conn.php');

if (isset($_POST['login'])) 
{
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	$sql = "SELECT * from users where email_address = '$email' and password = '$password'";
	$query = mysqli_query($con,$sql);
	$search = mysqli_fetch_array($query);

	if (mysqli_num_rows($query)>0) 
	{
		$_SESSION['id'] = $search['id'];
		echo '<script>alert("welcome'." ". $search['name'] .' ")</script>';
		echo '<script>window.location="first.php"</script>';
	}
	else
	{
		echo '<script>alert("Incorrect email or password ")</script>';
	}


}

?>



