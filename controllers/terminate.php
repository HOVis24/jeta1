<?php 
	include_once('connection.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$table = $_GET['table'];
		$sql = "UPDATE $table SET status='Terminated' WHERE id='$id'";
		if($con->query($sql) == TRUE){
			if ($table == 'users') {
				header("Location:../users.php");
			}
			elseif ($table == 'stores') {
				header("Location:../stores.php");
			}
			
		}
	}
	
 ?> 