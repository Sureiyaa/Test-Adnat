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

$request=$_REQUEST;
$col =array(
  0   => ' s.id',
  1   =>  's.user_id',
  2   =>  's.start',
  3   =>  's.finish',
  4   =>  's.shift_break',
  5   =>  'u.id',
  6   =>  'u.organisation_id',
  7   =>  'u.name',
  8   =>  'o.id',
  9   =>  'o.oname',
  10   =>  'o.hourly_rate'
);  
$sql ="SELECT s.id, s.user_id, s.start, s.finish, s.shift_break, 
              u.id, u.organisation_id, u.name, 
              o.id, o.oname,o.hourly_rate from users as u 
              join shifts as s ON u.id = s.user_id 
              left join organisations as o on u.organisation_id = o.id 
              where u.organisation_id = '$jid'";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;


$sql = "SELECT s.id, s.user_id, s.start, s.finish, s.shift_break, 
               u.id, u.organisation_id, u.name, 
               o.id, o.oname,o.hourly_rate from users as u 
               join shifts as s ON u.id = s.user_id 
               left join organisations as o on u.organisation_id = o.id 
               where u.organisation_id = '$jid' and 1=1";
if(!empty($request['search']['value']))
{
  $sql.=" AND (s.id Like '".$request['search']['value']."%' ";
  $sql.=" OR s.user_id Like '".$request['search']['value']."%' ";
  $sql.=" OR s.start Like '".$request['search']['value']."%' ";
  $sql.=" OR s.finish Like '".$request['search']['value']."%' ";
  $sql.=" OR s.shift_break Like '".$request['search']['value']."%' ";
  $sql.=" OR u.id Like '".$request['search']['value']."%' ";
  $sql.=" OR u.organisation_id Like '".$request['search']['value']."%' ";
  $sql.=" OR u.name Like '".$request['search']['value']."%' ";
  $sql.=" OR o.id Like '".$request['search']['value']."%' ";
  $sql.=" OR o.oname Like '".$request['search']['value']."%' ";
  $sql.=" OR o.hourly_rate Like '".$request['search']['value']."%' ) ";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']].
     "   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();

while($row=mysqli_fetch_array($query))
{
  $time_in = new DateTime($row['start']);
  $time_out = new DateTime($row['finish']);
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
  if($int > 4)
  {
    $int = $int - 1;
  }
  $break = "1";       
  $hrs = $hrs - $break;

  $subdata=array();
  $subdata[]=$row[0]; //id
  $subdata[]=$row[7]; //name
  $subdata[]=date('m/d/Y', strtotime($row['start'])); //salary
  $subdata[]=date('h:i A', strtotime($row['start']));
  $subdata[]=date('h:i A', strtotime($row['finish']));
  $subdata[]=$row[4];
  $subdata[]= $hrs+$mins;; 
  $subdata[]="$".($hrs+$mins) * $row['hourly_rate'];
  $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'">
            <i class="fa fa-edit">&nbsp;</i>Edit</button>
              <button type="button" id="getDelete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'>
              <i class="fa fa-trash">&nbsp;</i>Delete</button>';
  $data[]=$subdata;
}
$json_data=array(
  "draw"              =>  intval($request['draw']),
  "recordsTotal"      =>  intval($totalData),
  "recordsFiltered"   =>  intval($totalFilter),
  "data"              =>  $data
);
echo json_encode($json_data);
?>

