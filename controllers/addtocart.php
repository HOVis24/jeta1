<?php 
include_once('connection.php');
$id = $_POST["id"];
$quantity = $_POST["quantity"];
$user_id = $_POST["user_id"];


$sql = "INSERT INTO cart(product_id,quantity,user_id) VALUES('$id','$quantity','$user_id')";
if($con->query($sql) == TRUE){
	echo "success";
}




?>