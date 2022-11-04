<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    header("location: login.php");
    exit;
}
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

                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Customers</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');
                                $sqlSelect = "SELECT * FROM customers";
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td>
                                             <button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light btnvieworders" id="<?php echo $row['id']; ?>">View Orders</button>
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

    <!--  Add Student Modal -->
    <div class="modal fade bs-example-modal-xl" id="ordersmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Orders</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card"> 
                            <div class="card-body">
                                <div class="cont"></div>
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
        $("#adduserform").on("submit", function(event){
            event.preventDefault();
            var form = $("#adduserform");
            var formValues= $(this).serialize();
            if (form[0].checkValidity() === false) {
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
                              title: 'Email Taken!',
                              showConfirmButton: true,
                              allowOutsideClick: false,
                              
                          })
                        }

                    }
                });
            }
        });

        $(document).on('click', '.btnvieworders', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                   url:"controllers/vieworders.php",  
                   method:"POST",  
                   data:{id:id},  
                   success:function(data){  
                      $('.cont').html(data);  
                      $('#ordersmodal').modal('show');  
                  }  
              });  
            }            
        });
    });
</script>