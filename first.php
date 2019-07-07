<?php 
	$name = "";

	session_start();
	if (!isset($_SESSION['id'])) 
	{
		header("location:index.php");
		
	}
	$id = $_SESSION['id'];
		include('conn.php');
		$sql = "SELECT * FROM users where id = '$id'";
		$query = mysqli_query($con,$sql);
		$search = mysqli_fetch_array($query);
		
		$name = $search['name'];

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
		.new
		{
			text-decoration: none;
			color: #fefefe;
			font-size: 18px;
			background-color: #007bff;
			border-color: #007bff;
			border-radius: 5px;
			padding: 13px;

		}
		.new:hover
		{
			background-color: #707bff;
		}

	</style>
</head>
<body>


	<h1><a href="">Adnat</a></h1>
	<label>Logged in as <?php echo " ".$name."  "." "; ?></label>
	<b><a href="edit_profile.php?profile=<?php echo $id ?>" name="profile">Edit Profile</a></b>
	<b><a href="logout.php">Log Out</a></b><br>

	<?php 
	if($search['organisation_id']>0)
	{
		$sql = "SELECT * FROM organisations where id = '$search[organisation_id]'";
		$query = mysqli_query($con,$sql);
		$org = mysqli_fetch_array($query);
		$jid = $search['organisation_id'];

		?>

			<H2><?php echo $org['oname']?></H2>
			<div class="links">
				<a href="shift.php?view=<?php echo $jid;?>" name="shifts">View Shifts</a>
				<a href="edit.php?edit=<?php echo $jid;?>" name="edit">Edit</a>
				<a href="leave.php" name="leave">Leave</a><br><br><br><br><br><br>
				<a class="new" href="shift_framework.php">View Shifts (with use of datatable plugin)</a>
			</div>




		<?php
	}
	else
	{
		?>
			<label>You aren't a member of any organisations. Join an existing one or create a new one.</label><br><br>
			<h2>Organisations</h2>

			<ul>
				<?php 
				$sql = "SELECT * FROM organisations";
				$query = mysqli_query($con,$sql);
				while ($row = mysqli_fetch_array($query)) 
				{
					?>	
						<li><?php echo $row['oname'];  ?>
							<input type="hidden" name="id" value="<?php echo $row['id'] ?>"> 
							<a href="update.php?update=<?php echo $row['id']; ?>" name="update">Edit</a>
							<a href="join.php?join=<?php echo $row['id']; ?>" name="join">Join</a>
						</li>
					<?php
				}

				?>
			</ul>



			<h2>Create organisation</h2>

			<form method="post" action="first.php">
				<label>Name</label>
				<input type="text" name="name" required="">
				<br>
				<label>Hourly rate: $</label>
				<input type="number" name="hourly_rate"><br>
			
				<button name="create">Create and Join</button><br>
			
			</form>



		<?php
	}



	if (isset($_POST['create'])) 
	{
		$name = trim($_POST['name']);
		$hourly_rate = trim($_POST['hourly_rate']);

		$sql = "INSERT INTO organisations(oname,hourly_rate) values ('$name','$hourly_rate')";
		$query = mysqli_query($con,$sql);
		if ($query) 
		{
			echo '<script>alert("Organisation created successfully")</script>';
			echo '<script>window.location="first.php"</script>';
		}
		else
		{
			echo '<script>alert("Organisation not created")</script>';
		}
	}


	if (isset($_POST['update'])) 
	{
		$_SESSION['oid'] = $_GET['id'];
		echo '<script>window.location="update.php"</script>';
	}

	?>


	

</body>
</html>