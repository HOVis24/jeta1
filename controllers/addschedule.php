<?php 
include_once('connection.php');
$course= $_POST['course'];
$year = $_POST["year"];
$section = $_POST["section"];
$subject_id = $_POST["subject_id"];
$days = implode(",", $_POST["days"]);
$time_from = date('h:i A', strtotime($_POST["time_from"]));
$time_to = date('h:i A', strtotime($_POST["time_to"]));
$room_id = $_POST["room_id"];
$teacher_id = $_POST["teacher_id"];

$sql="SELECT * FROM schedules WHERE course='$course' AND year='$year' AND section='$section' AND subject_id='$subject_id'";
$result=mysqli_query($con,$sql);
$subjectCount=mysqli_num_rows($result);
mysqli_free_result($result);

$sql="SELECT * FROM schedules WHERE (course='$course' AND year='$year' AND section='$section' 
AND days REGEXP '$days')
AND 
(STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p')
BETWEEN STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
OR
STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
BETWEEN STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p'))";
$result=mysqli_query($con,$sql);
$dayTimeCount=mysqli_num_rows($result);
mysqli_free_result($result);

$sql="SELECT * FROM schedules WHERE (room_id='$room_id'
AND days REGEXP '$days')
AND 
(STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p')
BETWEEN STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
OR
STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
BETWEEN STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p'))";
$result=mysqli_query($con,$sql);
$timeRoomCount=mysqli_num_rows($result);
mysqli_free_result($result);

$sql="SELECT * FROM schedules WHERE (teacher_id='$teacher_id'
AND days REGEXP '$days')
AND 
(STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p')
BETWEEN STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
OR
STR_TO_DATE(time_from, '%l:%i %p' ) AND STR_TO_DATE(time_to, '%l:%i %p' )
BETWEEN STR_TO_DATE('$time_from', '%l:%i %p') AND STR_TO_DATE('$time_to', '%l:%i %p'))";
$result=mysqli_query($con,$sql);
$teacherSchedCount=mysqli_num_rows($result);
mysqli_free_result($result);

if ($subjectCount >= 1) {
	echo "subject";
}
elseif ($dayTimeCount > 0) {
	echo "daytime";
}
elseif ($timeRoomCount > 0) {
	echo "room";
}
elseif ($teacherSchedCount > 0) {
	echo "teacher";
}
else
{
	$days = implode(",", $_POST["days"]);
	$sql = "INSERT INTO schedules(course,year,section,subject_id,days,time_from,time_to,room_id,teacher_id) VALUES('$course','$year','$section','$subject_id','$days','$time_from','$time_to','$room_id','$teacher_id')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}

?>