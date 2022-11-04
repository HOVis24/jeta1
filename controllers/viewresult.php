 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  $activity_id = $_POST["id"];
  $student_id = $_POST["student_id"];
  $type = $_POST["type"];
  require_once('connection.php'); 
  $query = "SELECT * FROM completed_quizzes WHERE activity_id = '$activity_id' AND student_id = '$student_id' AND type = '$type'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  

    <center><h3>Your Score</h3></center>
    <center><h1>'.$row['score'].'/'.$row['overall'].'</h1></center><br>
    <center><h6>Date Finished:</h6></center>
    <center><h6>'.$row['date_finished'].'</h6></center>

    ';  
  }
  
  echo $output;  
}  
?>