<?php
include_once('connection.php');
if (isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    
    $extensions= array("pdf","jpg","png");

    
    $file = $_FILES['file'];
    $description = $_POST['description'];
    $id = $_POST['sched_id'];

    $query = "INSERT INTO files(file_name,description,sched_id) VALUES('$file','$description','$id')";
    move_uploaded_file($file_tmp,"files/".$file_name);
    if($con->query($query) == TRUE){
        echo "success";
    }
}

?>