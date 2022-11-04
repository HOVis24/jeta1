 <?php  
 if(isset($_POST["id"]))  
 {  
  $GET['url'] = $_SERVER['REQUEST_URI'];
  $output = '<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

  <thead>
  <tr>
  <th>Order ID</th>
  <th>Name</th>
  <th>Store</th>
  <th>Total</th>
  <th>Date and Time</th>
  <th>Status</th>
  </tr>
  </thead>

  <tbody>';  
  require_once('connection.php'); 
  $query = "SELECT DISTINCT(orders.order_number), orders.datetime,orders.status, orders.total, customers.first_name, customers.middle_name, customers.last_name ,stores.name AS store FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE customer_id = '".$_POST["id"]."'";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result))   
  {  
    $output .= '  

    <tr>
    <td>'.$row["order_number"].'</td>
    <td>'.$row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'].'</td>
    <td>'.$row["store"].'</td>
    <td>'.$row["total"].'</td>
    <td>'.$row["datetime"].'</td>
    <td>'.$row["status"].'</td>
    </tr>

    ';  
  }

  $output .='
  </tbody>
  </table>';



  echo $output;  
}  
?>