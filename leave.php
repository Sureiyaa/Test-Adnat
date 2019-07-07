<?php
  session_start();
  $id = $_SESSION['id'];
  include('conn.php');

  $sql = "update users set organisation_id = '0' where id = '$id'";
  $query = mysqli_query($con,$sql);
  header("location: first.php");

?>
