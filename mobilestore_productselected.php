<?php
session_start();
require_once('controllers/connection.php'); 
$product_id = $_REQUEST["id"];
$store_customerid = $_REQUEST["user_id"];
$product_name = $_REQUEST['product_name'];
$product_description = $_REQUEST['product_description'];
$product_price = $_REQUEST['product_price'];
$product_picture = $_REQUEST['product_picture'];
$product_category = $_REQUEST['product_category'];
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

            <center><h3><b>Product Overview</b></h3></center><br>
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div style="padding: 20px;">
                                <img class="card-img-top" src="files/<?php echo $product_picture; ?>"  alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title mt-0"><h4><b><?php echo $product_name; ?></b></h4></h4>
                                <p class="card-text">Category: <?php echo $product_category; ?></p>
                                <p class="card-text">Description: <?php echo $product_description; ?></p>
                                <p class="card-text"><b>Price: <?php echo $product_price; ?></b></p>

                                <form class="needs-validation" id="adduserform" novalidate>
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input name="id" type="hidden" value="<?php echo $product_id; ?>">
                                        <input name="user_id" type="hidden" value="<?php echo $store_customerid; ?>">
                                        <input data-toggle="touchspin" type="number" name="quantity" value="1">
                                    </div>
                                    <center><button type="submit" class="btn btn-warning waves-effect waves-light btnaddtocart" style="color:black">Add to Cart</button></center>
                                </form>
                            </div>
                        </div>
                    </div>    
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
                url: "controllers/addtocart.php",
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
        title: 'Successfully Added!',
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

        $(document).on('click', '.btneditproduct', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                   url:"controllers/productinfo.php",  
                   method:"POST",  
                   data:{id:id},  
                   success:function(data){  
                      $('#cont').html(data);  
                      $('#productmodal').modal('show');  
                  }  
              });  
            }            
        });
    });
</script>