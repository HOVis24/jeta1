<?php 
require_once('connection.php');
$error = "";
session_start();
$GET['url'] = basename($_SERVER['PHP_SELF']);

$title = $_POST['title'];
$start_date = $_POST['start_date'];
$start_time = date('h:i A', strtotime($_POST["start_time"]));
$end_date = $_POST['end_date'];
$end_time = date('h:i A', strtotime($_POST["end_time"]));;
$description = $_POST['description'];
$schedule_id = $_POST['schedule_id'];

$sqll = "INSERT INTO activities(title,start_date,start_time,end_date,end_time,description,teacher_id,schedule_id,type) VALUES('$title','$start_date','$start_time','$end_date','$end_time','$description','".$_SESSION["id"]."','$schedule_id','Quiz')";
if($con->query($sqll) == TRUE){
  echo "success";
}
else
{

 echo "error";
}

?>