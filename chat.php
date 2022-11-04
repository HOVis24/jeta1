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
            <?php 
            require_once('controllers/connection.php');
            $sqlSelect = "SELECT chat.id,customer_id,message,user_type,customers.first_name,customers.middle_name,customers.last_name FROM chat INNER JOIN customers ON customer_id = customers.id ";
            $result = mysqli_query($con, $sqlSelect);

            if (mysqli_num_rows($result) > 0)
            {
              while ($row = mysqli_fetch_array($result)) {
                $status = "";
                $name = "";
                if ($row['user_type'] == "Customer") {
                  $status = "left";
                  $name = $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'];
                }
                else{
                  $status = "right";
                  $name = "JETA";
                }
                ?>

                <div class="row">
                  <div class="col-12">
                    <a href="#" class="media">

                      <div class="media-body chat-user-box" style="text-align: <?php echo $status; ?>">
                        <p class="user-title m-2" style="font-size: 15px;"><?php echo $name; ?></p>
                        <p class="text-muted m-2" style="font-size: 15px;"><?php echo $row['message']; ?></p>
                      </div>
                    </a>
                  </div>
                </div><hr><br>

              <?php }
            } ?>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group position-relative">
                  <label for="validationTooltip01">Enter Message</label>
                  <textarea class="form-control" id="validationTooltip01" placeholder="Message" name="first_name"></textarea>
                  <div class="valid-tooltip">
                    Message Sent!
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary" id="addstudent" type="submit">Send Message</button>
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