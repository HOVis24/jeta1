 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM courses WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  
    <div class="row">
    <div class="col-md-6">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Course Name</label>
    <input type="hidden" class="form-control" id="validationTooltip01" placeholder="ID" name="id" required value="'.$row["id"] .'">
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Course Name" name="course_name" required value="'.$row["course_name"] .'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Course Description</label>
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Course Description" name="course_description" required value="'.$row["course_description"] .'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    </div>
    ';  
  }
  
  echo $output;  
}  
?>