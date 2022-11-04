<?php
session_start();
require_once('controllers/connection.php'); 
$id = $_REQUEST["id"];
?>

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
        <center><h2><b>View Stores</b></h2></center><br>
        <div class="row">

            <?php 
              $output = '';

              $query = "SELECT * FROM stores WHERE status='Active'";
              $result = mysqli_query($con, $query);

              while($row = mysqli_fetch_array($result))   
              { 
                    $STORE_ID = $row['id'];
                    $STORE_NAME = $row['name'];
                    $STORE_IMAGE = $row['picture'];
                    $STORE_CATEGORIES = $row['categories'];

                    $product_count = 0;
                    $query2 = "SELECT * FROM products WHERE store_id='$STORE_NAME'";
                    $result2 = mysqli_query($con, $query2);

                     while($row2 = mysqli_fetch_array($result2))   
                     { 
                        $product_count++;
                     }

                    if($product_count > 0)
                    {
                    $output .= ' 
                    <div class="col-md-6 col-xl-3" >
                                <div class="card border border-warning">
                                    <div style="padding: 10px;">
                                    <img class="card-img-top img-fluid" src="files/'.$STORE_IMAGE.'" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                <center><h4 class="card-title mt-0"><h3><b>'.$STORE_NAME.'</b></h3></h4></center>
                                <center><p class="card-text">'.$STORE_CATEGORIES.'</p></center>
                                <center><a href="mobilestores_product.php?id='.$STORE_NAME.'&user_id='.$id.'" class="btn btn-warning waves-effect waves-light"  style="color:black">View Products</a>
                                        <a href="mobile_mealplan.php?id='.$STORE_NAME.'&user_id='.$id.'" class="btn btn-success waves-effect waves-light"  style="color:black">Meal Plan</a>
                                </center>
                                
                            </div>
                        </div>
                    </div>
                   ';  
                    }
                    else
                    {
                    $output .= ' 
                    <div class="col-md-6 col-xl-3" >
                                <div class="card border border-warning">
                                    <div style="padding: 10px;">
                                    <img class="card-img-top img-fluid" src="files/'.$STORE_IMAGE.'" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                <center><h4 class="card-title mt-0"><h3><b>'.$STORE_NAME.'</b></h3></h4></center>
                                <center><p class="card-text">'.$STORE_CATEGORIES.'</p></center>
                                <center><a class="btn btn-delete waves-effect waves-light" style="color:black">Out of stocks</a></center>
                           
                            </div>
                        </div>
                    </div>
                   '; 
                    }


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