 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  $id = $_POST["id"];
  require_once('connection.php'); 
  $query = "SELECT subject_id,student_id,students.id,school_year,semester,midterm_grade,final_term_grade,grade,prelims,semifinals,remarks,subjects.subject_code,subjects.subject_description,grades.id FROM grades INNER JOIN students ON student_id=students.id INNER JOIN subjects ON subject_id=subjects.id WHERE grades.id='".$_POST["id"]."'";
  $result = mysqli_query($con, $query);  
  while($row = mysqli_fetch_array($result))   
  {
    $output .= '  
    <div class="row">
    <input type="hidden" class="form-control" name="id" value="'.$id.'">
    <input type="hidden" class="form-control" name="student_id"  value="'.$row['student_id'].'">
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Subjects</label>
    <select class="form-control select2" id="validationTooltip05" required name="subject_id">
    <option disabled selected value="">Select Subject</option>
    ';
    $sqlSelect = "SELECT * FROM subjects";

    $resultt = mysqli_query($con, $sqlSelect);

    if (mysqli_num_rows($resultt) > 0)
    {
      while ($roww = mysqli_fetch_array($resultt)) {
        $status = "";
        if($row["subject_id"] == $roww["id"]){ $status = "selected"; } else { $status = ""; }
        $output .='
        <option value="'.$roww['id'].'" '.$status.'>'.$roww['subject_description'].'</option>
        '; 
      }
    }

    $output .= '  
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">School Year</label>
    <select class="form-control select2" id="validationTooltip05" required name="school_year">
    <option disabled selected value="">Select School Year</option>
    ';


    for ($n = 2017; $n <= 2040; $n++) {
      if($row["school_year"] ==  ($n + 1)){ $status = "selected"; } else { $status = ""; }
      $output .= '  
      <option '.$status.'>'.($n + 1).'</option>
      ';
    }

    $output .= '  
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Semester</label>
    <select class="form-control select2" id="validationTooltip05" required name="semester">
    <option disabled selected value="">Select Semester</option>
    ';

    for ($n = 0; $n <= 1; $n++) {
      if($row["semester"] ==  ($n + 1).date("S", mktime(0, 0, 0, 0, ($n + 1), 0))." Semester"){ $status = "selected"; } else { $status = ""; }
      $output .= '  
      <option '.$status.'>'.($n + 1).date("S", mktime(0, 0, 0, 0, ($n + 1), 0)).' Semester</option>
      ';
    }

    $output .= '
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Midterm Grade</label>
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Midterm Grade" name="midterm_grade" required value="'.$row['midterm_grade'].'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>

    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip02">Final Term Grade</label>
    <input type="text" class="form-control" id="validationTooltip02" placeholder="Final Term Grade" name="final_term_grade" value="'.$row['final_term_grade'].'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip02">Final Grade</label>
    <input type="text" class="form-control" id="validationTooltip02" placeholder="Final Grade" name="final_grade" value="'.$row['grade'].'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>


    </div>
    <div class="row">
    
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip02">Remarks</label>
    <input type="text" class="form-control" id="validationTooltip02" placeholder="Remarks" name="remarks" value="'.$row['remarks'].'" >
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