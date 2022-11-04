<?php
session_start();
require_once('controllers/connection.php'); 
$customer_id= $_REQUEST["user_id"];
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
            <center><h3><b>Order History</b></h3></center><br>
            <div class="row">
                <form class="needs-validation" id="adduserform" novalidate>
                    <center>
                                    <?php
                                      
                                      $query2 = "SELECT DISTINCT(order_number), datetime, status, total, product_id, quantity, delivery_fee FROM orders WHERE customer_id = '$customer_id'";
                                      $result2 = mysqli_query($con, $query2);
                                      while($row2 = mysqli_fetch_array($result2))   
                                      { 
                                            $order_number = $row2['order_number'];
                                            $order_datetime = $row2['datetime'];
                                            $order_status = $row2['status'];
                                            //$order_total = $row2['total'];
                                            $order_productid = $row2['product_id'];
                                            $order_quantity = $row2['quantity'];
                                            $order_deliveryfee = $row2['delivery_fee'];

                                            echo '<div class="col-12">';
                                            echo '      <div class="card bg-warning" style="padding: 20px">';
                                            echo '            <div class="card-body">';
                                            echo '                <h4>Order Number: <b>'.$order_number.'</b></h4>';   
                                            echo '                <hr style="height:1px;border-width:0;color:gray;background-color:gray">';    
                                            echo '                <h4 class="card-title mt-0"><i>Date/Time: '.$order_datetime.'</i></h4>'; 
                                            echo '                <h4 class="card-title mt-0"><i>Status: '.$order_status.'</i></h4>';
                                            echo '                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">';
                                            echo '                                </h4><h4><b>Ordered Meals:</b></h4>';     
                                            $product_price = 0;
                                            $product_store = '';
                                            $product_name = '';
                                            $query = "SELECT * FROM products WHERE id=$order_productid";
                                            $result = mysqli_query($con, $query);
                                            while($row = mysqli_fetch_array($result))   
                                            { 
                                                $product_store = $row['store_id'];
                                                $product_name = $row['name'];
                                                $product_price = $row['price'];       
                                            }

                                            $order_total = $product_price * $order_quantity;

                                            echo '<h4 class="card-title mt-0">'.$product_store.' : <b>'.$product_name.'</b> (x'.$order_quantity.')</h4>';   
                                            echo '              <hr style="height:2px;border-width:0;color:gray;background-color:gray">';
                                            echo '              <h4 class="card-title mt-0">Price Amount: <b>₱ '.$order_total.'</b></h4>';
                                            echo '              </div>';
                                            echo '        </div>';
                                            echo '</div>';
                                      }
                                    ?>
                        </center>
                </form>
            </div>
        </div>
        <!-- End Page-content -->
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
    $(document).ready(function() {
        $("#adduserform").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "controllers/updatecart.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
    //$("#preview").fadeOut();
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
</script>