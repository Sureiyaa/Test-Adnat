<?php


include('conn.php');

$sql = "SELECT * from shifts where id = '2'";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);

echo  $result['final'];
$tis = $result['start'] - $result['final'];
echo $tis;

$date1 = date('h:i A', strtotime($result['start']));
 echo $date1;
// ?><br><?php
// $date2 = date('h:i A', strtotime($result['finish']));
// echo $date2;


?>
<br><br>
<?php
$time_in = new DateTime($result['start']);
$time_out = new DateTime($result['finish']);
$interval = $time_in->diff($time_out);
$hrs = $interval->format('%h');
$mins = $interval->format('%i');
$mins = $mins/60;
$int = $hrs + $mins;
if($int > 4){
	$int = $int - 1;
}
echo $hrs." " . $mins ;







?>

