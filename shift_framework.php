<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/dataTables.bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
</head>
<body>
<div id="wrapper" style="margin-top: 50px;">
<div id="page-wrapper" >
<div class="container-fluid">
<div class="row">
  <div class="col-lg-12" style="margin-bottom: 3%">
    <h1 style="margin-bottom: 30px; font-weight: 700"><a href="first.php">Adnat</a></h1>
    <h2 class="page-header"><i class="fa fa-users w3-xxxlarge"></i>  <b>Shifts</b>
	  <span class="pull-right">
		<button type="button" id="getAdd" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'"><i class="fa fa-edit">&nbsp;</i>Add Shifts</button>
	  </span>
	</h2>
  </div>
</div>
  <table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
      <th>ID</th>
      <th >Employee name</th>
	  <th >Shift Date</th>
	  <th >Start Time</th>
	  <th >Finish Time</th>
	  <th >Shifting Breaks</th>
	  <th >Hours Worked</th>
	  <th >Shift Cost</th>
	  <th>Action</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
      <th>ID</th>
      <th >Employee name</th>
	  <th >Shift Date</th>
	  <th >Start Time</th>
	  <th >Finish Time</th>
	  <th >Shifting Breaks</th>
	  <th >Hours Worked</th>
	  <th >Shift Cost</th>
	  <th>Action</th>
    </tr>
    </tfoot>
  </table>

        <!--create modal dialog for display detail info for edit on button cell click-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div id="content-data"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var dataTable=$('#example').DataTable({
      "processing": true,
      "serverSide":true,
      "ajax":{
        url:"fetchshift.php",
        type:"post"
      }
    });
  });
</script>
<script>
  $(document).on('click','#getEdit',function(e){
    e.preventDefault();
    var per_id=$(this).data('id');
    //alert(per_id);
    $('#content-data').html('');
    $.ajax({
      url:'editshift.php',
      type:'POST',
      data:'id='+per_id,
      dataType:'html'
    }).done(function(data){
      $('#content-data').html('');
      $('#content-data').html(data);
    }).fail(function(){
      $('#content-data').html('<p>Error</p>');
    });
  });
</script>
<script>
  $(document).on('click','#getAdd',function(e){
    e.preventDefault();
    var per_id=$(this).data('id');
            //alert(per_id);
    $('#content-data').html('');
    $.ajax({
      url:'addshift.php',
      type:'POST',
      data:'id='+per_id,
      dataType:'html'
    }).done(function(data){
      $('#content-data').html('');
      $('#content-data').html(data);
    }).fail(function(){
      $('#content-data').html('<p>Error</p>');
    });
  });
</script>
<script>
  $(document).on('click','#getDelete',function(e){
    e.preventDefault();
    var per_id=$(this).data('id');
            //alert(per_id);
    $('#content-data').html('');
    $.ajax({
      url:'delete_shift.php',
      type:'POST',
      data:'id='+per_id,
      dataType:'html'
    }).done(function(data){
      $('#content-data').html('');
      $('#content-data').html(data);
    }).fail(function(){
      $('#content-data').html('<p>Error</p>');
    });
  });
</script>
</div>
<script src="css/custom.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>