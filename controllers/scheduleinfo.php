 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT schedules.id AS scheds_id,course,year,section,days,schedules.subject_id,schedules.room_id,time_from,time_to,subjects.subject_code,rooms.room_no,users.id AS users_id,users.first_name,users.middle_name,users.last_name FROM `schedules` INNER JOIN subjects ON subject_id = subjects.id INNER JOIN rooms ON room_id = rooms.id INNER JOIN users ON teacher_id=users.id WHERE schedules.id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  
    <div class="row">
    <div class="col-md-4">
    <div class="form-group position-relative">
    <input class="form-control timepicker" type="hidden" id="example-time-input" value="'.$row["scheds_id"].'" name="id">
    <label class="control-label">Course</label>
    <select class="form-control select2" id="validationTooltip05" required name="course">
    <option disabled selected value="">Select Course</option>
    ';

    $sqlSelect = "SELECT * FROM courses";
    $result = mysqli_query($con, $sqlSelect);

    if (mysqli_num_rows($result) > 0)
    {
      while ($roww = mysqli_fetch_array($result)) {
        if($row["course"] == $roww["course_name"]){ $status = "selected"; } else { $status = ""; }
        $output .='<option '.$status.'>'.$roww['course_name'].'</option>';
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
    <div class="form-group position-relative">
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

    $output .= '  
    </select>
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label class="control-label">Section</label>
    <select class="form-control select2" id="validationTooltip05" required name="section">
    <option disabled selected value="">Select Section</option>
    ';

    $sections = array('N/A', 'A', 'B', 'C', 'D');
    foreach($sections as $section) {
      if(strpos($row["section"],$section) !== false ){ $status = "selected"; } else { $status = ""; }
      $output .='<option '.$status.'>'.$section.'</option>';
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
    <div class="form-group">
    <label class="control-label">Subjects</label>
    <select class="form-control select2" id="validationTooltip05" required name="subject_id">
    <option disabled selected value="">Select Subject</option>
    ';

    $sqlSelectt = "SELECT * FROM subjects";
    $result = mysqli_query($con, $sqlSelectt);

    if (mysqli_num_rows($result) > 0)
    {
      while ($rowww = mysqli_fetch_array($result)) {
        if($row["subject_id"] == $rowww["id"]){ $status = "selected"; } else { $status = ""; }
        $output .='<option '.$status.' value="'.$rowww['id'].'">'.$rowww['subject_code']." ".$rowww['subject_description'].'</option>';
      }
    }

    $output .= '  
    </select>

    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Day/s</label>

    <select class="select2 form-control select2-multiple" multiple="multiple" id="validationTooltip05" required data-placeholder="Choose ..." name="days[]">
    ';

    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    foreach($days as $day) {
      if(strpos($row["days"],$day) !== false ){ $status = "selected"; } else { $status = ""; }
      $output .='<option '.$status.'>'.$day.'</option>';
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
    <label class="control-label">Time From</label>
    <input class="form-control timepicker" type="text" id="example-time-input" value="'.$row["time_from"].'" name="time_from">
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Time To</label>
    <input class="form-control" type="text" id="example-time-input" value="'.$row["time_to"].'" name="time_to">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Room</label>
    <select class="form-control select2" id="validationTooltip05" required name="room_id">
    <option disabled selected value="">Select Room</option>
    ';

    $sqlSelectt = "SELECT * FROM rooms";
    $result = mysqli_query($con, $sqlSelectt);

    if (mysqli_num_rows($result) > 0)
    {
      while ($rowwws = mysqli_fetch_array($result)) {
        if($row["room_id"] == $rowwws["id"]){ $status = "selected"; } else { $status = ""; }
        $output .='<option '.$status.' value="'.$rowwws['id'].'">'.$rowwws['room_no'].'</option>';
      }
    }

    $output .='
    </select>

    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Teacher</label>
    <select class="form-control select2" id="validationTooltip05" required name="teacher_id">
    <option disabled selected value="">Select Teacher</option>
    ';

    $sqlSelectt = "SELECT * FROM users WHERE user_type='Teacher'";
    $result = mysqli_query($con, $sqlSelectt);

    if (mysqli_num_rows($result) > 0)
    {
      while ($rowwwss = mysqli_fetch_array($result)) {
        if($row["users_id"] == $rowwwss["id"]){ $status = "selected"; } else { $status = ""; }
        $output .='<option '.$status.' value="'.$rowwwss['id'].'">'.$rowwwss['first_name']." ".substr($rowwwss['middle_name'],0,1)."."." ".$rowwwss['last_name'].'</option>';
      }
    }

    $output .='</select>

    </div>
    </div>
    </div>';

  }
  
  echo $output;  
}  
?>