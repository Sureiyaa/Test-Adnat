<?php 
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
			padding: 30px 0px 0px 0px;
		}
		table, th, td
		{
			border: 1px solid black;
			border-collapse: collapse;
		}
		td
		{
			padding: 5px;
			text-align: left;
		}
		input
		{
			width: 130px;
		}
		td a
		{
			padding: 5px;
			background-color: dodgerblue;
			margin: 2px;
			text-decoration: none;
			color: #fefefe;
		}
		
	

	</style>
	<link href="data/dataTables.bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="data/jquery.dataTables.min.css">
    <script src="data/jquery-3.3.1.js"></script>
    <script src="data/jquery.dataTables.min.js"></script>
</head>
<body>
	<h1><a href="first.php">Adnat</a></h1>
	<label>Logged in as <?php echo " ".$name."  "." "; ?></label><b><a href="logout.php">Log Out</a></b><br>
	<?php
		$sql = "SELECT * FROM organisations where id = '$search[organisation_id]'";
		$query = mysqli_query($con,$sql);
		$org = mysqli_fetch_array($query);
		$jid = $search['organisation_id'];





	?>
	<H2><?php echo $org['oname']?></H2>
	<b><label>Shifts</label></b>

	<table style="width: 80%;">
		<tr>
			<th style="width: 10%">Employee name</th>
			<th style="width: 10%">Shift Date</th>
			<th style="width: 10%">Start Time</th>
			<th style="width: 10%">Finish Time</th>
			<th style="width: 16%">Shifting Breaks</th>
			<th style="width: 8%">Hours Worked</th>
			<th style="width: 8%">Shift Cost</th>
		
		</tr>

		<?php
		$sql = "SELECT s.id, s.user_id, s.start, s.finish, s.break_length,s.shift_break, u.id, u.organisation_id, u.name, 
			o.id, o.oname,o.hourly_rate from users as u join shifts as s ON u.id = s.user_id left join organisations as o on u.organisation_id = o.id where u.organisation_id = '$jid'";
		$query = mysqli_query($con,$sql);
		while ($result = mysqli_fetch_array($query)) 
		{
			$time_in = new DateTime($result['start']);
			$time_out = new DateTime($result['finish']);

			if ($time_out>$time_in) 
			{
				$interval = $time_out->diff($time_in);
			}
			else
			{
				$interval = $time_in->diff($time_out);
			}
			
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}

			$break = "1";
			$hrs = $hrs - $break
			
	
			?>
			 <tr>
			 	<td><?php  echo $result['name']; ?></td>
		 		<td><?php echo date('m/d/Y', strtotime($result['start'])); ?></td>
		 		<td><?php  echo date('h:i A', strtotime($result['start']));?></td>
	 			<td><?php  echo date('h:i A', strtotime($result['finish'])); ?></td>
		 		<td><?php echo $result['shift_break'];?></td>
			 	<td><?php 	echo $hrs+$mins; ?> </td>
			 	<td><?php echo "$".($hrs+$mins) * $result['hourly_rate']; ?></td>
			 	
			</tr>

			<?php

		}
		?>
		<form method="post" action="shift.php">
			<tr>
			<td style="width: 150px;"><?php echo $name; ?></td>
			<td><input type="date" name="date0" required=""></td>
			<td><input type="time" name="start0" required=""></td>
			<td><input type="time" name="finish0" required=""></td>
			<td><select name="break0" required="">
                                    <option></option>
                                    <option value="una">08:00am-08:30am  01:00pm-01:30pm</option>
                                    <option value="pangalawa">12:00pm-12:30pm  04:00pm-04:30pm</option>
                                    <option value="pangatlo">03:00pm-03:30pm  08:00pm-08:30pm</option>
                                    
                </select>
            </td>
			<td style="border-right: none;"><input type="submit" name="submit"></td>
			<td style="border-left: none;"></td>
			
		</tr>

		</form>
	</table>

</body>
</html>
<?php
	
	if (isset($_POST['submit'])) 
	{
		$date0 = trim($_POST['date0']);
		$start0 = trim($_POST['start0']);
		$input1 = date('H:i',strtotime($start0));
		$finish0 = trim($_POST['finish0']);
		$input2 = date('H:i',strtotime($finish0));
	
		$break0 = trim($_POST['break0']);
        $time = "60";
        $break_shift ="";
        if ($break0==="una") 
        {
            $break_shift = "08:00am-08:30am  01:00pm-01:30pm";
        }
        else if ($break0==="pangalawa") {
            $break_shift = "12:00pm-12:30pm  04:00pm-04:30pm";
        }
        else if ($break0==="pangatlo") {
            $break_shift = "03:00pm-03:30pm  08:00pm-08:30pm";
        }

		$sql = "INSERT INTO shifts(user_id,start,finish,break_length,shift_break) values ('$id','$date0.$input1','$date0.$input2','$time','$break_shift')";
		$query = mysqli_query($con,$sql);
		if (!$query) 
		{
			echo '<script>alert("wala palpak")</script>';
		}
		echo '<script>window.location="shift.php"</script>';

	}

?>