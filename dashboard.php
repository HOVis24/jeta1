<?php session_start();?>
<?php include('includes/head.php') ?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<?php
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){header("location: login.php");exit;}

require_once('controllers/connection.php');

$sqlSelect = "SELECT * FROM users";
$result = mysqli_query($con, $sqlSelect);
$user_count = mysqli_num_rows($result);

$sqlSelect = "SELECT * FROM stores";
$result = mysqli_query($con, $sqlSelect);
$stores_count = mysqli_num_rows($result);

$sqlSelect = "SELECT * FROM stores";
$result = mysqli_query($con, $sqlSelect);
$customer_count = mysqli_num_rows($result);

?>
<div class="main-content">
    <div class="page-content">
        <?php include('includes/pagetitle.php') ?>
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-bar"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2">Users</div>
                            </div>
                        </div>
                        <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                        <h4 class="mt-4"><?php echo $user_count; ?></h4>
                        <?php  }else{ ?>
                        <h4 class="mt-4">Super Administrator Only</h4>
                        <?php  }?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-bar"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2">Stores</div>
                            </div>
                        </div>
                        <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                        <h4 class="mt-4"><?php echo $stores_count; ?></h4>
                        <?php  }else{ ?>
                        <h4 class="mt-4">Super Administrator Only</h4>
                        <?php  }?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-bar"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2">Customers</div>
                            </div>
                        </div>
                        <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                        <h4 class="mt-4"><?php echo $customer_count; ?></h4>
                        <?php  }else{ ?>
                        <h4 class="mt-4">Super Administrator Only</h4>
                        <?php  }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php') ?>
