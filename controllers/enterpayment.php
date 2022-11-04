<?php 
include_once('connection.php');
$payment = $_POST["payment"];
$id = $_POST["id"];
$balance = intval(str_replace(",","",$_POST["balance"])) - intval(str_replace(",","",$_POST["payment"]));
if (intval(str_replace(",","",$_POST["balance"])) < intval(str_replace(",","",$_POST["payment"]))) {
	echo "error";
}
else
{
	setlocale(LC_MONETARY,"en_US");
	$no = number_format($balance);

	$sql = "UPDATE students SET balance = '$no' WHERE id= '$id' ";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}



?>