<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
  header("location: login.php");
  exit;
}

  $store_name = $_SESSION['store'];
?>
<?php include('includes/head.php') ?>

<?php include('includes/header.php') ?>

<?php include('includes/sidebar.php') ?>
<!-- ============================================================== -->
<?php 
            require_once('controllers/connection.php');
   
            if(isset($_POST['but_search']))
            { 
              $startDate = date('Y-m-d', strtotime($_POST['dateFrom']));
              $endDate = date('Y-m-d', strtotime($_POST['dateTo']));
              $date[] = "";
              $amount[] = "";
                $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE products.store_id = '$store_name' AND orders.status='Delivered' AND orders.datetime BETWEEN STR_TO_DATE('$startDate','%Y-%m-%d') AND STR_TO_DATE('$endDate','%Y-%m-%d')";
                $result = mysqli_query($con, $sqlSelect);
                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                      $date[] = $row['datetime'];
                      $amount[] = $row['total'];
                  } 
                }
            }
            else if(!isset($_POST['but_search']))
            { 
              $date[] = "";
              $amount[] = "";
              $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE products.store_id = '$store_name' AND orders.status='Delivered'";
                $result = mysqli_query($con, $sqlSelect);
                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                      $date[] = $row['datetime'];
                      $amount[] = $row['total'];
                  } 
                }
            }

                
                $sales = 0;
                $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE stores.name = '$store_name' AND orders.status='Delivered'";
                $result = mysqli_query($con, $sqlSelect);

                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                    $sales = $sales + $row['total'];
                  }
                }
                $total_sales = number_format($sales,2,'.',',');

                $date_time_now = date('Y-m-d');
                $sales = 0;
                $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE stores.name = '$store_name' AND orders.status='Delivered' AND orders.datetime LIKE '$date_time_now%'";
                $result = mysqli_query($con, $sqlSelect);

                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                    $sales = $sales + $row['total'];
                  }
                }
                $todaysales = number_format($sales,2,'.',',');

                $date_today = date('Y-m-d'); 
                $firstdayofthemonth = date('Y-m-01', strtotime($date_today));
                $lastdayofthemonth = date('Y-m-t', strtotime($date_today));
                $sales = 0;
                $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE stores.name = '$store_name' AND orders.status='Delivered' AND orders.datetime BETWEEN '$firstdayofthemonth' AND '$lastdayofthemonth'";
                $result = mysqli_query($con, $sqlSelect);

                if (mysqli_num_rows($result) > 0)
                {
                  while ($row = mysqli_fetch_array($result)) 
                  {
                    $sales = $sales + $row['total'];
                  }
                }
                $monthlysales = number_format($sales,2,'.',',');
                $weekly = $sales / 4;
                $weeklysales = number_format($weekly,2,'.',',');
                $this_month = date('M');
?>
<!-- ============================================================== -->
<div class="main-content">
  <div class="page-content">
    <?php include('includes/pagetitle.php') ?>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
               <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<form method='post' style="margin-bottom: -5px;"> 
<center> 
    <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-line"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2"><h3>TOTAL SALES</h3></div>
                            </div>
                        </div>
                        <h4 class="mt-4">₱ <?php echo $total_sales; ?></h4>        
                    </div>
                </div>
            </div> <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-line"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2"><h3>TODAY SALES</h3></div>
                            </div>
                        </div>
                        <h4 class="mt-4">₱ <?php echo $todaysales; ?></h4>           
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-line"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2"><h3>WEEKLY SALES (<?php echo  $this_month; ?>)</h3></div>
                            </div>
                        </div>
                        <h4 class="mt-4">₱ <?php echo $weeklysales; ?></h4>            
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                    <i class="mdi mdi-chart-line"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <div class="font-size-16 mt-2"><h3>MONTHLY SALES (<?php echo  $this_month; ?>)</h3></div>
                            </div>
                       </div>
                        <h4 class="mt-4">₱ <?php echo $monthlysales; ?></h4>          
                    </div>
                </div>
            </div>
        </div>
      </center>

               <center><div style="width:70%;height:10%;text-align:center">
                    <div><h3><b>Financial Report</b><h3></div>       
                    <canvas id="chartjs_bar2"></canvas>       
                </div></center>

            <br>
            <center>
                  <b>Start Date</b> <input class="form-group" type='date' class='dateFilter' name='dateFrom' value='<?php if(isset($_POST['dateFrom'])) echo $_POST['dateFrom']; ?>'>
                  <b>End Date</b> <input class="form-group" type='date' class='dateFilter' name='dateTo' value='<?php if(isset($_POST['dateTo'])) echo $_POST['dateTo']; ?>'>        
                  <input type='submit' name='but_search' value='Search'>
            </center>
            <br>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Financial Report</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Name</th>
                  <th>Store</th>
                  <th>Total</th>
                  <th>Date and Time</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                require_once('controllers/connection.php');
                if(isset($_POST['but_search']))
                { 
                  $startDate1 = date('Y-m-d', strtotime($_POST['dateFrom']));
                  $endDate1 = date('Y-m-d', strtotime($_POST['dateTo']));
                  $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total, customers.first_name, customers.middle_name, customers.last_name ,stores.name AS store FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE stores.name = '$store_name' AND orders.status='Delivered' AND orders.datetime BETWEEN STR_TO_DATE('$startDate1','%Y-%m-%d') AND STR_TO_DATE('$endDate1','%Y-%m-%d')";                   
                }
                else if(!isset($_POST['but_search']))
                {
                  $sqlSelect = "SELECT DISTINCT(orders.order_number), orders.datetime, orders.total, customers.first_name, customers.middle_name, customers.last_name ,stores.name AS store FROM `orders` INNER JOIN customers ON customers.id=orders.customer_id INNER JOIN products ON orders.product_id=products.id INNER JOIN stores ON products.store_id=stores.name WHERE stores.name = '$store_name' AND orders.status='Delivered'";        
                }
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

    </form>
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
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($date); ?>,
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
                            label: 'Total Sales ',
                            data:<?php echo json_encode($amount); ?>,
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