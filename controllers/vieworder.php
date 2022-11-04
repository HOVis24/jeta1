 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

  <tbody>';  
  require_once('connection.php'); 
  $query = "SELECT orders.id,customer_id,product_id,payment,orders.status,customers.first_name,customers.middle_name,customers.last_name,customers.email,delivery_fee,customers.address,products.name AS product,products.price,products.store_id,stores.name AS store,orders.datetime, total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE orders.order_number = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);  

  $output .= '  

  <tr>
  <td>ID</td>
  <td>'.$row["id"].'</td>
  </tr>
  <tr>
  <td>Name</td>
  <td>'.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'</td>
  </tr>
  <tr>
  <td>Store</td>
  <td>'.$row['store'].'</td>
  </tr>

  
  <td>DateTime</td>
  <td>'.$row['datetime'].'</td>
  </tr>
  <tr>
  <td>Email</td>
  <td>'.$row['email'].'</td>
  </tr>
  <tr>
  <td>Address</td>
  <td>'.$row['address'].'</td>
  </tr>
  <tr>
  <td>Delivery Fee</td>
  <td>'.$row['delivery_fee'].'</td>
  </tr>
  <tr>
  <td>Status</td>
  <td>'.$row['status'].'</td>
  </tr>

  <tr><td colspan="2">Orders</td></tr>

  ';  

  $queryw = "SELECT orders.id,customer_id,product_id,orders.status,customers.first_name,orders.payment,customers.middle_name,customers.last_name,customers.email,customers.address,products.name AS product,products.price,products.store_id,stores.name AS store,orders.datetime,orders.quantity FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE orders.order_number = '".$_POST["id"]."'";
  $resulwt = mysqli_query($con, $queryw);

  while($roww = mysqli_fetch_array($resulwt))   
  {  
    $output .='

    <tr>
    <td>Product</td>
    <td>'.$roww['product']." "."x".$roww["quantity"].'</td>
    </tr>';
  }

  $output .='
  <tr>
  <td>Total</td>
  <td>'.$row['total'].'</td>
  </tr>
  <tr>
  <td>Proof of Payment</td>
  <td><a href="files/'.$row['payment'].'" target="_blank">Proof of Payment</a></td>
  </tr>
  <tr>
  </tbody>
  </table>';



  echo $output;  
}  
?>