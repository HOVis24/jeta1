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
                        <h4 class="card-title">Messages</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="studentstable">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require_once('controllers/connection.php');
                                $sqlSelect = "SELECT DISTINCT(customer_id), chat.store,user_type,customers.first_name,customers.middle_name,customers.last_name FROM chat INNER JOIN customers ON customer_id = customers.id WHERE chat.store LIKE '$Store_name%' AND chat.user_type = 'Customer'";
                                $result = mysqli_query($con, $sqlSelect);

                                if (mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light viewmessages" id="<?php echo $row['customer_id']; ?>">View Conversation</button>
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
                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">View Messages</h5>
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
                                 <div id="cont2"></div>
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

    $(document).ready(function() 
    {
        $('.mop').hide();
        $("#adduserform").on("submit", function(event)
        {
            event.preventDefault();
            var form = $("#adduserform");
            var formValues= $(this).serialize();
            if (form[0].checkValidity() === false) 
            {
                event.stopPropagation();
            }
            else
            {
                $.ajax({
                    url:"controllers/message.php",  
                    method:"POST",  
                    data:formValues,  
                    success:function(data)  
                    {  
                        if (data != '') 
                        {    
                            var id = data;  
                            if(id != '')  
                            {   

                                $.ajax
                                ({  
                                    url:"controllers/viewmessages.php",  
                                    method:"POST",  
                                    data:{id:id},  
                                    success:function(data)
                                    {  
                                        $('#cont').html(data);  
                                        //$('#ordermodal').modal('show');  
                                    }  
                                });  

                                $.ajax
                                ({  
                                    url:"controllers/inputmessages.php",  
                                    method:"POST",  
                                    data:{id:id},  
                                    success:function(data)
                                    {  
                                        $('#cont2').html(data);  
                                        //$('#ordermodal').modal('show');  
                                    }  
                                });  
                                var scrollss = document.getElementById('ordermodal');
                                scrollss.scrollTop = scrollss.scrollHeight;

                                setInterval(function()
                                { //to reload
                                    $.ajax
                                    ({  
                                         url:"controllers/viewmessages.php",  
                                         method:"POST",  
                                         data:{id:id},  
                                         success:function(data)
                                         {  
                                            $('#cont').html(data);  
                                            //$('#ordermodal').modal('show');  
                                         }  
                                    });  

                                      var scrollss = document.getElementById('ordermodal');
                                      scrollss.scrollTop = scrollss.scrollHeight;

                                }, 2000);
                            } 
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

        $(document).on('click', '.viewmessages', function(){ 
            var id = $(this).attr("id");  
            if(id != '')  
            {  
                setInterval(function()
                { //to reload
                $.ajax({  
                 url:"controllers/viewmessages.php",  
                 method:"POST",  
                 data:{id:id},  
                 success:function(data)
                 {  
                    $('#cont').html(data);  
                    $('#ordermodal').modal('show');  
                 }   
                });  
                var scrollss = document.getElementById('ordermodal');
                                      scrollss.scrollTop = scrollss.scrollHeight;
                }, 2000);

                $.ajax({  
                 url:"controllers/inputmessages.php",  
                 method:"POST",  
                 data:{id:id},  
                 success:function(data)
                 {  
                    $('#cont2').html(data);  
                    $('#ordermodal').modal('show');  
                 }   
            });  
                var scrollss = document.getElementById('ordermodal');
                scrollss.scrollTop = scrollss.scrollHeight;
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