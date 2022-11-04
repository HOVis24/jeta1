 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  $id = $_POST["id"];
  require_once('connection.php'); 
  $query = "SELECT course_name,course_description,sections.course_id,sections.year,sections.section FROM `courses` INNER JOIN sections ON sections.course_id=courses.id WHERE sections.id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Course</label>
    <input type="hidden" class="form-control" name="id" id="studentid" value="'.$id.'">
    <select class="form-control select2" id="validationTooltip05" required name="course_id">
    <option disabled selected value="">Select Course</option>
    ';  

    $sqlSelect = "SELECT * FROM courses";

    $resultt = mysqli_query($con, $sqlSelect);

    if (mysqli_num_rows($resultt) > 0)
    {
      while ($roww = mysqli_fetch_array($resultt)) {
        $status = "";
        if($row["course_id"] == $roww["id"]){ $status = "selected"; } else { $status = ""; }
        $output .='
        <option value="'.$roww['id'].'" '.$status.'>'.$roww['course_name'].'</option>
        '; 
      }
    }

    $output .='
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Year</label>
    <select class="form-control select2" id="validationTooltip05" required name="year">
    <option disabled selected value="">Select Year</option>
    ';

    for ($n = 0; $n <= 3; $n++) {
      if($row["year"] ==  ($n + 1).date("S", mktime(0, 0, 0, 0, ($n + 1), 0))){ $status = "selected"; } else { $status = ""; }
      $output .= '  
      <option '.$status.'>'.($n + 1).date("S", mktime(0, 0, 0, 0, ($n + 1), 0)).'</option>
      ';
    }

    $output .='
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Section</label>
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Section" name="section" required value="'.$row['section'].'">
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