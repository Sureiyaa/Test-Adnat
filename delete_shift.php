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
     
    }

    ?>
    <form class="form-horizontal" method="post" action="deleteshiftfunction.php" style="color: #000">
        <div class="modal-content" style="background-color: #fefefe">
            <div class="modal-header">
                
                <h4 class="modal-title">Delete Record?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="box-body"> 
                    <center>
                    	<div class="form-group">
                            <label class="col-sm-4 control-label" for="txtid">ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly style="text-align: center;">
                            </div>
                        </div>    
                        <div class="form-group">
                            <p>Are you sure you want to delete </p><p style="text-transform: capitalize;"><?php echo $per_name; ?></p>
                        </div>
                        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>  Cancel</i></button>
                        <button type="submit" name="submit" class="btn btn-danger " ><i class="fas fa-trash-alt">   Delete </i></button>
                        
                    </center>
                    </div>
                </form>
            </div>
        </div>
    </form>
<?php
}//end if ?>
<?php 
   
?>





