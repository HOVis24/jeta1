 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM students WHERE course = '".$_POST["course"]."' AND year = '".$_POST["year"]."' AND section = '".$_POST["section"]."'";
  $result = mysqli_query($con, $query);  
  $output .= '
  <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
  <tr>
  <th>Student No.</th>
  <th>Name</th>
  <th>Course/Strand</th>
  <th>Year</th>
  <th>Section</th>
  <th>Actions</th>
  </tr>
  </thead>


  <tbody>

  ';  
  while($row = mysqli_fetch_array($result))   
  { 
  
  $output .= '  
  <tr>
  <td>'.$row['student_no'].'</td>
  <td>'.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'</td>
  <td>'.$row['course'].'</td>
  <td>'.$row['year'].'</td>
  <td>'.$row['section'].'</td>
  <td>
      <button type="button" class="btn btn-primary btn-sm waves-effect waves-light btnmessagemodal" data-toggle="modal" id="'.$row['id'].'" name="'.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'">Message</button>
      </td>
  </tr>
  ';  
}
  $output .= '
  </tbody>  
  </table>   
  ';  
  
  
  echo $output;  
}  
?>