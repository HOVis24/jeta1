<?php 
	include_once('connection.php');
	session_start();
	$Store_name = $_SESSION['store'];
	$message = $_POST["message"];
	$customer_id = $_POST["customer_id"];
	$sql = "INSERT INTO chat(message,customer_id,user_type,store) VALUES ('$message','$customer_id','Admin','$Store_name')";
	
	if($con->query($sql) == TRUE)
	{
		echo $customer_id;
	}
?>