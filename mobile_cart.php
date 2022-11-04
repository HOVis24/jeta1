<?php
session_start();
require_once('controllers/connection.php'); 
$customer_id = $_REQUEST["id"];
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
            <center><h3><b>Cart</b></h3></center><br>
            <div class="row">                    
                    <?php 
                    $output = '';

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

                            $output .= ' 
                        <div class="col-12">
                            <div class="card">
                                <div style="padding: 20px;">
                                    <img class="card-img-top" src="files/'.$product_picture.'"  alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title mt-0">'.$product_storename.' : '.$product_name.'</h4>
                                    <p class="card-text">'.$product_category.'</p>
                                    <p class="card-text">'.$product_description.'</p>    
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input id="id'.$cart_id.'" type="hidden" value="'.$cart_id.'">
                                        <input data-toggle="touchspin" type="number" id="quantity'.$cart_id.'" value="'.$cart_quantity.'">
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light btnupdate" onclick="return chk('.$cart_id.')">Update</button>                                       
                                    <button type="button" class="btn btn-danger waves-effect waves-light btnremove" id="'.$cart_id.'">Remove</button>
                                </div>
                            </div>
                        </div>
                        ';  
                       }
                   echo $output; 
                   ?>
              </div>
            <center><a href="mobilecart_checkout.php?user_id=<?php echo $customer_id ?>" class="btn btn-warning waves-effect waves-light">Proceed To Checkout</a></center>
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

<script type="text/javascript">
    
    function chk(id)
    {
        var id = $("#id" + id).val();
        var quantity = $("#quantity" + id).val();  
        if(id != '')  
        {  
            $.ajax({  
                url:"controllers/updatecart.php",  
                method:"POST",  
                data:{id:id,quantity:quantity},  
                success:function(data){  
                 Swal.fire({
                    type: 'success',
                    title: 'Successfully Cart Updated!',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    onClose: () => {
                        location.reload();
                    }
                })
             }  
         });  
        }                  
    }

    $(document).ready(function() {
        $("#adduserforms").on("submit", function(event){
            event.preventDefault();
            var form = $("#adduserforms");
            var formValues= $(this).serialize();
            
            $.ajax({
                url:"controllers/updatecart.php",  
                method:"POST",  
                data:formValues,  
                success:function(data)  
                {  
                    if (data == "success") {
                        Swal.fire({
                          type: 'success',
                          title: 'Successfully Added Quantity!',
                          showConfirmButton: true,
                          allowOutsideClick: false,
                          onClose: () => {
                            location.reload();
                        }
                    })
                    }
                    if(data == "error"){
                        Swal.fire({
                          type: 'error',
                          title: 'No changes in quantity!',
                          showConfirmButton: true,
                          allowOutsideClick: false,
                      })
                    }
                }
            });      
        });

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
                        title: 'Successfully Removed to cart!',
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
</script>