<?php
    require_once('controllers/connection.php'); 

    $customer_id = $_POST["customer_id"];
    $store_name = $_POST["store_name"];

    $breakfast_maincourse = $_POST['breakfast_meal']; //product id
    $breakfast_riceqty = $_POST['breakfast_riceqty']; //rice count 
    $breakfast_beverage = $_POST['breakfast_beverage']; //product id

    $breakfast_maincoursename = "";
    $breakfast_quantity = ", Rice (x$breakfast_riceqty), ";
    $breakfast_beveragename = "";

    $lunch_maincourse = $_POST['Lunch_meal']; //product id
    $lunch_riceqty = $_POST['lunch_riceqty']; //rice count 
    $lunch_beverage = $_POST['lunch_beverage']; //product id

    $lunch_maincoursename = "";
    $lunch_quantity = ", Rice (x$lunch_riceqty), ";
    $lunch_beveragename = "";

    $dinner_maincourse = $_POST['Lunch_meal']; //product id
    $dinner_riceqty = $_POST['lunch_riceqty']; //rice count 
    $dinner_beverage = $_POST['lunch_beverage']; //product id

    $dinner_maincoursename = "";
    $dinner_quantity = ", Rice (x$dinner_riceqty), ";
    $dinner_beveragename = "";

    $total_amount = 0;

    $query = "SELECT * FROM products WHERE id='$breakfast_maincourse'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
       $breakfast_maincoursename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }

    $query = "SELECT * FROM products WHERE id='$breakfast_beverage'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
       $breakfast_beveragename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }

    $query = "SELECT * FROM products WHERE id='$lunch_maincourse'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
       $lunch_maincoursename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }

    $query = "SELECT * FROM products WHERE id='$lunch_beverage'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
        $lunch_beveragename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }

    $query = "SELECT * FROM products WHERE id='$dinner_maincourse'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
       $dinner_maincoursename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }

    $query = "SELECT * FROM products WHERE id='$dinner_beverage'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result))   
    { 
       $dinner_beveragename = $row['name'];
       $total_amount = $total_amount + $row['price'];
    }
    
    $rice_price = 10; //default is 10 pesos for the rice
    $query = "SELECT * FROM products WHERE store_id='$store_name' AND name LIKE '%Rice%' OR name LIKE '%rice%' OR name LIKE '%RICE%'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result))   
    { 
        $rice_price = $row['price'];
    }

    $total_amount_of_rice = $rice_price * ($breakfast_riceqty + $lunch_riceqty + $dinner_riceqty);
    $total_amount = $total_amount + $total_amount_of_rice;
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
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

</head>
<body data-layout="detached" data-topbar="colored">

    <style type="text/css">
        body{
            background-color:#fafafc;
            font-family: Montserrat;
        }
        .bootstrap-touchspin-down,.bootstrap-touchspin-up{
            background-color: red;
            border-color: red;
        }

    </style>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <center><h3><b>Plan Checkout</b></h3></center><br>
            <div class="row">
                <form action="mobile_mealplancheckout_confirm.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                    <input type="hidden" name="store_name" value="<?php echo $store_name; ?>">

                    <input type="hidden" name="b1" value="<?php echo $breakfast_maincourse; ?>"> <!-- id of the product not the name -->
                    <input type="hidden" name="b2" value="<?php echo $breakfast_riceqty; ?>">   <!-- rice count -->
                    <input type="hidden" name="b3" value="<?php echo $breakfast_beverage; ?>"> <!-- id of the product not the name -->

                    <input type="hidden" name="l1" value="<?php echo $lunch_maincourse; ?>"> <!-- id of the product not the name -->
                    <input type="hidden" name="l2" value="<?php echo $lunch_riceqty; ?>">      <!-- rice count -->
                    <input type="hidden" name="l3" value="<?php echo $lunch_beverage; ?>"> <!-- id of the product not the name -->

                    <input type="hidden" name="d1" value="<?php echo $dinner_maincourse; ?>"> <!-- id of the product not the name -->
                    <input type="hidden" name="d2" value="<?php echo $dinner_riceqty; ?>">     <!-- rice count -->
                    <input type="hidden" name="d3" value="<?php echo $dinner_beverage; ?>"> <!-- id of the product not the name -->

                    <input type="hidden" name="total" value="<?php echo $total_amount; ?>">
                    <input type="hidden" name="delivery_fee" value="59">
                    <input type="hidden" name="status" value="Order Placed">
                    <div id="div0" class="col-12">      
                        <div class="card bg-warning" style="padding: 20px">
                            <div class="card-body">
                                <center><p class="card-text" ><h4><b>Your Meal Plan</b></h4></p></center>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                                <h4 class="card-title mt-0"><b>Your Break fast</b></h4><br>
                                <h4 class="card-title mt-0"><?php echo $breakfast_maincoursename; echo $breakfast_quantity; echo $breakfast_beveragename;?></h4>
                                <hr style="height:1px;border-width:0;color:gray;background-color:gray">

                                <h4 class="card-title mt-0"><b>Your Lunch</b></h4><br>
                                <h4 class="card-title mt-0"><?php echo $lunch_maincoursename; echo $lunch_quantity; echo $lunch_beveragename;?></h4>
                                <hr style="height:1px;border-width:0;color:gray;background-color:gray">

                                <h4 class="card-title mt-0"><b>Your Dinner</b></h4><br>
                                <h4 class="card-title mt-0"><?php echo $dinner_maincoursename; echo $dinner_quantity; echo $dinner_beveragename;?></h4>
                                
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <center><p class="card-text" ><h4><b>Total Amount: ₱ <?php echo $total_amount ?></b></h4></p></center>                   
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                </div>
                            </div>
                        </div>

                    <div id="div1" class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-0">Date for the plan</h4>
                                    <p class="card-text">Please select your meal plan date and time</p>     
                                    <div class="form-group">
                                        <input name="datetime" id="id" type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div id="div2" class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <center><h4 class="card-title mt-0">PROOF OF PAYMENT</h4></center>
                                    <p class="card-text">Please put the image of your proof of payment</p>
                                    <input type="hidden" name="status" value="Order Placed">
                                    <div class="form-group">
                                        <input name="files" id="id" type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>       
                    <div id="div3" class="col-12">
                        <center><button type="submit" name="submit" class="btn btn-warning waves-effect waves-light">Place Meal Plan</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <!-- form advanced init -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet alert init js-->
    <script src="assets/js/pages/sweet-alerts.init.js"></script>
</body>
</html>
