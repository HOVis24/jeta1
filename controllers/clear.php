<?php 
include_once('connection.php');
$id = $_POST["id"];
$string = $_POST["string"];
$column = $_POST["column"];

$sql = "UPDATE students SET $column='$string' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}
?>