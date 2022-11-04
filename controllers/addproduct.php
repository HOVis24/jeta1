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
$category = $_POST['category'];
$description = $_POST['description'];

$category1 = $_POST['category1'];
$category2 = $_POST['category2'];
$category3 = $_POST['category3'];
$category4 = $_POST['category4'];

$id = $_POST['id'];

				$sqlSelect = "SELECT name FROM stores WHERE id='$id'";
                $result = mysqli_query($con, $sqlSelect);
                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                      $store_name = $row['name'];
                  } 
                }   


$query = "INSERT INTO products(name,picture,price,store_id,category,description,details1,details2,details3,details4) VALUES('$name','$file_name','$price','$store_name','$category','$description','$category1','$category2','$category3','$category4')";
move_uploaded_file($file_tmp,"../files/".$file_name);
if($con->query($query) == TRUE){
    echo "success";
    date_default_timezone_set("Asia/Singapore");
	$datetime = date('Y-m-d H:i A');
}

?>