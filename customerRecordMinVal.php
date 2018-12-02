<?php include('check.php') ?>
<?php include('server.php') ?>


<?php

	$id = $_GET['id']; 

  	

    $db = mysqli_connect('localhost', 'root', '', 'laundritek');


    $result=mysqli_query($db,"select * from customer_record");   

    while($row=mysqli_fetch_array($result)){
    
      $id1 = $row['id'];
      $validity = $row['validity'];
      if($id1 == $id){
        $validity = $validity-1;
        //echo "Validity ".$validity;

        $sql = "UPDATE customer_record SET validity='".$validity."' WHERE id='".$id."'";

        if ($db->query($sql) === TRUE) {
            ?>
              <script type="text/javascript">
                  window.location = "customerRecord.php";
              </script>
            <?php
        } else {
            echo "Error updating record: ";
        }

      }
    }

?>
