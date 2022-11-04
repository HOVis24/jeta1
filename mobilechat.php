<?php 
session_start();
require_once('controllers/connection.php'); 
include('includes/head.php');
$message_indicator = "";    
$id = $_REQUEST["user_id"];
$store_name = $_REQUEST["store_name"];
$_SESSION["storename"] = $store_name;
?>


<?php
if(isset($_POST["replymessage"]))  
{  	
	$message = $_POST["message"];
	$customer_id = $id;	
	$query = "INSERT INTO chat(message,customer_id,user_type,store) VALUES ('$message','$customer_id','Customer','$store_name')";
	 if($con->query($query) == TRUE)
	 {
        $message_indicator = "Message Sent!";    
     }else{
        $message_indicator = "Message not Sent!";    
     }
     header('location: mobilechat.php?user_id='.$id.'&store_name='.$store_name.'');
}
?>

<Style>
.modal-open {
  overflow: hidden; }
  .modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto; }

.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  display: none;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0; }

.modal-dialogmob {
  position: relative;
  width: auto;
  margin: 0.5rem;
  pointer-events: none; }
  .modal.fade .modal-dialogmob {
    -webkit-transition: -webkit-transform 0.3s ease-out;
    transition: -webkit-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
    -webkit-transform: translate(0, -50px);
            transform: translate(0, -50px); }
    @media (prefers-reduced-motion: reduce) {
      .modal.fade .modal-dialogmob {
        -webkit-transition: none;
        transition: none; } }
  .modal.show .modal-dialogmob {
    -webkit-transform: none;
            transform: none; }
  .modal.modal-static .modal-dialogmob {
    -webkit-transform: scale(1.02);
            transform: scale(1.02); }

.modal-dialogmob-scrollable {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  max-height: calc(100% - 1rem); }
  .modal-dialogmob-scrollable .modal-contentmob {
    max-height: calc(100vh - 1rem);
    overflow: hidden; }
  .modal-dialogmob-scrollable .modal-headermob,
  .modal-dialogmob-scrollable .modal-footer {
    -ms-flex-negative: 0;
        flex-shrink: 0; }
  .modal-dialogmob-scrollable .modal-body {
    overflow-y: auto; }

.modal-dialogmob-centered {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  min-height: calc(100% - 1rem); }
  .modal-dialogmob-centered::before {
    display: block;
    height: calc(100vh - 1rem);
    content: ""; }
  .modal-dialogmob-centered.modal-dialogmob-scrollable {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    height: 100%; }
    .modal-dialogmob-centered.modal-dialogmob-scrollable .modal-contentmob {
      max-height: none; }
    .modal-dialogmob-centered.modal-dialogmob-scrollable::before {
      content: none; }

.modal-contentmob {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  width: 100%;
  pointer-events: auto;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #f6f6f6;
  border-radius: 0.4rem;
  outline: 0; }

.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1040;
  width: 100vw;
  height: 100vh;
  background-color: #000; }
  .modal-backdrop.fade {
    opacity: 0; }
  .modal-backdrop.show {
    opacity: 0.5; }

.modal-headermob {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
      -ms-flex-align: start;
          align-items: flex-start;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  padding: 1rem 1rem;
  border-bottom: 1px solid #FFA500;
  border-top-left-radius: calc(0.3rem - 1px);
  border-top-right-radius: calc(0.3rem - 1px); }
  .modal-headermob .close {
    padding: 1rem 1rem;
    margin: -1rem -1rem -1rem auto; }

.modal-titlemob {
  margin-bottom: 0;
  line-height: 1.5; }

.modal-body {
  position: relative;
  -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
  padding: 1rem; }

.modal-footer {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: end;
      -ms-flex-pack: end;
          justify-content: flex-end;
  padding: 0.75rem;
  border-top: 1px solid #eff2f7;
  border-bottom-right-radius: calc(0.3rem - 1px);
  border-bottom-left-radius: calc(0.3rem - 1px); }
  .modal-footer > * {
    margin: 0.25rem; }

.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll; }

@media (min-width: 576px) {
  .modal-dialogmob {
    max-width: 500px;
    margin: 0; }
  .modal-dialogmob-scrollable {
    max-height: calc(100% - 3.5rem); }
    .modal-dialogmob-scrollable .modal-contentmob {
      max-height: calc(100vh - 3.5rem); }
  .modal-dialogmob-centered {
    min-height: calc(100% - 3.5rem); }
    .modal-dialogmob-centered::before {
      height: calc(100vh - 3.5rem); }
  .modal-sm {
    max-width: 300px; } }

@media (min-width: 992px) {
  .modal-lg,
  .modalx-xl {
    max-width: 100%; } }

@media (min-width: 1200px) {
  .modalx-xl {
    max-width: 100%; } }

</Style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="main-content">
    <div class="page-content">
		<div class="modal-dialogmob modalx-xl">
			<div class="modal-contentmob">
			    <div class="modal-headermob" style="background-color:orange;"><h5 class="modal-titlemob mt-0" id="myExtraLargeModalLabel">Conversation</h5></div>
			        <div class="modal-body">
			            <div class="col-lg-30">
			                <div class="card"> 
			                    <div class="card-body">

			                    <form class="needs-validation" id="adduserform" novalidate>
			                        <div id="cont">
			                        	<!--<?php include("mobilemessages.php"); ?>-->
			                        </div>
			                    </form>    

			                    <form class="form-horizontal" action="" method="post">
			                    	<div class="row">
										<div class="col-md-12">
											<div class="form-group position-relative">    
												<input type="hidden" class="form-control" id="validationTooltip01" placeholder="First Name" name="customer_id" value="1" required>
                        <input type="hidden" class="form-control" id="validationTooltip02" name="STORE_NAME" value="<?php echo $store_name ?>" required>
												<textarea class="form-control" id="validationTooltip01" placeholder="Enter Message" name="message"></textarea> 
											</div>
										</div>
									</div>
									<button class="btn btn-secondary" id="replyid" name="replymessage" type="submit">Send Messages</button> <a><?php echo $message_indicator ?></a>
								</form>

			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function()
{
        //var id = <?php echo $id; ?>;  
        var id = <?php echo $_REQUEST["user_id"]?>;
        $.ajax({  
                 url:"mobilemessages.php",  
                 method:"POST",  
                 data:{id:id},  
                 success:function(data)
                 {  
                    $('#cont').html(data);  
                 }   
            }); 

        setInterval(function()
        {
            $.ajax({  
                 url:"mobilemessages.php",  
                 method:"POST",  
                 data:{id:id},  
                 success:function(data)
                 {  
                    $('#cont').html(data);  
                 }   
            });   
        }, 2000);         
});


</script>