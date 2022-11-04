 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM items WHERE activity_id = '".$_POST["id"]."' AND type = 'Multiple' ";
  $result = mysqli_query($con, $query);  
  $output .= '
  <h5>Multiple Choices</h5>
  <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
  <tr>
  <th>Question</th>
  <th>Answer</th>
  <th>A</th>    
  <th>B</th>
  <th>C</th>
  <th>D</th>
  <th>Action</th>
  </tr> 
  </thead>


  <tbody>

  ';  
  while($row = mysqli_fetch_array($result))   
  { 

    $output .= '  
    <tr>
    <td>'.$row['question'].'</td>
    <td>'.$row['answer'].'</td>
    <td>'.$row['a'].'</td>
    <td>'.$row['b'].'</td>
    <td>'.$row['c'].'</td>
    <td>'.$row['d'].'</td>
    <td>
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light btnedititem" id="'.$row['id'].'" pop="'.$row['type'].'">Edit</button>
    </td>
    </tr>
    ';  
  }
  $output .= '
  </tbody>  
  </table>   
  ';  
  
  $query = "SELECT * FROM items WHERE activity_id = '".$_POST["id"]."' AND type = 'Enumeration' ";
  $result = mysqli_query($con, $query);  
  $output .= '
  <h5>Enumeration</h5>
  <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
  <tr>
  <th>Question</th>
  <th>Answer</th>
  <th>Action</th>
  </tr> 
  </thead>


  <tbody>

  ';  
  while($row = mysqli_fetch_array($result))   
  { 

    $output .= '  
    <tr>
    <td>'.$row['question'].'</td>
    <td>'.$row['answer'].'</td>
    <td>
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light btnedititem" id="'.$row['id'].'" pop="'.$row['type'].'">Edit</button>
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