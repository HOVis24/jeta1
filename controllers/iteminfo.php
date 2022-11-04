 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM items WHERE id = '".$_POST["id"]."' ";
  $result = mysqli_query($con, $query);  
  while($row = mysqli_fetch_array($result))   
  { 
    $status_a = "";
    $status_b = "";
    $status_c = "";
    $status_d = "";
    if ($row['a'] == $row['answer']) {
     $status_a = "checked";
    }
    else if ($row['b'] == $row['answer']) {
     $status_b = "checked";
    }
    else if ($row['c'] == $row['answer']) {
     $status_c = "checked";
    }
    else if ($row['d'] == $row['answer']) {
     $status_d = "checked";
    }
    $form = "";
    if ($_POST["type"] == "Multiple") {
      $form = '
      
      <input type="hidden" class="form-control activity_id" id="validationTooltip03" placeholder="A Answer" name="id" required value="'.$row['id'].'">
      <h5>Multiple Choices</h5>
      <div class="row">
      <div class="col-md-5">
      <div class="form-group position-relative">
      <label for="validationTooltip02">Question</label>
      <textarea type="text" class="form-control" id="validationTooltip03" placeholder="Question" name="ml_question" required>'.$row['question'].'</textarea>
      <div class="valid-tooltip">
      Looks good!
      </div>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="col-md-3">
      <div class="custom-control custom-radio mb-2">
      <input type="radio" id="customRadio11" name="ml_answer" '.$status_a.' class="custom-control-input answer_a" value="'.$row['a'].'">
      <label class="custom-control-label" for="customRadio11">A</label>
      <input type="text" class="form-control a" id="validationTooltip03" value="'.$row['a'].'" placeholder="A Answer" name="a" required>
      </div>
      </div>
      <div class="col-md-3">
      <div class="custom-control custom-radio mb-2">
      <input type="radio" id="customRadio21" name="ml_answer" '.$status_b.' class="custom-control-input answer_b" value="'.$row['b'].'">
      <label class="custom-control-label" for="customRadio21">B</label>
      <input type="text" class="form-control b" id="validationTooltip03" value="'.$row['b'].'" placeholder="B Answer" name="b" required>
      </div>
      </div>
      <div class="col-md-3">
      <div class="custom-control custom-radio mb-2">
      <input type="radio" id="customRadio31" name="ml_answer" '.$status_c.' class="custom-control-input answer_c" value="'.$row['c'].'">
      <label class="custom-control-label" for="customRadio31">C</label>
      <input type="text" class="form-control c" id="validationTooltip03" value="'.$row['c'].'" placeholder="C Answer" name="c" required>
      </div>
      </div>
      <div class="col-md-3">
      <div class="custom-control custom-radio mb-2">
      <input type="radio" id="customRadio41" name="ml_answer" '.$status_d.' class="custom-control-input answer_d" value="'.$row['d'].'">
      <label class="custom-control-label" for="customRadio41">D</label>
      <input type="text" class="form-control d" id="validationTooltip03" value="'.$row['d'].'" placeholder="D Answer" name="d" required>
      </div>
      </div>
      </div><br>
      
 
      
      ';
    }
    else if($_POST["type"] == "Enumeration")
    {
      $form = '
      
      <input type="hidden" class="form-control activity_id" value="'.$row['id'].'" id="validationTooltip03" placeholder="A Answer" name="id" required>
      <h5>Enumeration</h5>
      <div class="row">
      <div class="col-md-5">
      <div class="form-group position-relative">
      <label for="validationTooltip02">Question</label>
      <textarea type="text" class="form-control" id="validationTooltip03" placeholder="Question" name="enu_question" required>'.$row['question'].'</textarea>
      <div class="valid-tooltip">
      Looks good!
      </div>
      </div>
      </div>
      <div class="col-md-5">
      <div class="form-group position-relative">
      <label for="validationTooltip02">Answer/s</label>
      <textarea type="text" class="form-control" id="validationTooltip03" placeholder="Answer/s" name="enu_answer" required>'.$row['answer'].'</textarea>
      <div class="valid-tooltip">
      Looks good!
      </div>
      </div>
      </div>
      </div>
      <br>
      
     
      ';
    }
    

    $output .= '  
    
    
    '.$form.'
    
    ';  
  }
  
  
  
  echo $output;  
}  
?>