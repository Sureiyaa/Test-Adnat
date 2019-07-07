<?php
	session_start();
	include('conn.php');
	$id = $_SESSION['id'];
	if (isset($_GET['profile'])) 
	{
		
	}
	$sql = "SELECT * from users where id = '$id'";
	$query = mysqli_query($con,$sql);
	$search = mysqli_fetch_array($query);


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
		ul li a
		{
			margin-right: 5px;
		}
		.links a
		{
			margin-right: 5px;
		}

	</style>
</head>
<body>


	<h1><a href="first.php">Adnat</a></h1>
	<h2>Edit Profile</h2>
	<form action="edit_profile.php" method="post">

		<label>Name</label><br>
		<input type="text" name="name" value="<?php echo $search['name']; ?>" required><br><br>
		<label>Email</label><br>
		<input type="Email" name="email" value="<?php echo $search['email_address']; ?>" required><br><br>
		<label>Password</label><br>
		<input type="Password" name="password" value="<?php echo $search['password']; ?>" required><br><br>
		<button name="update">Update</button>

	</form>

</body>
</html>
<?php 
	
	if (isset($_POST['update'])) 
	{
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		if ($password<6) 
		{
			echo '<script>alert("Password is too short")</script>';
		}
		else
		{
			$sql = "UPDATE users set name = '$name', email_address = '$email', password = '$password' where id = '$id' ";
			$query = mysqli_query($con,$sql);
			if ($query) 
			{
				echo '<script>alert("Account is updated")</script>';
				echo '<script>window.location="first.php"</script>';
			}
			else
			{
				echo '<script>alert("Account was not updated")</script>';
			}
		}
	}


?>
