 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM rooms WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  

    <div class="row">
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Room Number</label>
    <input type="hidden" class="form-control" id="validationTooltip01" placeholder="ID" name="id" required value="'.$row["id"] .'">
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Room Number" name="room_no" required value="'.$row["room_no"] .'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Department</label>
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Department" name="department" required value="'.$row["department"] .'">
    <div class="valid-tooltip">
    Looks good!
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Floor</label>
    <input type="text" class="form-control" id="validationTooltip01" placeholder="Floor" name="floor" required value="'.$row["floor"] .'">
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