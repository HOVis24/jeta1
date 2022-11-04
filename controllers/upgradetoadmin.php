<?php 
	include_once('connection.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "UPDATE users SET user_type='Administrator' WHERE id='$id'";
		if($con->query($sql) == TRUE)
		{
			header("Location:../users.php");
		}
	}
	
 ?> 