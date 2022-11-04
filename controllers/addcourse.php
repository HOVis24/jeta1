<?php 
include_once('connection.php');
$course_name = $_POST["course_name"];
$course_description = $_POST["course_description"];

$sql="SELECT * FROM courses WHERE course_name='$course_name'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "studentno error"; 
}

else
{
	$sql = "INSERT INTO courses(course_name,course_description) VALUES('$course_name','$course_description')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}

?>