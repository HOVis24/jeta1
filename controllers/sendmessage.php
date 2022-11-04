<?php 
include_once('connection.php');
$message = $_POST["message"];
$customer_id = $_POST["customer_id"];
$user_type = $_POST["user_type"];


$sql = "INSERT INTO chat(message,customer_id,user_type) VALUES('$message','$customer_id','$user_type')";
if($con->query($sql) == TRUE){
	echo "success";
}

?>