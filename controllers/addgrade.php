<?php 
include_once('connection.php');
$student_id = $_POST["id"];
$subject_id = $_POST["subject_id"];
$school_year = $_POST["school_year"];
$semester = $_POST["semester"];
$midterm_grade = $_POST["midterm_grade"];
$final_term_grade = $_POST["final_term_grade"];
$remarks = $_POST["remarks"];
if ($_POST["final_grade"] == "") {
	$grade = (intval($_POST["midterm_grade"]) * 0.40) + (intval($_POST["final_term_grade"]) * 0.60);	
}
else
{
	$grade = $_POST["final_grade"];
}


$sql="SELECT * FROM grades WHERE student_id='$student_id' AND subject_id='$subject_id' AND school_year='$school_year' AND semester='$semester'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
mysqli_free_result($result);

if ($count >= 1) {
	echo "error";
}
else
{
	$sql = "INSERT INTO grades(student_id,subject_id,school_year,semester,midterm_grade,final_term_grade,grade,remarks) VALUES('$student_id','$subject_id','$school_year','$semester', '$midterm_grade', '$final_term_grade', '$grade', '$remarks')";
	if($con->query($sql) == TRUE){
		echo "success";
	}
}



?>