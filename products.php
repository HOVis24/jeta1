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
<div class="main-content">

    <div class="page-content">

        <?php include('includes/pagetitle.php') ?>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Products</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Store</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');
                                $sqlSelect = "SELECT products.id AS prodid, stores.id AS storeid ,products.name AS product,price,stores.name AS store FROM products INNER JOIN stores ON store_id=stores.name WHERE stores.name LIKE '$Store_name%'";
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['prodid']; ?></td>
                                            <td><?php echo $row['store']; ?></td>
                                            <td><?php echo $row['product']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td>
                                             <button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light btneditproduct" id="<?php echo $row['prodid']; ?>">Edit</button>
                                             
                                             <button type="submit" class="btn btn-outline-danger btn-sm waves-effect waves-light btndelete"  id="<?php echo $row['prodid']; ?>">Delete</button>
                                             
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
    <div class="modal fade bs-example-modal-xl" id="productmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card"> 
                            <div class="card-body">
                                <form class="needs-validation" id="adduserform" novalidate>
                                    <div id="cont"></div>

                                    <button class="btn btn-primary" id="bt" type="submit">Update Product</button>
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
        $("#adduserform").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "controllers/updateproduct.php",
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
        title: 'Successfully Updated!',
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

        $(document).on('click', '.btndelete', function(){ 
            var id = $(this).attr("id");
            var table = "products";  
            if(id != '')  
            {  
                $.ajax({  
                 url:"controllers/delete.php",  
                 method:"POST",  
                 data:{id:id,table:table},  
                 success:function(data){  
                  Swal.fire({
                      type: 'success',
                      title: 'Successfully Deleted!',
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