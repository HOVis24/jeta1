<?php 
	include_once('connection.php');
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$status = $_GET['status'];
		$sql = "UPDATE orders SET status='$status' WHERE order_number='$id'";
		if($con->query($sql) == TRUE){
			header("Location:../ordersmanagement.php");
		}
	}
	
 ?> 