 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '';  
  $store_name = "";
  require_once('connection.php'); 
  $query = "SELECT stores.id,name,owner,picture,categories,users.id,users.first_name,users.middle_name,users.last_name FROM stores INNER JOIN users ON owner=users.id WHERE stores.id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $store_name = $row["name"];
    $output .= '  

    <h5>Store</h5>
    <br>
    <div class="media mb-4">
    <img class="d-flex align-self-center rounded mr-3" src="files/'.$row['picture'].'" alt="Generic placeholder image" style="height: 100%; width: 100px;">
    <div class="media-body"><br>
    <h5 class="mt-0 font-size-16">'.$row['name'].'</h5> Categories: '.$row['categories'].' <br> Owner: '.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'
    </div>
    </div>
    <br>
    <h5>Products</h5><br>
    <div class="row">

    ';  
  }

  $query = "SELECT * FROM products WHERE store_id = '".$store_name."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  

    <div class="col-3">
    <div class="card">
    <img class="card-img-top" src="files/'.$row['picture'].'" style="height:173px;width:300px;" alt="Card image cap">
    <div class="card-body">
    <h4 class="card-title mt-0">Name: '.$row['name'].'</h4>
    <p class="card-text">Meal Category: '.$row['category'].'</p>
    <p class="card-text">Description: '.$row['description'].'</p>
    <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details1'].'</p>
    <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details2'].'</p>
    <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details3'].'</p>
    <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details4'].'</p>
    <p class="card-text">Price: '.$row['price'].'</p>
    </div>
    </div>
    </div>

    ';  
  }

  $output .= '  

  </div>

  ';  
  
  echo $output;  
}  
?>