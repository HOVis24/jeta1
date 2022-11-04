<?php 
include_once('connection.php');
$id = $_POST["id"];
$student_id = $_POST["student_id"];
$subject_id = $_POST["subject_id"];
$school_year = $_POST["school_year"];
$semester = $_POST["semester"];
$midterm_grade = $_POST["midterm_grade"];
$final_term_grade = $_POST["final_term_grade"];
$final_grade = $_POST["final_grade"];
$remarks = $_POST["remarks"];



//$grade = (intval($_POST["prelims"]) * 0.25) + (intval($_POST["midterm_grade"]) * 0.40) + (intval($_POST["semifinals"]) * 0.15) + (intval($_POST["final_term_grade"]) * 0.20);	




$sql = "UPDATE grades SET subject_id='$subject_id', student_id='$student_id', school_year='$school_year', semester='$semester', midterm_grade='$midterm_grade', final_term_grade='$final_term_grade', grade='$final_grade', remarks='$remarks' WHERE id='$id'";
if($con->query($sql) == TRUE){
	echo "success";
}



?>