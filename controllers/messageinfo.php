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
    <div class="row">
    <div class="col-md-12">
    <div class="form-group position-relative">
    <label for="validationTooltip01">Message</label>
    <input type="hidden" class="form-control" id="validationTooltip01" placeholder="ID" name="phone_no" required value="'.$row["phone_no"] .'">
    <textarea class="form-control" id="validationTooltip01" placeholder="Message" name="message" required value=""></textarea>
    <div class="valid-tooltip">
    Message Sent!
    </div>
    </div>
    </div>
    </div>
    ';  
  }
  
  echo $output;  
}  
?>