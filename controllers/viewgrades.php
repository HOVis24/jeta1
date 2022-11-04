 <?php  
 session_start();
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM students WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);  
  $row = mysqli_fetch_array($result);
  $action = "";
  $edit = "";
  if ($_SESSION["user_type"] == "Administrator") {
    $action = '<th>Action</th>';
    
  }
  elseif ($_SESSION["user_type"] == "Teacher") {
    $action = '';
  }

  $section = "";
  if ($row['section']== "N/A") {
   $section = "(".$row['section'].")";
 } 
 else
 {
  $section = $row['section'];
}   

$output .= '  
<h5><b>Student Number:</b>  '.$row["student_no"] .'</h5>
<h5><b>Name:</b>  '.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'</h5>
<h5><b>Course/Year/Section:</b>  '.$row['course']." ".substr($row['year'],0,1).$section.'</h5>
<br>
<h5>Grades</h5><hr>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
<thead>
<tr>
<th>Subject Code</th>
<th>Subject Description</th>
<th>School Year</th>
<th>Semester</th>
<th>Midterm Grade</th>
<th>Final Term Grade</th>
<th>Final Grade</th>
<th>Remarks</th>
'.$action.'
</tr>
</thead>


<tbody>

';  

$sqlSelect = "SELECT subject_id,student_id,students.id,school_year,semester,midterm_grade,remarks,final_term_grade,grade,prelims,semifinals,subjects.subject_code,subjects.subject_description,grades.id FROM grades INNER JOIN students ON student_id=students.id INNER JOIN subjects ON subject_id=subjects.id WHERE student_id='".$_POST["id"]."'";

$resultt = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($resultt) > 0)
{
  while ($roww = mysqli_fetch_array($resultt)) {
    if ($_SESSION["user_type"] == "Administrator") {
      $edit = '"<td>
      <button type="button" class="btn btn-primary btn-sm waves-effect waves-light btneditgrade" data-toggle="modal" id="'.$roww['id'].'">Edit Grade</button>
      </td>"';
    }
    elseif ($_SESSION["user_type"] == "Teacher") {
      $edit = '';
    }

    $grade = "";
    if ((97 <= $roww['grade']) && ($roww['grade'] <= 100)) {
      $grade = '1.0';
    }
    else if ((94.25 <= $roww['grade']) && ($roww['grade'] <= 96.99)) {
      $grade = '1.25';
    }
    else if ((91.50 <= $roww['grade']) && ($roww['grade'] <= 94.24)) {
      $grade = '1.5';
    }
    else if ((88.75 <= $roww['grade']) && ($roww['grade'] <= 91.49)) {
      $grade = '1.75';
    }
    else if ((86.00 <= $roww['grade']) && ($roww['grade'] <= 88.74)) {
      $grade = '2.0';
    }
    else if ((83.25 <= $roww['grade']) && ($roww['grade'] <= 85.99)) {
      $grade = '2.25';
    }
    else if ((80.50 <= $roww['grade']) && ($roww['grade'] <= 83.24)) {
      $grade = '2.5';
    }
    else if ((77.75 <= $roww['grade']) && ($roww['grade'] <= 80.49)) {
      $grade = '2.75';
    }
    else if ((75.00 <= $roww['grade']) && ($roww['grade'] <= 77.74)) {
      $grade = '3.00';
    }
    else if ((75 < $roww['grade'])) {
      $grade = '5.00';
    }
    $output .='
    <tr>
    <td>'.$roww['subject_code'].'</td>
    <td>'.$roww['subject_description'].'</td>
    <td>'.$roww['school_year'].'</td>
    <td>'.$roww['semester'].'</td>
    <td>'.$roww['midterm_grade'].'</td>
    <td>'.$roww['final_term_grade'].'</td>
    <td>'.$grade.'</td>
    <td>'.$roww['remarks'].'</td>
    '.$edit.'
    </tr>
    '; 
  }
}

$output .= '
</tbody>  
</table>  
</div>  
';  
echo $output;  
}  
?>