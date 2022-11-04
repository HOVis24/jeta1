<?php 
include_once('connection.php');
$id = $_POST["id"];
$course_id = $_POST["course_id"];
$year = $_POST["year"];
$section = $_POST["section"];

$sql="SELECT * FROM sections WHERE course_id='$course_id' AND year='$year' AND section='$section'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "UPDATE sections SET course_id='$course_id', year='$year', section='$section' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}


?>