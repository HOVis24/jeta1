<?php 
include_once('connection.php');
$id = $_POST["id"];
$requirements = implode(",", $_POST["requirements"]);


$sql = "UPDATE students SET requirements='$requirements' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}



?>