<?php 
session_start();
$id = $_SESSION['id'];
$jid = "";
include('conn.php');
if (isset($_GET['join'])) 
{
  $jid = $_GET['join'];
	$sql = "update users set organisation_id = '$jid' where id = '$id'";
	$query = mysqli_query($con,$sql);
	header("location: first.php");
	$_SESSION['jid'] = $jid;
}
?>