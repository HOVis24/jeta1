<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    header("location: login.php");
    exit;
}

$Store_name = $_SESSION['store'];
?>
<?php include('includes/head.php') ?>

<?php include('includes/header.php') ?>

<?php include('includes/sidebar.php') ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
    img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <?php include('includes/pagetitle.php') ?>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary btn-md waves-effect waves-light" id="" data-toggle="modal" data-target="#addstudentmodal">Add Confirmed Registrations</button><br><br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Registration Requests</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Registration Date</th>
                                    <th>Store Name</th>
                                    <th>Store Address</th>
                                    <th>Owner</th>
                                    <th>Owner Address</th>
                                    <th>Email Address</th>
                                    <th>Logo</th>
                                    <th>Brgy Clearance</th>
                                    <th>Business Permits</th>
                                    <th>Sample Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');
                                $sqlSelect = "SELECT * FROM store_registration WHERE Registration_status = 'Pending' Order By Registration_status DESC";
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['registration_id']; ?></td>
                                            <td><b><?php echo $row['Registration_status']; ?></b></td>
                                            <td><?php echo $row['Store_date']; ?></td>
                                            <td><b><?php echo $row['Store_name'] ?></b></td>
                                            <td><?php echo $row['Store_address']; ?></td>
                                            <td><b><?php echo $row['Owner_name']; ?></b></td>
                                            <td><?php echo $row['Owner_address']; ?></td>
                                            <td><?php echo $row['Store_emailadd']; ?></td>
                                            <td style="width:100px;"><img src="storeregistration/<?php echo $row['Store_logo']; ?>" alt="<?php echo $row['Store_name']; ?>" style="width:100px;"></td>
                                            <td style="width:100px;"><img src="storeregistration/<?php echo $row['Store_brgyclearance']; ?>" alt="<?php echo $row['Store_name']; ?>" style="width:100px;"></td>
                                            <td style="width:100px;"><img src="storeregistration/<?php echo $row['Store_bir_dti']; ?>" alt="<?php echo $row['Store_name']; ?>" style="width:100px;"></td>
                                            <td style="width:100px;"><img src="storeregistration/<?php echo $row['Store_menu']; ?>" alt="<?php echo $row['Store_name']; ?>" style="width:100px;"></td>           
                                            <td>
                                                <a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/confirm_registration.php?id=<?php echo $row['registration_id']; ?>&table=store_registration" aria-expanded="false">Confirm</a>
                                                <a class="btn btn-sm btn-outline-danger" aria-haspopup="true" href="controllers/terminate_registration.php?id=<?php echo $row['registration_id']; ?>&table=store_registration" aria-expanded="false">Void</a>
                                            </td>
                                    </tr>
                                <?php } 
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    <!-- end row -->
    <!--  Edit Subject Modal -->

<!--  Add Student Modal -->
<div class="modal fade bs-example-modal-xl" id="addstudentmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Add Store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card"> 
                        <div class="card-body">
                            <h4 class="card-title">Please Fill Up The Form Below</h4>
                            <form class="needs-validation" id="form" novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip01">Store Name</label>
                                            <input type="text" class="form-control" id="validationTooltip01" placeholder="Name" name="name" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip02">Picture</label>
                                            <input type="file" class="form-control" id="validationTooltip02" placeholder="Middle Name" name="file" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label class="control-label">Category</label>
                                            <br>
                                            <select class="form-control select2" id="validationTooltip05" multiple name="categories[]" style="width: 325px;" required>
                                                <option>Fast Food</option>
                                                <option>Chicken</option>
                                                <option>Pasta</option>
                                                <option>Beverages</option>
                                                <option>Japanese</option>
                                                <option>Chinese</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip06">Owner Name</label>
                                            <select class="form-control user_type" id="validationTooltip06" name="owner_name" required>
                                                    <option selected value=" ">Select Owner From Users</option>
                                                    <?php 
                                                    require_once('controllers/connection.php');
                                                    $sqlSelect = "SELECT * FROM users WHERE user_type = 'Owner'";
                                                    $result = mysqli_query($con, $sqlSelect);

                                                    if (mysqli_num_rows($result) > 0)
                                                    {
                                                        while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?> <?php echo $row['middle_name']; ?>. <?php echo $row['last_name']; ?></option>
                                                        <?php } 
                                                    } ?>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip07">Administrator</label>
                                            <select class="form-control user_type" id="validationTooltip07" name="admin_name" required>
                                                    <option selected value=" ">Select Administrator</option>
                                                    <?php 
                                                    require_once('controllers/connection.php');
                                                    $sqlSelect = "SELECT * FROM users WHERE user_type = 'Administrator'";
                                                    $result = mysqli_query($con, $sqlSelect);

                                                    if (mysqli_num_rows($result) > 0)
                                                    {
                                                        while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?> <?php echo $row['middle_name']; ?>. <?php echo $row['last_name']; ?></option>
                                                        <?php } 
                                                    } ?>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip08">Admin Assistant</label>
                                            <select class="form-control user_type" id="validationTooltip08" name="assistant_name" required>
                                                    <option selected value=" ">Select Admin Assistant</option>
                                                    <?php 
                                                    require_once('controllers/connection.php');
                                                    $sqlSelect = "SELECT * FROM users WHERE user_type = 'Assistant Administrator'";
                                                    $result = mysqli_query($con, $sqlSelect);

                                                    if (mysqli_num_rows($result) > 0)
                                                    {
                                                        while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?> <?php echo $row['middle_name']; ?>. <?php echo $row['last_name']; ?></option>
                                                        <?php } 
                                                    } ?>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip09">Staff</label>
                                            <select class="form-control user_type" id="validationTooltip09" name="staff_name" required>
                                                    <option selected value=" ">Select Store Staff</option>
                                                    <?php 
                                                    require_once('controllers/connection.php');
                                                    $sqlSelect = "SELECT * FROM users WHERE user_type = 'Staff'";
                                                    $result = mysqli_query($con, $sqlSelect);

                                                    if (mysqli_num_rows($result) > 0)
                                                    {
                                                        while ($row = mysqli_fetch_array($result)) { ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name']; ?> <?php echo $row['middle_name']; ?>. <?php echo $row['last_name']; ?></option>
                                                        <?php } 
                                                    } ?>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary" id="addstudent" type="submit">Add Store</button>
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
        $("#form").on('submit',(function(e) {
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

        $("#addproductform").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "controllers/addproduct.php",
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

        $(document).on('click', '.btnaddproduct', function(){ 
            var id = $(this).attr("id"); 
            $('#idstore').attr('value', id) 
            $('#addproduct').modal('show');  

        });

        $(document).on('click', '.btnviewstore', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                   url:"controllers/storeinfo.php",  
                   method:"POST",  
                   data:{id:id},  
                   success:function(data){  
                      $('.info').html(data);
                      $('#storeinfo').modal('show');  
                  }  
              });  
            }

        });
    });
</script>