<?php 
include_once('connection.php');
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
	$sql = "INSERT INTO subjects(subject_code,subject_description) VALUES('$subject_code','$subject_description')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}


?>