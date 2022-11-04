 <?php  
 if(isset($_POST["val"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '<div class="row">
  <div class="col-md-4">
  <div class="form-group position-relative">
  <label class="control-label">Store</label>
  <select class="form-control" id="" name="store">
  <option disabled selected value="">Select Store</option>';  
  require_once('connection.php'); 
  $query = "SELECT * FROM stores";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  

    
    <option value="'.$row['id'].'">'.$row['name'].'</option>
    

    ';  
  }
  $output .= '  
    </select>
    </div>
    </div>
    </div>

    ';  
  
  echo $output;  
}  
?>