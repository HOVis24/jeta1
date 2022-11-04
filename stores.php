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

                <?php 
                    if($_SESSION['user_type'] == "Super Administrator")
                    {
                        echo '<button type="button" class="btn btn-primary btn-md waves-effect waves-light" id="" data-toggle="modal" data-target="#addstudentmodal">Add Stores</button><br><br>
                ';
                    }
                ?>
                
                <div class="card">
                    <div class="card-body">

                    <?php 
                        if($_SESSION['user_type'] == "Super Administrator")
                        {
                            echo '<h4 class="card-title">Stores</h4>';
                        }
                        else
                        {
                            echo '<h4 class="card-title">Stores with related names will be considered as branches.</h4>';
                        }
                    ?>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Store Name</th>
                                    <th>Main Owner</th>
                                    <th>Head Administrator</th>
                                    <th>Head Admin Assistant</th>
                                    <th>Head Staff</th>        
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');

                                if($_SESSION["user_type"] == "Super Administrator")
                                {
                                    $sqlSelect = "SELECT * FROM stores";
                                }
                                else
                                {
                                    $sqlSelect = "SELECT * FROM stores WHERE name LIKE '$Store_name%'";
                                }
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name'] ?></td>

                                            <td>
                                                <?php
                                                $owner = $row['owner'];
                                                $sqlSelectt = "SELECT * FROM users WHERE id='$owner'";
                                                $resultt = mysqli_query($con, $sqlSelectt);
                                                $roww = mysqli_fetch_array($resultt);
                                                if($row['owner'] == "")
                                                    { 
                                                        echo "No Ownership Yet"; }else{  echo $roww['first_name']." ".substr($roww['middle_name'],0,1)."."." ".$roww['last_name']; 
                                                    } 
                                                ?>                                              
                                            </td>

                                             <td>
                                                <?php
                                                $admin = $row['admin'];
                                                $sqlSelectt = "SELECT * FROM users WHERE id='$admin'";
                                                $resultt = mysqli_query($con, $sqlSelectt);
                                                $roww = mysqli_fetch_array($resultt);
                                                if($row['admin'] == "")
                                                    { 
                                                        echo "No Admin Yet"; }else{  echo $roww['first_name']." ".substr($roww['middle_name'],0,1)."."." ".$roww['last_name']; 
                                                    } 
                                                ?>                                              
                                            </td>

                                            <td>
                                                <?php
                                                $staff = $row['staff'];
                                                $sqlSelectt = "SELECT * FROM users WHERE id='$staff'";
                                                $resultt = mysqli_query($con, $sqlSelectt);
                                                $roww = mysqli_fetch_array($resultt);
                                                if($row['staff'] == "")
                                                    { 
                                                        echo "No Staff Yet"; }else{  echo $roww['first_name']." ".substr($roww['middle_name'],0,1)."."." ".$roww['last_name']; 
                                                    } 
                                                ?>                                              
                                            </td>

                                            <td>
                                                <?php
                                                $assistant_admin = $row['assistant_admin'];
                                                $sqlSelectt = "SELECT * FROM users WHERE id='$assistant_admin'";
                                                $resultt = mysqli_query($con, $sqlSelectt);
                                                $roww = mysqli_fetch_array($resultt);
                                                if($row['assistant_admin'] == "")
                                                    { 
                                                        echo "No Assistant Yet"; }else{  echo $roww['first_name']." ".substr($roww['middle_name'],0,1)."."." ".$roww['last_name']; 
                                                    } 
                                                ?>                                              
                                            </td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                               <button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light btnviewstore" id="<?php echo $row['id']; ?>">View</button>
                                               <button type="button" class="btn btn-outline-success btn-sm waves-effect waves-light btnaddproduct" id="<?php echo $row['id']; ?>">Add Product</button>
                                               <?php if($row['status'] == 'Inactive' || $row['status'] == '' || $row['status'] == 'Terminated'){ ?>
                                                <a class="btn btn-sm btn-outline-success" aria-haspopup="true" href="controllers/activate.php?id=<?php echo $row['id']; ?>&table=stores" aria-expanded="false">Activate
                                                </a>
                                            <?php } ?>
                                            <?php if($row['status'] == 'Active'){ ?>
                                                <a class="btn btn-sm btn-outline-danger" aria-haspopup="true" href="controllers/terminate.php?id=<?php echo $row['id']; ?>&table=stores" aria-expanded="false">Terminate
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } 
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    <!--  Edit Subject Modal -->
    <div class="modal fade bs-example-modal-xl" id="storeinfo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Store Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                      <div class="card">
                          <div class="card-body">
                            <div class="info"></div>
                            

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
<!-- /.End Edit Subject Modal -->
<div class="modal fade bs-example-modal-xl" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <form class="needs-validation" id="addproductform" novalidate enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="idstore" placeholder="Name" name="id" required>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip011">Product Name</label>
                                        <input type="text" class="form-control" id="validationTooltip011" placeholder="Product Name" name="name" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip012">Product Price</label>
                                        <input type="text" class="form-control" id="validationTooltip012" placeholder="Product Price" name="price" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip013">Picture</label>
                                        <input type="file" class="form-control" id="validationTooltip013" name="files" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip014">Description</label>
                                        <textarea class="form-control" id="validationTooltip014" placeholder="Description" name="description" required></textarea>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip015">Meal Category</label>
                                        <select type="text" class="form-control" id="validationTooltip015" placeholder="Category" name="category" required>
                                            <option disabled="true" selected>Select Meals</option>
                                            <option>Daily Meals</option>
                                            <option>Set of Meals</option>
                                            <option>Main Course for Meal Plan</option>
                                            <option>Beverages for Meal Plan</option>
                                        </select>

                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip016">Product Category 1</label>
                                        <input type="text" class="form-control" id="validationTooltip016" placeholder="Ex: Vegan" name="category1" required>
                                        <div class="valid-tooltip">
                                            Looks good!
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
                                        <label for="validationTooltip017">Product Category 2</label>
                                        <input type="text" class="form-control" id="validationTooltip017" placeholder="Ex: Low Carbs" name="category2" required>
                                        <div class="valid-tooltip">
                                            Looks good!
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
                                        <label for="validationTooltip018">Product Category 3</label>
                                        <input type="text" class="form-control" id="validationTooltip018" placeholder="Ex: No Added Sugar" name="category3" required>
                                        <div class="valid-tooltip">
                                            Looks good!
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
                                        <label for="validationTooltip019">Product Category 4</label>
                                        <input type="text" class="form-control" id="validationTooltip019" placeholder="Ex: No Added Preservative" name="category4" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" id="addstudent" type="submit">Add Product</button>
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
<!-- /.End Edit Subject Modal -->

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
                            <h4 class="card-title"><h3>Please Fill Up The Form Below</h3></h4><br>
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
                                            <label for="validationTooltip02">Store LOGO</label>
                                            <input type="file" class="form-control" id="validationTooltip02" placeholder="Middle Name" name="file" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label class="control-label">Store Category</label>
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
                                <br><h4 class="card-title"><h3>Assign Senior Management Personnel</h3></h4><br>
                                <h4 class="card-title">The selected individual will be the one to be displayed at stores lists. If you cannot find the user, please add the users first before proceeding.</h4><br>
                                <h4 class="card-title">To add more employee`s, the store Owner or Administrator should logged in and go to Users Page then Add User.</h4><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group position-relative">
                                            <label for="validationTooltip06">Main Owner Name</label>
                                            <select class="form-control user_type" id="validationTooltip06" name="owner_name" required>
                                                    <option disabled="true" selected>Select Owner From Users</option>
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
                                            <label for="validationTooltip07">Head Administrator</label>
                                            <select class="form-control user_type" id="validationTooltip07" name="admin_name" required>
                                                    <option disabled="true" selected>Select Administrator</option>
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
                                            <label for="validationTooltip08">Head Admin Assistant</label>
                                            <select class="form-control user_type" id="validationTooltip08" name="assistant_name" required>
                                                    <option disabled="true" selected>Select Admin Assistant</option>
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
                                            <label for="validationTooltip09">Head Staff</label>
                                            <select class="form-control user_type" id="validationTooltip09" name="staff_name" required>
                                                    <option disabled="true" selected>Select Store Staff</option>
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