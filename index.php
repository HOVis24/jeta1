<?php 
require_once('controllers/connection.php');
$error = "";
session_start();
if(isset($_SESSION["logged_in"])){
    header("location: dashboard.php");
    exit;
}
       $message_indicator = "";    
       $message_indicator2 = ""; 
       $error_message = "";
$GET['url'] = basename($_SERVER['PHP_SELF']);

if (isset($_POST['login'])) { 
    $error = "";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $read = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";
    $result = $con->query($read);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['attemps'] = 0;
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['middle_name'] = $row['middle_name'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['store'] = $row['store'];
        $_SESSION["logged_in"] = true;

        if($_SESSION['user_type'] == 'Super Administrator')
        {
        header("Location: dashboard.php");
        }
        else if($_SESSION['user_type'] == 'Administrator')
        {
        header("Location: financial.php");
        }
         else if($_SESSION['user_type'] == 'Owner')
        {
        header("Location: payments.php");
        }
        else if($_SESSION['user_type'] == 'Staff')
        {
        header("Location: ordersmanagement.php");
        }
        else if($_SESSION['user_type'] == 'Assistant Administrator')
        {
        header("Location: products.php");
        }
    }
    else
    {
        if(!ISSET($_SESSION['attempt'])){
            $_SESSION['attempt'] = 0;
        }
            $_SESSION['attempt'] += 1;
        if ($_SESSION['attempt'] === 3) {
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        You tried to login '.$_SESSION['attempt'].' times! Forgot your password? Click Forgot Your Password and Recover your account.
                                        <button type="button"    class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
        } 
        else 
        {
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Invalid Credentials! Attempt '.$_SESSION['attempt'].'.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
        }             
        header("Refresh: 3;Location: login.php"); 
    }
}

if(isset($_POST['registration']))
{
   
   $STORE_NAME = $_POST['storename'];
   $STORE_ADDRESS = $_POST['storeaddress'];
   $OWNER_NAME = $_POST['ownername'];
   $OWNER_ADRESS = $_POST['owneraddress'];
   $OWNER_EMAILADD = $_POST['emailaddress'];
    
    $valid1 = 1;
    $path1 = $_FILES['storelogo_image']['name'];
    $path_tmp1 = $_FILES['storelogo_image']['tmp_name'];
    $LOGO = "Store_Logo";
    if($path1 !='') 
    {
        $ext1 = pathinfo( $path1, PATHINFO_EXTENSION );
        $file_name1 = basename( $path1, '.' . $ext1 );
        if( $ext1!='jpg' && $ext1!='png' && $ext1!='jpeg' && $ext1!='gif' ) 
        {
            $valid1 = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }
    $image1 = "";
    if($valid1 == 1) 
    {
        $final_name1 = $STORE_NAME.''.$LOGO.''.$OWNER_NAME.'.'.$ext1;
        $image1 = $final_name1;
        move_uploaded_file( $path_tmp1, 'storeregistration/'.$final_name1 );
    }
    
    $valid2 = 1;
    $path2 = $_FILES['clearance_image']['name'];
    $path_tmp2 = $_FILES['clearance_image']['tmp_name'];
    $BRG_CLEARANCE = "Brgy_Clearance";
    if($path2 !='') 
    {
        $ext2 = pathinfo( $path2, PATHINFO_EXTENSION );
        $file_name2 = basename( $path2, '.' . $ext2 );
        if( $ext2!='jpg' && $ext2!='png' && $ext2!='jpeg' && $ext2!='gif' ) 
        {
            $valid2 = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

     $image2 = "";
    if($valid2 == 1) 
    {
        $final_name2 = $STORE_NAME.''.$BRG_CLEARANCE.''.$OWNER_NAME.'.'.$ext2;
        $image2 = $final_name2;
        move_uploaded_file( $path_tmp2, 'storeregistration/'.$final_name2 );
    }
    
    $valid3 = 1;
    $path3 = $_FILES['bir_dti_image']['name'];
    $path_tmp3 = $_FILES['bir_dti_image']['tmp_name'];
    $BIR_DTI = "BIRorDTI";
    if($path3 !='') 
    {
        $ext3 = pathinfo( $path3, PATHINFO_EXTENSION );
        $file_name3 = basename( $path3, '.' . $ext3 );
        if( $ext3!='jpg' && $ext3!='png' && $ext3!='jpeg' && $ext3!='gif' ) 
        {
            $valid3 = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

     $image3 = "";
    if($valid3 == 1) 
    {
        $final_name3 = $STORE_NAME.''.$BIR_DTI.''.$OWNER_NAME.'.'.$ext3;
        $image3 = $final_name3;
        move_uploaded_file( $path_tmp3, 'storeregistration/'.$final_name3 );
    }
    
    $valid4 = 1;
    $path4 = $_FILES['menu_image']['name'];
    $path_tmp4 = $_FILES['menu_image']['tmp_name'];
    $MENULIST = "Menu_List";
    
    if($path4 !='') 
    {
        $ext4 = pathinfo( $path4, PATHINFO_EXTENSION );
        $file_name4 = basename( $path4, '.' . $ext4 );
        if( $ext4!='jpg' && $ext4!='png' && $ext4!='jpeg' && $ext4!='gif' ) 
        {
            $valid4 = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    $image4 = "";
    if($valid4 == 1) 
    {
        $final_name4 = $STORE_NAME.''.$MENULIST.''.$OWNER_NAME.'.'.$ext4;
        $image4 = $final_name4;
        move_uploaded_file( $path_tmp4, 'storeregistration/'.$final_name4 );
    }
    


    date_default_timezone_set("Asia/Singapore");
    $datetime = date('Y-m-d H:i A');
    $query = "INSERT INTO store_registration(Store_date, Store_name, Store_address, Owner_name, Owner_address, Store_logo, Store_brgyclearance, Store_bir_dti, Store_menu, Store_emailadd) VALUES('$datetime','$STORE_NAME','$STORE_ADDRESS','$OWNER_NAME','$OWNER_ADRESS','$image1','$image2','$image3','$image4','$OWNER_EMAILADD')";
    if($con->query($query) == TRUE){
        $message_indicator = "Your Registration is successful!";    
        $message_indicator2 = "Please wait for your confirmation."; 
    }else{
        $message_indicator = "Your Registration is failed!";    
        $message_indicator2 = "Please try again."; 
    }
 }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Login | JETA PH</title>
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
<body>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Welcome Back!</h5>
                                <p class="text-white-50 mb-0">Sign in</p>
                                 <center> <a href="" class="logo logo-admin mt-4">
                                  <img src="assets/images/logo-sm-dark.png" alt="" height="30"> 
                                </a></center>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">
                                <form class="form-horizontal" action="login.php" method="post" enctype="multipart/form-data">
                                    <center>
                                        <div class="custom-control custom-checkbox">            
                                        <button type="button" class="btn btn-primary btn-md waves-effect waves-light" id="" data-toggle="modal" data-target="#addstudentmodal">Create Your Store Now!</button><br><br>
                                        <a><?php echo $message_indicator ?></a><br>
                                        <a><?php echo $message_indicator2 ?></a><br>
                                        <a><?php echo $error_message ?></a>
                                    </div>
                                    </center>
                                    <?php echo $error; ?>
                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control" id="username" name="email" placeholder="Enter Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                                    </div>
                                    <br>
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light btnlogin" type="submit" name="login">Log In</button>
                                    </div>

                                    <br>
                                    <center><div class="custom-control custom-checkbox">            
                                        <a href="resetpassword.php" class="text-muted">Forgot Your Password?</a>
                                    </div></center>
                                    
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>© 2021 JETA PH</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="modal fade bs-example-modal-xl" id="addstudentmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Store Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Store Name</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Store Name" name="storename" required>
                                    <div class="valid-tooltip">
                                            Looks good!
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Owner Name ( Full Name )</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Complete Owner Name" name="ownername" required>
                                    <div class="valid-tooltip">
                                            Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01"> Select Store Logo ( Required )</label>
                                    <div class="col-sm-6" style="padding-top:6px;">
                                        <input type="file" name="storelogo_image">
                                    </div>
                                </div>
                            </div>
                           </div>

                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Store Address ( Optional )</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Complete Address" name="storeaddress">
                                    <div class="valid-tooltip">
                                            Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Owner Address ( Complete )</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Complete Owner Address" name="owneraddress" required>
                                    <div class="valid-tooltip">
                                            Looks good!
                                    </div>
                                </div>
                             </div>
                              <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Select brgy clearance ( Image ) ( Required )</label>
                                    <div class="col-sm-6" style="padding-top:6px;">
                                        <input type="file" name="clearance_image">
                                    </div>
                                </div>
                            </div>
                           </div>

                           <div class="row">
                             <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Email Address</label>
                                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Email Address" name="emailaddress" required>
                                    <div class="valid-tooltip">
                                            Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                  
                                </div>
                             </div>
                              <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Select BIR/DTI Permit ( Image ) ( Optional )</label>
                                    <div class="col-sm-6" style="padding-top:6px;">
                                        <input type="file" name="bir_dti_image">
                                    </div>
                                </div>
                            </div>
                           </div>

                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                  
                                </div>
                             </div>
                              <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label for="validationTooltip01">Select Menu List ( Image ) ( Optional )</label>
                                    <div class="col-sm-6" style="padding-top:6px;">
                                        <input type="file" name="menu_image">
                                    </div>
                                </div>
                            </div>
                           </div>
                           <br>

                                <button class="btn btn-primary" name="registration" type="submit">Send Registration Form</button>
                                <br><br> <a>Upon submission of your registration. You will wait for the management confirmation and it will be sent to your email address.</a>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</form>
</body>
</html>
<script type="text/javascript">
        $(document).ready(function() {
        $("#loginform").on("submit", function(event){
            event.preventDefault();
            var form = $("#loginform");
            var formValues= $(this).serialize();
            if (form[0].checkValidity() === false) {
                event.stopPropagation();
            }
            else
            {
                $.ajax({
                    url:"controllers/login.php",  
                    method:"POST",  
                    data:formValues,  
                    success:function(data)  
                    {  
                        if (data == "success") {
                            Swal.fire({
                              type: 'success',
                              title: 'Successfully Logged in!',
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              onClose: () => {
                                window.location.href = "dashboard.php";
                            }
                        })
                        }
                        if(data == "error"){
                            Swal.fire({
                              type: 'error',
                              title: "There's already a schedule for this subject!",
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              onClose: () => {
                                location.reload();
                            }
                        })
                        }

                    }
                });
            }
        });
    });
</script>
<?php include('includes/footer.php') ?>
<script type="text/javascript">

    $(document).ready(function() 
    {
        $("#form").on('submit',(function(e) 
        {
            e.preventDefault();
            $.ajax({
                url: "controllers/addstore.php",
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
    }

  


   
</script>