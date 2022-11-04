<?php 
include_once('connection.php');
$id = $_POST["id"];
$subject_code = $_POST["subject_code"];
$subject_description = $_POST["subject_description"];

$sql="SELECT * FROM subjects WHERE subject_code='$subject_code'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "UPDATE subjects SET subject_code='$subject_code', subject_description='$subject_description' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}


?>