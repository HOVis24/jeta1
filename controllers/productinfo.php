 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  require_once('connection.php'); 
  $query = "SELECT * FROM products WHERE id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);  

  $output .= '  

  <div class="row">
  <input type="hidden" class="form-control" id="validationTooltip01" placeholder="Product Name" name="id" required value="'.$row["id"].'">
  <div class="col-md-4">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Product Name</label>
  <input type="text" class="form-control" id="validationTooltip01" placeholder="Product Name" name="name" required value="'.$row["name"].'">
  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Product Price</label>
  <input type="text" class="form-control" id="validationTooltip01" placeholder="Product Price" name="price" required value="'.$row["price"].'">
  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Picture</label>
  <input type="file" class="form-control" id="validationTooltip01" value="'.$row["picture"].'" name="files" required><span name="old" value="'.$row["picture"].'">'.$row["picture"].'</span>
  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>



  </div>

  <div class="row">

  <div class="col-md-4">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Description</label>
  <textarea class="form-control" id="validationTooltip01" placeholder="Description" name="description" required>'.$row["description"].'</textarea>
  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>
  
  <div class="col-md-4">
  <div class="form-group position-relative">
  <label for="validationTooltip01">Category</label>
  <select type="text" class="form-control" id="validationTooltip01" placeholder="Category" name="category" required>
  <option disabled="true" selected>Select Meals</option>
  ';
  $meals = array('Daily Meals', 'Set of Meals');
    foreach($meals as $meal) {
      if(strpos($row["category"],$meal) !== false ){ $status = "selected"; } else { $status = ""; }
      $output .='<option '.$status.'>'.$meal.'</option>';
    }

  $output.='
  </select>

  <div class="valid-tooltip">
  Looks good!
  </div>
  </div>
  </div>

  </div>

  ';  




  echo $output;  
}  
?>