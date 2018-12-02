<?php
	$id = $_POST['id'];

	$db = mysqli_connect('localhost', 'root', '', 'laundritek');


    $result=mysqli_query($db,"select * from customer_record where id = ' ".$id."'");   

    while($row=mysqli_fetch_array($result)){
    
      $id1 = $row['id'];
      $validity = $row['validity'];
      if($id1 == $id){
        if($validity==0){

          $validity = 1;

          //echo "Validity ".$validity;

          $sql = "UPDATE customer_record SET validity='".$validity."' WHERE id='".$id."'";

          if ($db->query($sql) === TRUE) {
              ?>
                <script type="text/javascript">
                    // window.location = "customerRecord.php";
                </script>
              <?php
          } else {
              echo "Error updating record: ";
          }
        }
        else{

          $validity = 0;

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
    }
?>