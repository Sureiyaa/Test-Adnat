<?php

include('conn.php'); 
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT s.id, s.user_id, s.start, s.finish, s.break_length, u.id, u.organisation_id, u.name, 
            o.id, o.oname,o.hourly_rate from users as u join shifts as s ON u.id = s.user_id left join organisations as o on u.organisation_id = o.id WHERE s.id = $id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_name=$row[7];
        $per_shift=date('m/d/Y', strtotime($row['start']));
        $per_start=date('h:i A', strtotime($row['start']));
        $per_finish=date('h:i A', strtotime($row['finish']));
        $per_break=$row[4];
    }

    ?>
    <form class="form-horizontal" method="post" action="editshiftfunction.php">
        <div class="modal-content" style="background-color: #fefefe; color: #000">
            <div class="modal-header">
                <h4 class="modal-title">Edit Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
            <center>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtid">ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="lastname">Shift</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="shift" name="shift" value="<?php echo $per_shift;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="start">Start</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="start" name="start" value="<?php echo $per_start;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="finish">Finish</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="finish" name="finish" value="<?php echo $per_finish;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="break">Shifting Break</label>
                            <div class="col-sm-8">
                                <select name="break" required="">
                                    <option></option>
                                    <option value="una">08:00am-08:30am  01:00pm-01:30pm</option>
                                    <option value="pangalawa">12:00pm-12:30pm  04:00pm-04:30pm</option>
                                    <option value="pangatlo">03:00pm-03:30pm  08:00pm-08:30pm</option>
                                    
                                </select>
                            </div>
                        </div>
                       
                        <br>
                         <input type="submit" name="submit" value="Submit" class="btn btn-primary col-sm-5">
                    </div>
                    </div>
                </form>
                </center>
            </div>
        </div>
    </form>
<?php
}//end if ?>
<?php 
   
?>





