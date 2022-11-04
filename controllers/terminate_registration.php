<?php 
	include_once('connection.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "UPDATE store_registration SET Registration_status='Void' WHERE registration_id='$id'";
		if($con->query($sql) == TRUE)
		{
			header("Location:../dashboard.php");
		}
	}
	
 ?> 