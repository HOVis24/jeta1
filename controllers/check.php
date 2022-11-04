  <?php 
  require_once('connection.php');
  session_start();
  $answer=count($_POST['answer']);
  $id=count($_POST['id']);
  $student_id=$_SESSION["id"];
  $type=$_POST['type'];

  $score = 0;

  for($i=0;$i<count($id);$i++)
  {

    $activity_id=$_POST['activity_id'];
    $id=$_POST['id'];
    $answer=$_POST['answer'];

    if($_POST['id'][$i]!="")
    {

      $sql = "SELECT * FROM items WHERE activity_id='$activity_id' AND id=$id[$i] AND answer LIKE '$answer[$i]' ";
    /*if (mysqli_query($con, $sql)) {
      echo json_encode(array("statusCode"=>200));
    } 
    else {
      echo json_encode(array("statusCode"=>201));
    }
*/
    $result = $con->query($sql);

    if ($result->num_rows >= 1) {
      $row = $result->fetch_assoc();
      $score = $score + 1;
    }
    
  }
}
$id=count($_POST['id']);
date_default_timezone_set("Asia/Singapore");
$datetime = date('Y-m-d H:i:s A');
$sqll = "INSERT INTO completed_quizzes(activity_id,student_id,score,overall,type,date_finished) 
VALUES ('$activity_id','$student_id','$score','$id','$type','$datetime')";
$con->query($sqll);
  echo $type." Completed! Your score is ".$score;

?>