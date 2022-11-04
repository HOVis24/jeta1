 <?php
      require_once('controllers/connection.php'); 
      $GET['url'] = $_SERVER['REQUEST_URI'];                   
      //$id = "1";
      $id = $_REQUEST["id"];
      session_start();
      $STORENAME = $_SESSION["storename"];
      $output = '';  
      $status = "";
      $name = "";
      $query = "SELECT chat.id,customer_id,message,user_type,customers.first_name,customers.middle_name,customers.last_name FROM chat INNER JOIN customers ON customer_id = customers.id WHERE customer_id='$id' AND store='$STORENAME'";
      $result = mysqli_query($con, $query);

      while($row = mysqli_fetch_array($result))   
      { 

        if ($row['user_type'] == "Customer") 
        {
          $status = "left";
          $name = $row['first_name']." ".substr($row['middle_name'],0,1)."."." ".$row['last_name'];
        }
        else
        {
          $status = "right";
          $name = "JETA";
        }

        $output .= '  
        <div class="row">
          <div class="col-12">
            <a href="#" class="media">
              <div class="media-body chat-user-box" style="text-align: '.$status.'">
                <p class="user-title m-0" style="font-size: 11px;">'.$name.'</p>
                <p class="text-muted m-0" style="font-size: 11px;">'.$row['message'].'</p>
              </div>
            </a>
          </div>
        </div>
        <hr>
        ';  
      }//end of while($row = mysqli_fetch_array($result);
      echo $output; 
  
?>
