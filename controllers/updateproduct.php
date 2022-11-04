<?php 
include_once('connection.php');

$file_name = $_FILES['files']['name'];
$file_size =$_FILES['files']['size'];
$file_tmp =$_FILES['files']['tmp_name'];
$file_type=$_FILES['files']['type'];

$extensions= array("pdf","jpg","png","docx","mp4");


$file = $_FILES['files'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category = $_POST['category'];
$id = $_POST['id'];
$filed = $_FILES['files']['name'];
$oldfile = $_POST['old'];


if($filed!="") {

$query = "UPDATE products SET name='$name', price='$price', description='$description', category='$category', picture='$filed' WHERE id='$id'";

} else {

$query = "UPDATE products SET name='$name', price='$price', description='$description', category='$category' WHERE id='$id'";

}


	move_uploaded_file($file_tmp,"../files/".$filed);
	if($con->query($query) == TRUE){
		echo "success";
		date_default_timezone_set("Asia/Singapore");
		$datetime = date('Y-m-d H:i A');
	}




?>