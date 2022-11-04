 <?php  
 if(isset($_POST["course"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM students WHERE course = '".$_POST["course"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  
    <option>'.$row["year"] .'</option>
    ';  
  }
  
  echo $output;  
}  
?>