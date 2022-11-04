<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){header("location: login.php");exit;}

    $store_name = $_SESSION['store'];
?>
<?php include('includes/head.php') ?>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <?php include('includes/pagetitle.php') ?>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-md waves-effect waves-light" id="" data-toggle="modal" data-target="#addstudentmodal">Add User</button><br><br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>Assigned Store</th>
                                    <th>Update Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');
                                if($_SESSION['user_type'] == "Super Administrator")
                                {
                                $sqlSelect = "SELECT * FROM users";
                                }else{
                                $sqlSelect = "SELECT * FROM users WHERE store = '$store_name'";
                                }
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) 
                                    { 
                                        ?>
                                        <tr>
                                            
                                            <td><?php echo $row['id']; ?></td>
                                            <td><b><?php echo $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name']; ?></b></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><b><?php echo $row['user_type']; ?></b></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><b><?php echo $row['store']; ?></b></td>
                                            
                                            <?php
                                                if($_SESSION["user_type"] == "Super Administrator" || $_SESSION["user_type"] == "Administrator")
                                                {
                                                    echo '<td>';
                                                    if($row['user_type'] == "Administrator")
                                                    {
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoassistant.php?id='.$row['id'].'" aria-expanded="false">Assistant</a>';
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetostaff.php?id='.$row['id'].'" aria-expanded="false">Staff</a>'; 
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoowner.php?id='.$row['id'].'" aria-expanded="false">Owner</a>'; 
                                                    }
                                                    else if($row['user_type'] == "Assistant Administrator")
                                                    {
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoadmin.php?id='.$row['id'].'" aria-expanded="false">Admin</a>';
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetostaff.php?id='.$row['id'].'" aria-expanded="false">Staff</a>';
                                                        echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoowner.php?id='.$row['id'].'" aria-expanded="false">Owner</a>';                                               
                                                    }
                                                    else if($row['user_type'] == "Staff")
                                                    {
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoadmin.php?id='.$row['id'].'" aria-expanded="false">Admin</a>';
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoassistant.php?id='.$row['id'].'" aria-expanded="false">Assistant</a>';
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoowner.php?id='.$row['id'].'" aria-expanded="false">Owner</a>';
                                                    }
                                                    else if($row['user_type'] == "Owner")
                                                    {
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoadmin.php?id='.$row['id'].'" aria-expanded="false">Admin</a>';
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetoassistant.php?id='.$row['id'].'" aria-expanded="false">Assistant</a>';
                                                       echo '<a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/upgradetostaff.php?id='.$row['id'].'" aria-expanded="false">Staff</a>';
                                                    }
                                                    else if($row['user_type'] == "Super Administrator")
                                                    {
                                                        echo '<a><b>Fixed Position</b></a>';
                                                    }
                                                    echo '</td>';
                                                }
                                            ?>

                                            <td>
                                             <div class="dropdown">
                                                <?php if($row['status'] == 'Terminated' || $row['status'] == ''){ ?>
                                                    <a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/activate.php?id=<?php echo $row['id']; ?>&table=users" aria-expanded="false">Activate
                                                    </a>
                                                <?php } ?>
                                                <?php if($row['status'] == 'Active'){ ?>
                                                    <a class="btn btn-sm btn-outline-danger" aria-haspopup="true" href="controllers/terminate.php?id=<?php echo $row['id']; ?>&table=users" aria-expanded="false">Terminate
                                                    </a>
                                                <?php } ?>
                                             </div>
                                            </td>
                                        </tr>

                                <?php 
                                    } 
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!--  Add Student Modal -->
    <div class="modal fade bs-example-modal-xl" id="addstudentmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card"> 
                            <div class="card-body">
                                <h4 class="card-title"><h3>Please Fill Up The Form Below</h3></h4><br>
                                <?php
                                    if($store_name != "All Access")
                                    {
                                         echo '<h4 class="card-title">The user will be automatically assigned to this Store.</h4><br>';
                                    }
                                    else
                                    {
                                        echo '<h4 class="card-title">The user will not be assigned to any store yet, select this user as Senior Management Personnel when you create the Store to automatically be assigned.</h4><br>';
                                    }
                                ?>
                                <form class="needs-validation" id="adduserform" novalidate>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="validationTooltip01">First Name</label>
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First Name" name="first_name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="validationTooltip02">Middle Name</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Middle Name" name="middle_name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="validationTooltip03">Last Name</label>
                                                <input type="text" class="form-control" id="validationTooltip03" placeholder="Last Name" name="last_name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="validationTooltip04">Email</label>
                                                <input type="email" class="form-control" id="validationTooltip04" placeholder="Email" name="email" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label for="validationTooltip05">Password</label>
                                                <input type="password" class="form-control" id="validationTooltip05" placeholder="Password" name="password" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label class="control-label">User Type</label>
                                                <select class="form-control user_type" id="validationTooltip06" name="user_type" required>
                                                    <option disabled selected value="">Select User Type</option>
                                                     <?php  if($_SESSION['user_type'] == "Super Administrator"){ ?>
                                                    <option>Super Administrator</option>
                                                    <option>Administrator</option>
                                                    <option>Assistant Administrator</option>
                                                    <option>Staff</option>
                                                    <option>Owner</option>
                                                     <?php  } ?>
                                                     <?php  if($_SESSION['user_type'] == "Owner"){ ?>
                                                    <option>Administrator</option>
                                                    <option>Assistant Administrator</option>
                                                    <option>Staff</option>
                                                    <option>Owner</option>
                                                     <?php  } ?>
                                                    <?php  if($_SESSION['user_type'] == "Administrator"){ ?>
                                                    <option>Assistant Administrator</option>
                                                    <option>Staff</option>
                                                     <?php  } ?>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--
                                    <div class="row mop">
                                        <div class="col-md-4">
                                            <div class="form-group position-relative">
                                                <label class="control-label">Store</label>
                                                <select class="form-control store" id="validationTooltip07" name="store">
                                                    <option selected value="">Select Store</option>
                                                    <?php 
                                                    require_once('controllers/connection.php');
                                                    $sqlSelect = "SELECT * FROM stores";
                                                    $result = mysqli_query($con, $sqlSelect);

                                                    if (mysqli_num_rows($result) > 0)
                                                    {
                                                        while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php } 
                                                    } ?>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <button class="btn btn-primary" id="addstudent" type="submit">Add User</button>
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
    <!-- /.End Add Student Modal -->
</div>
<!-- End Page-content -->

<?php include('includes/footer.php') ?>
<script type="text/javascript">

    $(document).ready(function() {
        $('.mop').hide();
        $("#adduserform").on("submit", function(event){
            event.preventDefault();
            var form = $("#adduserform");
            var formValues= $(this).serialize();
            if (form[0].checkValidity() == false) {
                event.stopPropagation();
            }
            else
            {
                $.ajax({
                    url:"controllers/adduser.php",  
                    method:"POST",  
                    data:formValues,  
                    success:function(data)  
                    {  
                        if (data == "success") {
                            Swal.fire({
                              type: 'success',
                              title: 'Successfully Added!',
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              onClose: () => {
                                location.reload();
                            }
                        })
                        }
                        if (data == "error") {
                            Swal.fire({
                              type: 'error',
                              title: 'Something happened please try again!',
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              
                          })
                        }
                        if (data == "email taken") {
                            Swal.fire({
                              type: 'error',
                              title: 'Email taken!',
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              
                          })
                        }
                    }
                });
            }
        });

        $(document).on('click', '.btnviewstudentinfo', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                   url:"controllers/viewstudentinfo.php",  
                   method:"POST",  
                   data:{id:id},  
                   success:function(data){  
                      $('#studentinfocont').html(data);  
                      $('#studentinfo').modal('show');  
                  }  
              });  
            }            
        });

        
        $(document).on('change', '.user_type', function(){ 
            var val = $(this).val(); 

            if (val != 'Super Administrator') {
                $('.mop').show();
            }
            else{
                $('.mop').hide();
            }
            
        });
    });
</script>