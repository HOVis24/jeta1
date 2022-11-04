<?php 
include_once('connection.php');
$id = $_POST["edit_id"];
$first_name = $_POST["edit_first_name"];
$middle_name = $_POST["edit_middle_name"];
$last_name = $_POST["edit_last_name"];
$email = $_POST["edit_email"];
$password = $_POST["edit_password"];
$confirm_password = $_POST["confirm_password"];
$table = $_POST["table"];



$sql="SELECT * FROM $table WHERE id='$id' AND password = '$confirm_password'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	$sql = "UPDATE $table SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email' , password='$password' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}
else
{
	echo "error";
}


?>