<?php 
require_once('controllers/connection.php'); 
$result = "";

try 
{
	$order_number = rand(1000,10000);
	$file_name = $_FILES['files']['name'];
	$file_size =$_FILES['files']['size'];
	$file_tmp =$_FILES['files']['tmp_name'];
	$file_type=$_FILES['files']['type'];
	$extensions= array("pdf","jpg","png","docx","mp4");
	$file = $_FILES['files'];
	$product_id[]=count($_POST['product_id']);
	$cart_id[]=count($_POST['cart_id']);
	

	for($i=0;$i<count($cart_id);$i++)
	{
		$cart_id=$_POST['cart_id'];
		$sql = "DELETE FROM cart WHERE id='$cart_id[$i]'";
		if($con->query($sql) == FALSE)
		{	
			$result = "error";
		}
	}

	for($i=0;$i<count($product_id);$i++)
	{
		date_default_timezone_set("Asia/Singapore");
		//$datetime = date('Y-m-d h:i A');
		$datetime = date('Y-m-d h:i A', strtotime($_POST['datetime']));
		$product_id=$_POST['product_id'];
		$total=$_POST['total'];
		$delivery_fee=$_POST['delivery_fee'];
		$status=$_POST['status'];
		$customer_id=$_POST['customer_id'];
		$quantity=$_POST['quantity'];

		$query = "INSERT INTO orders(product_id,quantity,payment,total,delivery_fee,customer_id,status,datetime,order_number) VALUES('$product_id[$i]','$quantity[$i]','$file_name','$total','$delivery_fee','$customer_id','$status','$datetime','$order_number')";
		move_uploaded_file($file_tmp,"files/".$file_name);
		if($con->query($query) == TRUE)
		{
			$result = "success";	
		}
		else
		{
			$result = "error";	
		}
	}
}
catch(Exception $e)
{
	$result = 'error'.$e;	
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
  background-image: url("files/success_checkout.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: fit;
}

.bg2 {
  /* The image used */
  background-image: url("files/failed_checkout.jpg");

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
    	echo '<div class="bg2">'.$result.'</div>';
    }
    ?>
</body>
</html>