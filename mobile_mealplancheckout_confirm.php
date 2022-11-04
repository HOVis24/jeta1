<?php 
    require_once('controllers/connection.php'); 
	$order_number = rand(1000,10000);
    $customer_id = $_POST["customer_id"];
    $store_name = $_POST["store_name"];
    $rice_id = ""; //product id
    $delivery_fee=$_POST['delivery_fee'];
    $status=$_POST['status'];
	$result = "";
    $datetime = $_POST['datetime'];

    $query = "SELECT * FROM products WHERE store_id='$store_name' AND name LIKE '%Rice%' OR name LIKE '%rice%' OR name LIKE '%RICE%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
        $rice_name = $row['id']; //product id
    }

    $breakfast_maincourse = $_POST['b1']; //product id
    $breakfast_riceqty = $_POST['b2']; //rice count 
    $breakfast_beverage = $_POST['b3']; //product id

    $lunch_maincourse = $_POST['l1']; //product id
    $lunch_riceqty = $_POST['l2']; //rice count 
    $lunch_beverage = $_POST['l3']; //product id

    $dinner_maincourse = $_POST['d1']; //product id
    $dinner_riceqty = $_POST['d2']; //rice count 
    $dinner_beverage = $_POST['d3']; //product id

    $total_amount = $_POST['total'];
    $file_name = $_FILES['files']['name'];
	$file_size =$_FILES['files']['size'];
	$file_tmp =$_FILES['files']['tmp_name'];
	$file_type=$_FILES['files']['type'];
	$extensions= array("pdf","jpg","png","docx","mp4");
	$file = $_FILES['files'];

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$breakfast_maincourse','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$rice_name','$breakfast_riceqty','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$breakfast_beverage','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$lunch_maincourse','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$rice_name','$lunch_riceqty','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$lunch_beverage','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$dinner_maincourse','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$rice_name','$dinner_riceqty','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		
	}

	$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$dinner_beverage','1','$file_name','$total_amount','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
	move_uploaded_file($file_tmp,"files/".$file_name);
	if($con->query($query) == TRUE){
		$result = "success";	
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("files/success_checkout.jpeg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: fit;
}

.bg2 {
  /* The image used */
  background-image: url("files/failed_checkout.jpeg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: fit;
}
</style>
</head>
<body>

<?php 
    if($result == "success")
    {
        echo '<div class="bg"></div>';
    }else{
    	echo '<div class="bg2"></div>';
    }
?>
</body>
</html>