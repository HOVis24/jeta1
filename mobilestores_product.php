<?php
session_start();
require_once('controllers/connection.php'); 
$store_id = $_REQUEST["id"];
$store_customerid = $_REQUEST["user_id"];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body data-layout="detached" data-topbar="colored">
    <style type="text/css">
        body{
            background-color:#fafafc;
            font-family: Montserrat;
        }

    </style>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <center><h3><b><?php echo $store_id; ?> Products</b></h3></center><br>
            <center><p>Select Daily Set of Meals</p></center>
            <div class="row">

                    <?php 
                    $output = '';

                      $query = "SELECT * FROM products WHERE store_id='$store_id'";
                      $result = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($result))   
                      { 
                            $product_id = $row['id'];
                            $product_name = $row['name'];
                            $product_description = $row['description'];
                            $product_price = $row['price'];
                            $product_picture = $row['picture'];
                            $product_category = $row['category'];

                            $output .= ' 
                            <div class="col-12">
                                <div class="card">
                                    <div style="padding: 20px;">
                                        <img class="card-img-top" src="files/'.$product_picture.'"  alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0"><h4><b>'.$product_name.'</b></h4></h4>
                                        <p class="card-text">Meal Category: <b>'.$product_category.'</b></p>
                                        <p class="card-text">Description: '.$product_description.'</p>
                                        <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details1'].'</p>
                                        <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details2'].'</p>
                                        <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details3'].'</p>
                                        <p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>'.$row['details4'].'</p>
                                        <p class="card-text"><b>Price: '.$product_price.'</b></p>
                                        <a href="mobilestore_productselected.php?id='.$product_id.'&user_id='.$store_customerid.'&product_name='.$product_name.'&product_description='.$product_description.'&product_price='.$product_price.'&product_picture='.$product_picture.'&product_category='.$product_category.'" class="btn btn-warning waves-effect waves-light" style="color:black">Select Meal</a>
                                    </div>
                                </div>
                            </div>    
                           ';  
                       }
                   echo $output; 
                   ?>
            </div>
        </div>
    </div>
    <!-- end main content-->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>