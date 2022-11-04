<?php 
include_once('connection.php');
$id = $_POST["id"];
$quantity = $_POST["quantity"];

$sql = "UPDATE cart SET quantity='$quantity' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}
?>