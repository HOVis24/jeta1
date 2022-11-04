<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
  header("location: login.php");
  exit;

  $store_name = $_SESSION['store'];
}
?>
<?php include('includes/head.php') ?>

<?php include('includes/header.php') ?>

<?php include('includes/sidebar.php') ?>
<!-- ============================================================== -->
<?php 
      require_once('controllers/connection.php');

                $sqlSelect = "SELECT orders.status, count(DISTINCT(orders.order_number)) AS duplicates from orders INNER JOIN products ON orders.product_id=products.id WHERE products.store_id = '$store_name' group by orders.status order by duplicates desc";
                $result = mysqli_query($con, $sqlSelect);
                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                        $status[]  = $row['status']; 
                        $count[] = $row["duplicates"];
                  } 
                }                 
?>
<!-- ============================================================== -->
<div class="main-content">
  <div class="page-content">
    <?php include('includes/pagetitle.php') ?>
    
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

               <center>
                <div style="width:30%;height:10%;text-align:center">
                    <div><h3><b></b><h3></div>       
                    <canvas id="chartjs_bar2"></canvas>       
                </div>
              </center>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Payments Management</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">

              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Name</th>
                  <th>Store</th>
                  <th>Total</th>
                  <th>Date and Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                require_once('controllers/connection.php');
                $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime,orders.status, orders.total, customers.first_name, customers.middle_name, customers.last_name ,stores.name AS store FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE products.store_id = '$store_name'";
                $result = mysqli_query($con, $sqlSelect);

                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                      <td><?php echo $row['order_number']; ?></td>
                      <td><?php echo $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name']; ?></td>
                      <td><?php echo $row['store']; ?></td>
                      <td>
                        <?php echo $row['total']; ?>

                      </td>
                      <td><?php echo $row['datetime']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td>
                        <div class="dropdown">
                          <button id="btnGroupVerticalDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Update Status <i class="mdi mdi-chevron-down"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                            <a class="dropdown-item" href="controllers/updatestatus.php?id=<?php echo $row['order_number']; ?>&status=In the Kitchen">In the Kitchen</a>
                            <a class="dropdown-item" href="controllers/updatestatus.php?id=<?php echo $row['order_number']; ?>&status=On The Way">On the Way</a>
                            <a class="dropdown-item" href="controllers/updatestatus.php?id=<?php echo $row['order_number']; ?>&status=Delivered">Delivered</a>
                          </div>
                          <button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light btnvieworder" id="<?php echo $row['order_number']; ?>">View Order</button>
                        </div>

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
    <div class="modal fade bs-example-modal-xl" id="ordermodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">View Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-lg-12">
              <div class="card"> 
                <div class="card-body">
                 <div id="cont"></div>
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

    $(document).on('click', '.btnvieworder', function(){ 
      var id = $(this).attr("id");  
      if(id != '')  
      {  
        $.ajax({  
         url:"controllers/vieworder.php",  
         method:"POST",  
         data:{id:id},  
         success:function(data){  
          $('#cont').html(data);  
          $('#ordermodal').modal('show');  
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
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar2").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($status); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            label: 'Count ',
                            data:<?php echo json_encode($count); ?>,
                            borderWidth: 3,
                            fill: false,
                            borderColor: 'green',
                            pointBackgroundColor: "rgb(192,192,192)",   
                        }]
                    },
                    options: {
                        legend: {
                        display: false,
                        position: 'bottom',
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
                  }
                });
    </script>