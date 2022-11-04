<?php 
$id = $_SESSION['id']; 
require_once('controllers/connection.php');
$table = "";
if ($_SESSION['user_type'] == "Student") {
    $table = "students";
}
else
{
    $table = "users";   
}
$sqlSelect = "SELECT * FROM $table WHERE id = '$id'";
$result = mysqli_query($con, $sqlSelect);

$row = mysqli_fetch_array($result);
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

             
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>


                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-2.jpg" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1"><?php echo $_SESSION['first_name'] ?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <button class="dropdown-item" data-toggle="modal" data-target="#account"><i class="bx bx-user font-size-16 align-middle mr-1"></i>Edit Account</button>
                        <a class="dropdown-item text-danger" href="controllers/logout.php"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-settings-outline"></i>
                    </button>
                </div>

            </div>
            <div>
                
                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>


                <div class="dropdown dropdown-mega d-none d-lg-inline-block ml-2">
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mt-0">UI Components</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Lightbox</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Range Slider</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Sweet Alert</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Rating</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Forms</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Tables</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Charts</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mt-0">Applications</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Ecommerce</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Calendar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Email</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Projects</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Tasks</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Contacts</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mt-0">Extra Pages</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Light Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Compact Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Horizontal layout</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Maintenance</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Coming Soon</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Timeline</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">FAQs</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="font-size-14 mt-0">Components</h5>
                                        <div class="px-lg-2">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/github.png" alt="Github">
                                                        <span>GitHub</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                                        <span>Bitbucket</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                                        <span>Dribbble</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                                        <span>Dropbox</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                                        <span>Mail Chimp</span>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="dropdown-icon-item" href="#">
                                                        <img src="assets/images/brands/slack.png" alt="slack">
                                                        <span>Slack</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div>
                                            <div class="card text-white mb-0 overflow-hidden text-white-50" style="background-image: url('assets/images/megamenu-img.png');background-size: cover;">
                                                <div class="card-img-overlay"></div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <h4 class="text-white mb-3">Sale</h4>

                                                            <h5 class="text-white-50">Up to <span class="font-size-24 text-white">50 %</span> Off</h5>
                                                            <p>At vero eos accusamus et iusto odio.</p>
                                                            <div class="mb-4">
                                                                <a href="#" class="btn btn-success btn-sm">View more</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header> <!-- ========== Left Sidebar Start ========== -->
<!--  View Grades Modal -->
<div class="modal fade bs-example-modal-xl" id="account" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Edit Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <form class="needs-validation"  novalidate id="editaccountform">
                            <input type="hidden" class="form-control" id="validationTooltip03" placeholder="First Name" name="edit_id" value="<?php echo $row['id'] ?>"  required>
                            <input type="hidden" class="form-control" id="validationTooltip03" placeholder="First Name" name="table" value="<?php echo $table; ?>"  required>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">First Name</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="First Name" name="edit_first_name" value="<?php echo $row['first_name'] ?>"  required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">Middle Name</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="Middle Name" name="edit_middle_name" value="<?php echo $row['middle_name'] ?>"  required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">Last Name</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="Last Name" name="edit_last_name" value="<?php echo $row['last_name'] ?>"  required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">Email</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="Email" name="edit_email" value="<?php echo $row['email'] ?>"  required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">Password</label>
                                        <input type="password" class="form-control" id="validationTooltip03" placeholder="Password" name="edit_password" value="<?php echo $row['password'] ?>" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip02">Enter Password to Confirm Changes</label>
                                        <input type="password" class="form-control" id="validationTooltip03" placeholder="Password" name="confirm_password"  required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" id="btnupdatesubject" type="submit">Update Account</button>
                        </form>
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
    <!-- /.End View Grades Modal -->