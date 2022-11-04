<?php 
include_once('connection.php');
$id = $_POST["id"];


$sql = "DELETE FROM cart WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}




?>