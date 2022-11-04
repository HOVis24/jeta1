 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM students WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);  
  $row = mysqli_fetch_array($result);  
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
  </tr>
  </thead>


  <tbody>

  ';  

  $sqlSelect = "SELECT subject_id,student_id,students.id,school_year,semester,midterm_grade,final_term_grade,grade,subjects.subject_code,subjects.subject_description,grades.id FROM grades INNER JOIN students ON student_id=students.id INNER JOIN subjects ON subject_id=subjects.id WHERE student_id='".$_POST["id"]."'";

  $resultt = mysqli_query($con, $sqlSelect);

  if (mysqli_num_rows($resultt) > 0)
  {
    while ($roww = mysqli_fetch_array($resultt)) {
      $output .='
      <tr>
      <td>'.$roww['subject_code'].'</td>
      <td>'.$roww['subject_description'].'</td>
      <td>'.$roww['school_year'].'</td>
      <td>'.$roww['semester'].'</td>
      <td>'.$roww['midterm_grade'].'</td>
      <td>'.$roww['final_term_grade'].'</td>
      <td>'.$roww['grade'].'</td>
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