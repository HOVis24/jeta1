<?php 
include_once('connection.php');
$course = $_POST["course"];
$year = $_POST["year"];
$section = $_POST["section"];

$sql="SELECT * FROM sections WHERE course_id='$course' AND year='$year' AND section='$section'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "INSERT INTO sections(course_id,year,section) VALUES('$course','$year','$section')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}


?>