<?php
	include('conn.php');  // this one in error

	if (isset($_POST['submit'])) {
		$sid = trim($_POST['txtid']);
        $shift = trim($_POST['shift']);
        $start = trim($_POST['start']);
        $input1 = date('H:i',strtotime($start));
        $finish = trim($_POST['finish']);
        $input2 = date('H:i',strtotime($finish));
        $break = trim($_POST['break']);
        $time = "60";
        $break_shift ="";
        if ($break==="una") 
        {
            $break_shift = "08:00am-08:30am  01:00pm-01:30pm";
        }
        else if ($break==="pangalawa") {
            $break_shift = "12:00pm-12:30pm  04:00pm-04:30pm";
        }
        else if ($break==="pangatlo") {
            $break_shift = "03:00pm-03:30pm  08:00pm-08:30pm";
        }

        $con->query("UPDATE shifts set start = '$shift.$input1' , finish = '$shift.$input2' , shift_break = '$break_shift'  where id = '$sid'");
    }
?>
<script>
			window.history.back();
</script>