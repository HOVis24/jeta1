<?php 
include_once('connection.php');
$id = $_POST["id"];
$course = $_POST["course"];
$year = $_POST["year"];
$section = $_POST["section"];
$subject = $_POST["subject_id"];
$days = implode(",", $_POST["days"]);
$time_from = date('h:i A', strtotime($_POST["time_from"]));
$time_to = date('h:i A', strtotime($_POST["time_to"]));
$room_id = $_POST["room_id"];
$teacher_id = $_POST["teacher_id"];


$sql = "UPDATE schedules SET course='$course', year='$year', section='$section', subject_id='$subject', days='$days', time_from='$time_from', time_to='$time_to', room_id='$room_id', teacher_id='$teacher_id' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}



?> 