 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM subjects WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
  $output .= '  
  
  <div class="row">
  <div class="col-md-6">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Subject Code</label>
  <input type="hidden" class="form-control" placeholder="Subject Code" name="id" required value="'.$row["id"] .'">
  <input type="text" class="form-control" placeholder="Subject Code" name="subject_code" required value="'.$row["subject_code"] .'">
  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Subject Description</label>
  <input type="text" class="form-control" placeholder="Subject Description" name="subject_description" required value="'.$row["subject_description"] .'">
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