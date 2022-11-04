<?php 
include_once('connection.php');
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];
$password = $_POST["password"];
$email = $_POST["email"];
$address = $_POST["address"];


$sql="SELECT * FROM customers WHERE email='$email'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "INSERT INTO customers(first_name,middle_name,last_name,password,email,address) VALUES('$first_name','$middle_name','$last_name', '$password', '$email', '$address')";
	if($con->query($sql) == TRUE){
		echo "success";
		

	} 
}

?>