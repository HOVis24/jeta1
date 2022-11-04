<?php 
include_once('connection.php');
$id = $_POST["id"];
$course_name = $_POST["course_name"];
$course_description = $_POST["course_description"];

$sql="SELECT * FROM courses WHERE course_name='$course_name' AND course_description='$course_description'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "UPDATE courses SET course_name='$course_name', course_description='$course_description' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}


?>