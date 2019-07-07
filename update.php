<?php 
session_start();
$id = "";
$oid ="";
if (isset($_GET['update'])) 
{
  $oid = $_GET['update'];
  $_SESSION['oid'] = $oid;
}
  $id = $_SESSION['id'];
  include('conn.php');
  $sql = "SELECT * FROM users where id = '$id'";
  $query = mysqli_query($con,$sql);
  $search = mysqli_fetch_array($query);
  $name = $search['name'];
  $sql = "SELECT * FROM organisations where id = '$oid'";
  $query = mysqli_query($con,$sql);
  $fetch = mysqli_fetch_array($query);
  $oid = $_SESSION['oid'];
if (isset($_POST['update'])) 
{
  $oname = trim($_POST['name']);
  $rate = trim($_POST['rate']);
  $oid = $_SESSION['oid'];
  $sql = "UPDATE organisations set oname = '$oname', hourly_rate = '$rate' where id = '$oid'";
  $query = mysqli_query($con,$sql);
  echo '<script>window.location="first.php"</script>';
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
  <h1><a href="first.php">Adnat</a></h1>
  <label>Logged in as <?php echo " ".$name."  "." "; ?></label><b><a href="logout.php">Log Out</a></b><br>
  <h2>Edit Organisation</h2>
  <form method="post" action="update.php">
	<label>Name</label><input type="text" name="name" value="<?php echo $fetch['oname']; ?>"><br>
	<label>Hourly Rate:$ </label><input type="number" name="rate" value="<?php echo $fetch['hourly_rate'];?>"><label>per hour</label><br>
	<button name="update">Update</button><br>
	<a href="delete.php?delete=<?php echo $oid; ?>" name="delete">Delete</a>
  </form>
</body>
</html>