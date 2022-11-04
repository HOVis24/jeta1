<?php 
include_once('connection.php');
$id = $_POST["id"];
$room_no = $_POST["room_no"];
$department = $_POST["department"];
$floor = $_POST["floor"];

$sql="SELECT * FROM rooms WHERE room_no='$room_no' AND department='$department' AND floor='$floor'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "UPDATE rooms SET room_no='$room_no', department='$department', floor='$floor' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}



?>