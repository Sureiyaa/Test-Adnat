<?php
session_start();
include('conn.php'); 
$id = $_SESSION['id'];
$sql = "SELECT * FROM users where id = '$id'";
$query = mysqli_query($con,$sql);
$search = mysqli_fetch_array($query);

$sql = "SELECT * FROM organisations where id = '$search[organisation_id]'";
$query = mysqli_query($con,$sql);
$org = mysqli_fetch_array($query);
$jid = $search['organisation_id'];

?>
    <form class="form-horizontal" method="post" action="addshiftfunction.php">
        <div class="modal-content" style="background-color: #fefefe; color: #000">
            <div class="modal-header">
                <h4 class="modal-title">Add Shift</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
            <center>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo $id ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="lastname">Shift</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="shift" name="shift" required="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="start">Start</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="start" name="start" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="finish">Finish</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="finish" name="finish" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="break">Break Shifts</label>
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






