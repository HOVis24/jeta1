<?php 
include_once('connection.php');

$file_name = $_FILES['file']['name'];
$file_size =$_FILES['file']['size'];
$file_tmp =$_FILES['file']['tmp_name'];
$file_type=$_FILES['file']['type'];

$extensions= array("pdf","jpg","png","docx","mp4");


$file = $_FILES['file'];
$name = $_POST['name'];
$categories = implode(",", $_POST["categories"]);
$owner = $_POST['owner_name'];
$admin = $_POST['admin_name'];
$assistant = $_POST['assistant_name'];
$staff = $_POST['staff_name'];

$query = "INSERT INTO stores(name,picture,categories,status,owner,admin,assistant_admin,staff) VALUES('$name','$file_name','$categories','Inactive','$owner','$admin','$assistant','$staff')";
move_uploaded_file($file_tmp,"../files/".$file_name);
if($con->query($query) == TRUE){
    echo "success";

    $sql1 = "UPDATE users SET store='$name' WHERE id='$owner'";
	$con->query($sql1);

	$sql2 = "UPDATE users SET store='$name' WHERE id='$admin'";
	$con->query($sql2);

	$sql3 = "UPDATE users SET store='$name' WHERE id='$assistant'";
	$con->query($sql3);

	$sql4 = "UPDATE users SET store='$name' WHERE id='$staff'";
	$con->query($sql4);

    date_default_timezone_set("Asia/Singapore");
	$datetime = date('Y-m-d h:i A');


}
?>