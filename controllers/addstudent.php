<?php 
include_once('connection.php');
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$last_name = $_POST["last_name"];
$student_no = $_POST["student_no"];
$course = $_POST["course"];
$year = $_POST["year"];
$section = $_POST["section"];
$phone_no = $_POST["phone_no"];
$balance = $_POST["balance"];
$requirements = implode(",", $_POST["requirements"]);
$guidance = $_POST["guidance"];
$violations = $_POST["violations"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql="SELECT * FROM students WHERE student_no='$student_no'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

$sql="SELECT * FROM students WHERE email='$email'";
$result=mysqli_query($con,$sql);
$count2=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "studentno error";
}
else if ($count2 >= 1) {
	echo "email error";
}

else
{
	// $sql = "INSERT INTO users(first_name,middle_name,email,password) VALUES('$first_name','$middle_name','$last_name','$email','$password')";
	// $con->query($sql);

	$sql = "INSERT INTO students(first_name,middle_name,last_name,student_no,course,year,section,phone_no,balance,status,violations,guidance,requirements,email,password) VALUES('$first_name','$middle_name','$last_name','$student_no','$course','$year','$section','$phone_no','$balance','Active','$violations','$guidance','$requirements','$email','$password')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}

?>