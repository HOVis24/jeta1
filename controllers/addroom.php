<?php 
include_once('connection.php');
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
	$sql = "INSERT INTO rooms(room_no,department,floor) VALUES('$room_no','$department','$floor')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}



?>