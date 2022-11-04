<?php
session_start();
require_once('controllers/connection.php'); 
$customer_id= $_REQUEST["user_id"];
    
    date_default_timezone_set("Asia/Singapore");
    $end_date = date('Y-m-d');
    $today_date = date('Y-m-d h:i A');

    $query2 = "SELECT datetime FROM orders WHERE customer_id = '$customer_id' AND status <> 'Delivered'";
    $result2 = mysqli_query($con, $query2);
    while($row2 = mysqli_fetch_array($result2))   
    { 
      if(strtotime($end_date) < strtotime($row2['datetime'])) // check if the next data ( date time ) is higher than the previous one. if yes it will update the end_date else it won`t update the end_date and use the previously fetch date
      {
        $end_date = $row2['datetime']; 
      }
    }

    $totalSecondsDiff = strtotime($end_date) - strtotime($today_date);
    $minutes = floor(($totalSecondsDiff / 60));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
</head>
<body data-layout="detached" data-topbar="colored">

    <style type="text/css">
        body{
            background-color:#fafafc;
            font-family: Montserrat;
        }
        .bootstrap-touchspin-down,.bootstrap-touchspin-up{
            background-color: red;
            border-color: red;
        }
        .base-timer {
          position: relative;
          width: 100px;
          height: 100px;
        }

        .base-timer__svg {
          transform: scaleX(-1);
        }

        .base-timer__circle {
          fill: none;
          stroke: none;
        }

        .base-timer__path-elapsed {
          stroke-width: 7px;
          stroke: grey;
        }

        .base-timer__path-remaining {
          stroke-width: 7px;
          stroke-linecap: round;
          transform: rotate(90deg);
          transform-origin: center;
          transition: 1s linear all;
          fill-rule: nonzero;
          stroke: currentColor;
        }

        .base-timer__path-remaining.green {
          color: rgb(65, 184, 131);
        }

        .base-timer__path-remaining.orange {
          color: orange;
        }

        .base-timer__path-remaining.red {
          color: red;
        }

        .base-timer__label {
          position: absolute;
          width: 100px;
          height: 100px;
          top: 0;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 25px;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <center><h3><b>Order Status</b></h3></center><br>
            <div class="row">
                <form class="needs-validation" id="adduserform" novalidate>

                                <div class="col-12">
                                    <div class="card bg-warning" style="padding: 20px">
                                        <div class="card-body">
                                            <center><div id="app"></div></center>
                                            <center><p style="font-weight: Bold">Remaining Time(hour) Left</p></center>
                                            <br>
                                             <?php
                                              $query2 = "SELECT DISTINCT(order_number), datetime, status, total FROM orders WHERE customer_id = '$customer_id' AND status <> 'Delivered'";
                                              $result2 = mysqli_query($con, $query2);
                                              while($row2 = mysqli_fetch_array($result2))   
                                              { 
                                                    $order_number = $row2['order_number'];            
                                                    $order_datetime = $row2['datetime'];      
                                                    $order_status = $row2['status'];
                                                    $order_total = $row2['total'];

                                                    echo '<h4>Order Summary # <b> '.$order_number.'</b></h4>';
                                                    echo '<h4 class="card-title mt-0">Expected Delivery Time: <b>'.$order_datetime.'</b></h4>';  
                                                    echo '              <hr style="height:1px;border-width:0;color:gray;background-color:gray">';
                                                    echo '<h4>Total Amount: <b> ₱ '.$order_total.'</b></h4>';
                                                    if($order_status == 'Order Placed')
                                                    { 
                                                        echo '<p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>Order Placed</p>'; 
                                                    }
                                                    else
                                                    {
                                                        echo '<p style="font-weight: "><i class="mdi mdi-check text-primary mr-4"></i>Order Placed</p>';
                                                    }

                                                    if($order_status == 'In the Kitchen')
                                                    { 
                                                        echo '<p style="font-weight: bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>In the Kitchen</p>'; 
                                                    }
                                                    else
                                                    {
                                                        echo '<p style="font-weight: "><i class="mdi mdi-check text-primary mr-4"></i>In the Kitchen</p>'; 
                                                    }

                                                     if($order_status == 'On The Way')
                                                    { 
                                                        echo '<p style="font-weight: Bold"><i class="mdi mdi-check-bold text-primary mr-4"></i>On The Way</p>'; 
                                                    }
                                                    else
                                                    {
                                                        echo '<p style="font-weight: "><i class="mdi mdi-check text-primary mr-4"></i>On The Way</p>'; 
                                                    }
                                                     echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray"><br>';
                                              }
                                              ?>
                                         </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card bg-warning" style="padding: 20px">
                                        <div class="card-body">
                                            <h4>Ordered Meals: </b></h4>
                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                 <?php
                                      $count = 0;
                                      $query2 = "SELECT DISTINCT(order_number), datetime, status, total, product_id, quantity, delivery_fee FROM orders WHERE customer_id = '$customer_id' AND status <> 'Delivered'";
                                      $result2 = mysqli_query($con, $query2);
                                      while($row2 = mysqli_fetch_array($result2))   
                                      { 
                                            $count++;
                                            $order_number = $row2['order_number'];
                                            $order_datetime = $row2['datetime'];
                                            $order_status = $row2['status'];
                                            //$order_total = $row2['total'];
                                            $order_productid = $row2['product_id'];
                                            $order_quantity = $row2['quantity'];
                                            $order_deliveryfee = $row2['delivery_fee'];                  
                                            $product_price = 0;
                                            $product_store = '';
                                            $product_name = '';
                                            $output = '';
                                            $query = "SELECT * FROM products WHERE id=$order_productid";
                                            $result = mysqli_query($con, $query);
                                            while($row = mysqli_fetch_array($result))   
                                            { 
                                                $product_store = $row['store_id'];
                                                $product_name = $row['name'];
                                                $product_price = $row['price'];   

                                                $output .= ' <h4 class="card-title mt-0">'.$product_store.' : <b>'.$product_name.'</b> (x'.$order_quantity.')</h4>';    
                                            }
                                            $order_total = $product_price * $order_quantity;
                                            echo $output;                                        
                                         }
                                         if($count == 0)
                                         { 
                                            echo '<h4>No Ongoing Order Yet</h4>';                         
                                         }         
                                    ?>
                                        </div>
                                    </div>
                                </div>
                </form>
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <!-- form advanced init -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet alert init js-->
    <script src="assets/js/pages/sweet-alerts.init.js"></script>
</body>
</html>

<script>
    const FULL_DASH_ARRAY = 283;
    const WARNING_THRESHOLD = 10;
    const ALERT_THRESHOLD = 5;

    const COLOR_CODES = {
      info: {
        color: "blue"
      },
      warning: {
        color: "orange",
        threshold: WARNING_THRESHOLD
      },
      alert: {
        color: "red",
        threshold: ALERT_THRESHOLD
      }
    };

    const TIME_LIMIT = <?php echo json_encode($minutes); ?>;
    let timePassed = 0;
    let timeLeft = TIME_LIMIT;
    let timerInterval = null;
    let remainingPathColor = COLOR_CODES.info.color;

    document.getElementById("app").innerHTML = `
    <div class="base-timer">
      <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <g class="base-timer__circle">
          <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
          <path
            id="base-timer-path-remaining"
            stroke-dasharray="283"
            class="base-timer__path-remaining ${remainingPathColor}"
            d="
              M 50, 50
              m -45, 0
              a 45,45 0 1,0 90,0
              a 45,45 0 1,0 -90,0
            "
          ></path>
        </g>
      </svg>
      <span id="base-timer-label" class="base-timer__label">${formatTime(
        timeLeft
      )}</span>
    </div>
    `;

    startTimer();

    function onTimesUp() {
      clearInterval(timerInterval);
    }

    function startTimer() {
      timerInterval = setInterval(() => {
        timePassed = timePassed += 1;
        timeLeft = TIME_LIMIT - timePassed;
        document.getElementById("base-timer-label").innerHTML = formatTime(
          timeLeft
        );
        setCircleDasharray();
        setRemainingPathColor(timeLeft);

        if (timeLeft === 0) {
          onTimesUp();
        }
      }, 60000);
    }

    function formatTime(time) {
      const minutes = Math.floor(time / 60);
      let seconds = time % 60;

      if (seconds < 10) {
        seconds = `0${seconds}`;
      }

      return `${minutes}:${seconds}`;
    }

    function setRemainingPathColor(timeLeft) {
      const { alert, warning, info } = COLOR_CODES;
      if (timeLeft <= alert.threshold) {
        document
          .getElementById("base-timer-path-remaining")
          .classList.remove(warning.color);
        document
          .getElementById("base-timer-path-remaining")
          .classList.add(alert.color);
      } else if (timeLeft <= warning.threshold) {
        document
          .getElementById("base-timer-path-remaining")
          .classList.remove(info.color);
        document
          .getElementById("base-timer-path-remaining")
          .classList.add(warning.color);
      }
    }

    function calculateTimeFraction() {
      const rawTimeFraction = timeLeft / TIME_LIMIT;
      return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
    }

    function setCircleDasharray() {
      const circleDasharray = `${(
        calculateTimeFraction() * FULL_DASH_ARRAY
      ).toFixed(0)} 283`;
      document
        .getElementById("base-timer-path-remaining")
        .setAttribute("stroke-dasharray", circleDasharray);
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#adduserform").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "controllers/updatecart.php",
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
        title: 'Successfully Placed Order!',
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

        $(document).on('click', '.btnremove', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                $.ajax({  
                    url:"controllers/remove.php",  
                    method:"POST",  
                    data:{id:id},  
                    success:function(data){  
                     Swal.fire({
                        type: 'success',
                        title: 'Successfully Removed!',
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