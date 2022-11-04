<?php 
include_once('connection.php');
$id = $_POST["id"];
$table = $_POST["table"];

$sql = "DELETE FROM $table WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}
?>