<?php
session_start();
include('conn.php');
$did = "";
if (isset($_GET['delete'])) 
{
	$did = $_GET['delete'];

}
	
	$sql = "DELETE from organisations where id = '$did'";
	$query = mysqli_query($con,$sql);

	header("location:first.php");

	$sql = "SELECT * from users where id = '$_SESSION[id]'";
	$query = mysqli_query($con,$sql);
	$fetch = mysqli_fetch_array($query);
	if ($fetch['organisation_id']>0) 
	{
		$sql = "UPDATE users set organisation_id = '0' where id = '$_SESSION[id]'";
		$query = mysqli_query($con,$sql);

		echo '<script>window.location="first.php"</script>';
	}

?>