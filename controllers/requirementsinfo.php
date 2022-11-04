 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM students WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  
    <div class="col-md-12">
    <div class="form-group">
    <label class="control-label">Requirements</label>
    <input type="hidden" class="form-control" id="validationTooltip01" placeholder="ID" name="id" required value="'.$row["id"] .'">

    <select class="select2 form-control select2-multiple" multiple="multiple" id="validationTooltip05" required data-placeholder="Choose ..." name="requirements[]">
    ';

    $requirements = array('High School Diploma', 'Form 138', 'Form 137', 'Good Moral Character', 'Birth Certificate', 'Medical Clearance', 'Barangay Certificate');
    foreach($requirements as $requirement) {
      if(strpos($row["requirements"],$requirement) !== false ){ $status = "selected"; } else { $status = ""; }
      $output .='<option '.$status.'>'.$requirement.'</option>';
    }

    $output .= '  
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    
    ';
  }
  
  echo $output;  
}  
?>