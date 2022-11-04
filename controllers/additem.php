<?php 
require_once('connection.php');
$error = "";
session_start();
$GET['url'] = basename($_SERVER['PHP_SELF']);
if (isset($_POST['ml_question'])) { 
  $error = "";
  $question = $_POST['ml_question'];
  $answer = $_POST['ml_answer'];
  $id = $_POST['id'];
  $a = $_POST['a'];
  $b = $_POST['b'];
  $c = $_POST['c'];
  $d = $_POST['d'];

  $sql = "INSERT INTO items(question,answer,a,b,c,d,activity_id,type) VALUES('$question','$answer','$a','$b','$c','$d','$id','Multiple')";
  if($con->query($sql) == TRUE){
    echo "success";
  }
  else
  {

   echo "error";
 }
}
else if (isset($_POST['enu_question'])) { 
  $enu_question = $_POST['enu_question'];
  $enu_answer = $_POST['enu_answer'];
  $id = $_POST['id'];
  
  $sqll = "INSERT INTO items(question,answer,activity_id,type) VALUES('$enu_question','$enu_answer','$id','Enumeration')";
  if($con->query($sqll) == TRUE){
    echo "success";
  }
  else
  {

   echo "error";
 }
}
?>