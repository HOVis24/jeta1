<?php 
include_once('connection.php');

session_start();

$store_name = $_SESSION['store'];
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];
$user_type = $_POST["user_type"];
$password = $_POST["password"];
$email = $_POST["email"];
//$store = $_POST["store"];
if($store_name == "All Access" && $user_type != "Super Administrator")
{
	$store_name = "Pending";
}

if($user_type == "Super Administrator")
{
	$store_name = "All Access";
}

$sql="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) 
{
	echo "email taken";
}
else
{
	$sql = "INSERT INTO users(first_name,middle_name,last_name,user_type,password,status,email,username,store) VALUES ('$first_name','$middle_name','$last_name', '$user_type', '$password', 'Active', '$email','$email','$store_name')";
	if($con->query($sql) == TRUE)
	{
		echo "success";
		//$id = mysqli_insert_id($con);
		//$sqll = "UPDATE stores SET owner='$id' WHERE id='$store'";
		//$con->query($sqll);
	}
	else
	{
		echo "error";
	} 
}

?>