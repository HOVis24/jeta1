<?php
session_start();
require_once('controllers/connection.php'); 
$customer_id = $_REQUEST["user_id"];
$store_name = $_REQUEST["id"];
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
            <center><h3><b>Meal Planning</b></h3></center><br>
            <div class="row">
                <form method="POST" action="mobile_mealplancheckout.php">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                    <input type="hidden" name="store_name" value="<?php echo $store_name?>">
                     <div class="col-12">      
                        <div class="card bg-success" style="padding: 1px">
                            <div class="card-body">
                                <center><p class="card-text" ><h4><b>Create Meal Plan</b></h4></p></center>                 
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                </div>
                            </div>
                        </div>

                         <?php 
                                  $rice_price = 10; //default is 10 pesos for the rice
                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND name LIKE '%Rice%' OR name LIKE '%rice%' OR name LIKE '%RICE%'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    $rice_price = $row['price'];
                                  }
                        ?>

                    <div class="col-12">      
                        <div class="card bg-success" style="padding: 20px">
                            <div class="card-body">
                                <center><p class="card-text" ><h4><b>Break Fast</b></h4></p></center>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <p class="card-text" style="color:Black">Main Course</p> 
                                <select type="text" class="form-control" id="bfm" placeholder="Breakfast Meal" name="breakfast_meal" required>
                                <option disabled="true" value="" >Select Main Course</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Main Course for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>
                                <br>
                                <p class="card-text" style="color:Black">Rice (₱ <?php echo $rice_price ?>)</p> 
                                <input data-toggle="touchspin" type="number" name="breakfast_riceqty" value="1">
                                <br>
                                <p class="card-text" style="color:Black">Beverage</p> 
                                <select type="text" class="form-control" id="bfb" placeholder="Breakfast Beverage" name="breakfast_beverage" required>
                                <option disabled="true" value="" >Select Beverage</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Beverages for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">    
                        <div class="card bg-success" style="padding: 20px">
                            <div class="card-body">
                                <center><p class="card-text" ><h4><b>Lunch</b></h4></p></center>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <p class="card-text" style="color:Black">Main Course</p> 
                                <select type="text" class="form-control" id="lm" placeholder="Lunch Meal" name="Lunch_meal" required>
                                <option disabled="true" value="" >Select Main Course</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Main Course for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>
                                <br>
                                <p class="card-text" style="color:Black">Rice (₱ <?php echo $rice_price ?>)</p>  
                                <input data-toggle="touchspin" type="number" name="lunch_riceqty" value="1">
                                <br>
                                <p class="card-text" style="color:Black">Beverage</p> 
                                <select type="text" class="form-control" id="lb" placeholder="Lunch Beverage" name="lunch_beverage" required>
                                <option disabled="true" value="" >Select Beverage</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Beverages for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">  
                        <div class="card bg-success" style="padding: 20px">
                            <div class="card-body">
                                <center><p class="card-text" ><h4><b>Dinner</b></h4></p></center>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <p class="card-text" style="color:Black">Main Course</p> 
                                <select type="text" class="form-control" id="dm" placeholder="Dinner Meal" name="Dinner_meal" required>
                                <option disabled="true" value="" >Select Main Course</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Main Course for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>
                                <br>
                                <p class="card-text" style="color:Black">Rice (₱ <?php echo $rice_price ?>)</p> 
                                <input data-toggle="touchspin" type="number" name="dinner_riceqty" value="1">
                                <br>
                                <p class="card-text" style="color:Black">Beverage</p> 
                                <select type="text" class="form-control" id="db" placeholder="Dinner Beverage" name="Dinner_beverage" required>
                                <option disabled="true" value="" >Select Beverage</option>                     
                                 <?php 

                                  $query = "SELECT * FROM products WHERE store_id='$store_name' AND category='Beverages for Meal Plan'";
                                  $result = mysqli_query($con, $query);

                                  while($row = mysqli_fetch_array($result))   
                                  { 
                                    echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                  }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="div4" class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <center><button type="submit" class="btn btn-warning waves-effect waves-light">Place Meal Plan</button></center>
                            </div>
                        </div>
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
