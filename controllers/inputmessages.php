 <?php  
 if(isset($_POST["id"]))  
 {  
    
    $GET['url'] = $_SERVER['REQUEST_URI'];
    $output = '';  
    $id = $_POST["id"];
    $status = "";
    $name = "";
    require_once('connection.php'); 
    $output .='  
    <div class="row">
      <div class="col-md-12">
        <div class="form-group position-relative">    
            <input type="hidden" class="form-control" id="validationTooltip01" placeholder="First Name" name="customer_id" value="'.$id.'" required>
            <label for="validationTooltip01">Enter Message</label>
            <textarea class="form-control" id="validationTooltip01" placeholder="Message" name="message"></textarea> 
        </div>
      </div>
    </div>

    <button class="btn btn-primary" id="addstudent" type="submit">Send Message</button>
  ';
  echo $output;  
}  
?>