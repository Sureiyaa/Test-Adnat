<?php
include('conn.php');  // this one in error

	
if (isset($_POST['submit'])) 
{
  $sid = trim($_POST['txtid']);
  mysqli_query($con,"DELETE from shifts where id='$sid'");
}

?>
<script>
  window.alert('Shift deleted successfully!');
  window.history.back();
</script>


