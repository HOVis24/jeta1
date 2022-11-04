<?php 
require_once('connection.php');
$error = "";
session_start();
$GET['url'] = basename($_SERVER['PHP_SELF']);
$error = "";
if (isset($_POST['ml_question'])) {
	$question = $_POST['ml_question'];
	$answer = $_POST['ml_answer'];
	$id = $_POST['id'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$d = $_POST['d'];
	$sql = "UPDATE items SET question='$question', answer='$answer', a='$a', b='$b', c='$c', d='$d' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
	else
	{
		echo "error";
	}	
}
else if (isset($_POST['enu_question']))
{
	$id = $_POST['id'];
	$question = $_POST['enu_question'];
	$answer = $_POST['enu_answer'];
	$sql = "UPDATE items SET question='$question', answer='$answer' WHERE id='$id'";
	if($con->query($sql) == TRUE){
		echo "success";
	}
	else
	{
		echo "error";
	}	
}



?>