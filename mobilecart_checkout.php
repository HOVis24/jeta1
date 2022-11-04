<?php
session_start();
require_once('controllers/connection.php'); 
$customer_id = $_REQUEST["user_id"];
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
            <center><h3><b>Checkout</b></h3></center><br>
            <div class="row">
                <form action="mobile_cartcheckout.php" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="card bg-warning" style="padding: 20px">
                            <div class="card-body">
                                <p class="card-text" ><h4><b>Your Orders</b></h4></p>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                    <?php 
                                    $output = '';
                                    $total_amount = 0;
                                      $query = "SELECT cart.id, cart.product_id, cart.quantity, cart.user_id, products.name, products.price, products.picture, products.store_id, products.description, products.category FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.user_id='$customer_id'";
                                      $result = mysqli_query($con, $query);

                                      while($row = mysqli_fetch_array($result))   
                                      { 
                                            $cart_id = $row['id'];
                                            $cart_productid = $row['product_id'];
                                            $cart_quantity = $row['quantity'];
                                            $cart_userid = $row['user_id'];
                                            $product_name = $row['name'];
                                            $product_description = $row['description'];
                                            $product_price = $row['price'];
                                            $product_picture = $row['picture'];
                                            $product_category = $row['category'];
                                            $product_storename = $row['store_id'];
                                            $total_amount += $product_price * $cart_quantity;

                                            $output .= ' 
                                                        <h4 class="card-title mt-0">'.$product_storename.':<br><b>'.$product_name.'</b>  (x'.$cart_quantity.')</h4>
                                                        <input type="hidden" name="cart_id[]" value="'.$cart_id.'">
                                                        <input type="hidden" name="product_id[]" value="'.$cart_productid.'">
                                                        <input type="hidden" name="quantity[]" value="'.$cart_quantity.'">
                                                        <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                                            ';  
                                       }
                                   echo $output; 
                                   ?>
                                        <br>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <p name="delivery_fee" class="card-text" value="59"><h5>Delivery Fee: <b>₱ 59</b></h5></p>
                                        <p name="total" class="card-text"><h4>Total Amount: <b>₱ <?php echo $total_amount; ?></b></h4></p>
                                        <input type="hidden" name="delivery_fee" value="59">
                                        <input type="hidden" name="total" value="<?php echo $total_amount; ?>">
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                        
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-0">Delivery Time</h4>
                                    <p class="card-text">Please put your desired delivery time and date</p>
                                    
                                    <div class="form-group">
                                        <input name="datetime" id="id" type="datetime-local" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-12">
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
                        <center><button type="submit" class="btn btn-warning waves-effect waves-light">Place Order</button></center>
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
<!--
<script type="text/javascript">
    $(document).ready(function() 
    {
        $("#adduserform").on('submit',(function(e) 
        {
            e.preventDefault();
            $.ajax({
                url: "controllers/checkout.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                    $("#err").fadeOut();
                },
                success: function(data)
                {
                    Swal.fire({
                        type: 'success',
                        title: 'Successfully Placed Order!',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        onClose: () => {
                            location.reload();
                        }
                    })
                },
                error: function(e) 
                {
                        Swal.fire({
                        type: 'error',
                        title: "Failed!",
                        showConfirmButton: true,
                        allowOutsideClick: false,

                    })
                }          
            });

        }));

        $(document).on('click', '.btnremove', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                    url:"controllers/remove.php",  
                    method:"POST",  
                    data:{id:id},  
                    success:function(data){  
                       Swal.fire({
                        type: 'success',
                        title: 'Successfully Removed!',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        onClose: () => {
                            location.reload();
                        }
                    })
                   }  
               });  
            }            
        });
    });
</script>-->