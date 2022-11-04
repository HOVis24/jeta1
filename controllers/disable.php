<?php 
include_once('connection.php');
$id = $_GET["id"];


$sql = "UPDATE users SET activated='No' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}

header("Location: ../users.php");




?>