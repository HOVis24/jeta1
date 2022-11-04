<?php 
$id = $_SESSION['id']; 
require_once('controllers/connection.php');
$sqlSelect = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($con, $sqlSelect);
$row = mysqli_fetch_array($result);
$store_name = $row['store'];
?>
<div class="vertical-menu">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-md mx-auto rounded-circle">
            </div>
            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name'] ?></a>
                <p class="text-body mt-1 mb-0 font-size-13"><?php echo $_SESSION['user_type'] ?></p>
                <br>
                <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                    <p class="text-body mt-1 mb-0 font-size-15"><b>Access to all store</b></p>
                <?php 
                    }else{
                ?>      
                    <p class="text-body mt-1 mb-0 font-size-15"><b><?php echo $store_name ?></b></p>
                <?php 
                    }
                ?>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                     <li>
                        <a href="dashboard.php" class="waves-effect <?php if($GET['url'] == "dashboard.php"){ ?> mm-active <?php } ?>">
                            <i class="mdi mdi-airplay"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php" class="waves-effect <?php if($GET['url'] == "users.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="stores.php" class="waves-effect <?php if($GET['url'] == "stores.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Stores</span>
                        </a>
                    </li>
                     <li>
                        <a href="stores_registrations.php" class="waves-effect <?php if($GET['url'] == "stores_registrations.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Stores Registrations</span>
                        </a>
                    </li>
                    <li>
                        <a href="customers.php" class="waves-effect <?php if($GET['url'] == "customers.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Customers</span>
                        </a>
                    </li>
                <?php  } ?>
                <?php  if($_SESSION['user_type'] == "Administrator"){ ?>
                    <li>
                        <a href="users.php" class="waves-effect <?php if($GET['url'] == "users.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="payments.php" class="waves-effect <?php if($GET['url'] == "payments.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a href="financial.php" class="waves-effect <?php if($GET['url'] == "financial.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Financial Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="products.php" class="waves-effect <?php if($GET['url'] == "products.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Manage Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="stores.php" class="waves-effect <?php if($GET['url'] == "stores.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Your Stores</span>
                        </a>
                    </li>
                    <li>
                        <a href="chats.php" class="waves-effect <?php if($GET['url'] == "chats.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Chats</span>
                        </a>
                    </li>
                <?php  } ?>
                <?php  if($_SESSION['user_type'] == "Assistant Administrator"){ ?>
                    <li>
                        <a href="products.php" class="waves-effect <?php if($GET['url'] == "products.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Manage Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="stores.php" class="waves-effect <?php if($GET['url'] == "stores.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Your Stores</span>
                        </a>
                    </li>
                    <li>
                        <a href="chats.php" class="waves-effect <?php if($GET['url'] == "chats.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Chats</span>
                        </a>
                    </li>
                <?php  } ?>
                <?php  if($_SESSION['user_type'] == "Owner"){ ?>
                    <li>
                        <a href="users.php" class="waves-effect <?php if($GET['url'] == "users.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="payments.php" class="waves-effect <?php if($GET['url'] == "payments.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a href="financial.php" class="waves-effect <?php if($GET['url'] == "financial.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Financial Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="products.php" class="waves-effect <?php if($GET['url'] == "products.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Manage Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="stores.php" class="waves-effect <?php if($GET['url'] == "stores.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Your Stores</span>
                        </a>
                    </li>
                    <li>
                        <a href="chats.php" class="waves-effect <?php if($GET['url'] == "chats.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Chats</span>
                        </a>
                    </li>
                <?php  } ?>
                <?php  if($_SESSION['user_type'] == "Staff"){ ?>
                    <li>
                        <a href="ordersmanagement.php" class="waves-effect <?php if($GET['url'] == "ordersmanagement.php"){ ?> mm-active <?php } ?>">
                            <i class="bx bx-user"></i><span class="badge badge-pill badge-info float-right">2</span>
                            <span>Orders Management</span>
                        </a>
                    </li>
                <?php  } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->