<?php
    session_start();
    require_once('controllers/connection.php'); 
    $customer_email = $_REQUEST["email"];
    $result = "";
    $sql = "UPDATE customers SET status='Active' WHERE email='$customer_email'";
    if($con->query($sql) == TRUE)
    {
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
  background-image: url("files/emailconfirmedfinal.png");

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
    }
?>
</body>
</html>
