<?php 
include_once('connection.php');
$id = $_POST["id"];
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];



$sql="SELECT * FROM customers WHERE id='$id' AND password = '$confirm_password'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	$sql = "UPDATE customers SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email' , password='$password' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}
else
{
	echo "error";
}


?>