
<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!-- 
    Visual Admin Template
    http://www.templatemo.com/preview/templatemo_455_visual_admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="jquery.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>WELCOME</h1>
        </header>

        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="1daily.php"><i class="fa fa-home fa-fw"></i>Sales Record</a></li>
            <li><a href="customerRecord.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Customer Record</a></li>
            <li><a href="setting.php"><i class="fa fa-database fa-fw"></i>Setting</a></li>
<!--             <li><a href="#"><i class="fa fa-map-marker fa-fw"></i></a></li>
            <li><a href="#"><i class="fa fa-users fa-fw"></i></a></li> 
            <li><a href="#"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>-->
            <li><a href="index.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 

      <?php
          $connect = mysqli_connect('localhost', 'root', '', 'laundritek');

          $record_per_page = 10;
          $page = '';
          if(isset($_GET["page"]))
          {
           $page = $_GET["page"];
          }
          else
          {
           $page = 1;
          }
          $count = 1;
          $count = floatval($page);
          if($count>1){
            $count = $count * 20;
            $count = $count - 19;
          }
          $start_from = ($page-1)*$record_per_page;    

          $query = "SELECT * FROM customer_record LIMIT $start_from, $record_per_page";//0,5
          $result = mysqli_query($connect, $query);  
      ?>


      <div class="templatemo-content col-1 light-gray-bg">

        <div class="templatemo-content-container">



          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Customer Record</h2></div>
                <div class="table-responsive">
                  <p id="message"></p> <!-- Display msg yg dihantar -->
                  <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th>Phone</th>
                        <th>Key</th>
                        <th>Promo Code</th>
                        <th>Code Rate</th>
                        <th width="13%">Validity</th>
                        <th>Date Used</th>
                        <th>Usage Count</th>
                        <th>Loyalty Count</th>
                        <th>Usage Amount</th>
                      </tr>
                    </thead>
                     <?php
                     while($row = mysqli_fetch_array($result))
                     {
                        $id = $row['id'];
                        $phone = $row['phone'];
                        $key_gen = $row['key_gen'];
                        $promo_code = $row['promo_code'];
                        $code_rate = $row['code_rate'];
                        $validity = $row['validity'];
                        $date_used = $row['date_used'];
                        $usage_count = $row['usage_count'];
                        $loyalty_count = $row['loyalty_count'];
                        $usage_amount = $row['usage_amount'];

                        if($validity==1)
                          $enable = 'Disable';
                        else
                          $enable = 'Enable';
                     ?>
                     <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $key_gen; ?></td>
                        <td><?php echo $promo_code; ?></td>
                        <td><?php echo $code_rate; ?></td>
                        <td align="center">
                          <div id="<?php echo 'valid'.$id; ?>" name="valid" value='<?php echo $validity; ?>'><?php echo $validity; ?></div>
                          <button id= "<?php echo $id; ?>" value="<?php echo $id; ?>" class='btn btn-primary'><?php echo $enable; ?></button></td>
                        <td><?php echo $date_used; ?></td>
                        <td><?php echo $usage_count; ?></td>
                        <td><?php echo $loyalty_count; ?></td>
                        <td><?php echo $usage_amount; ?></td>
                     </tr>
                      <script type="text/javascript">
                          $(document).ready(function(){
                            $('#<?php echo $id; ?>').click(function(event){
                              var id = $(this).val();
                              // alert(id);
                              event.preventDefault();
                              $.ajax({
                                url: "customerRecordUpdatejQuery.php",
                                method: "POST",
                                data: {id:id},
                                dataType: "text",
                                success: function(status) {
                                  var valid = document.getElementById('<?php echo 'valid'.$id; ?>').innerHTML;
                                  // alert (valid);
                                  if(valid==1)
                                    $('#<?php echo 'valid'.$id; ?>').text('0');
                                  if(valid==0)
                                    $('#<?php echo 'valid'.$id; ?>').text('1');
                                }
                              })
                            })
                          })  
                      </script>
                     <?php

                     $count++;
                     }
                     ?>
                    </table>
                    <div align="center">
                    <br />
                    <?php
                    $page_query = "SELECT * FROM customer_record";
                    $page_result = mysqli_query($connect, $page_query);
                    $total_records = mysqli_num_rows($page_result);
                    $total_pages = ceil($total_records/$record_per_page); //100/20 = 5
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if($difference <= 5)
                    {
                     $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 4;

                    if($total_pages<=4){
                      $start_loop = 1;
                      $end_loop = 1;
                      if($total_pages==2) 
                        $end_loop = 2;
                      if($total_pages==3) 
                        $end_loop = 3;
                      if($total_pages==4) 
                        $end_loop = 4;
                    }
                    if($page > 1)
                    {
                     echo "<a class='page' href='customerRecord.php?page=1'>First</a>";
                     echo "<a class='page' href='customerRecord.php?page=".($page - 1)."'><<</a>";
                    }
                    for($i=$start_loop; $i<=$end_loop; $i++)
                    {     
                     echo "<a class='page' href='customerRecord.php?page=".$i."'>".$i."</a>";
                    }
                    if($page < $end_loop)
                    {
                     echo "<a class='page' href='customerRecord.php?page=".($page + 1)."'>>></a>";
                     echo "<a class='page' href='customerRecord.php?page=".$total_pages."'>Last</a>";
                    }
                    
                    ?>
                    </div>
                    <br /><br />
                   </div>
                  </div>

                  </table>    
                </div>                          
              </div>
            </div>           
          </div> <!-- Second row ends -->
          

          <footer class="text-right">
            <p>Copyright &copy; 2018 shlaundritek
            | Development by <a href="http://www.shlaundritek.my" target="_parent">www.shlaundritek.my</a></p>
          </footer>         
        </div>
      </div>
    </div>
    

    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>

<style type="text/css">

.myButton {
  -moz-box-shadow: 0px 10px 14px -7px #276873;
  -webkit-box-shadow: 0px 10px 14px -7px #276873;
  box-shadow: 0px 10px 14px -7px #276873;
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
  background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
  background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
  background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
  background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
  background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
  background-color:#599bb3;
  -moz-border-radius:8px;
  -webkit-border-radius:8px;
  border-radius:8px;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:20px;
  font-weight:bold;
  padding:13px 32px;
  text-decoration:none;
  text-shadow:0px 1px 0px #3d768a;
}
.myButton:hover {
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
  background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
  background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
  background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
  background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
  background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#599bb3',GradientType=0);
  background-color:#408c99;
}
.myButton:active {
  position:relative;
  top:1px;
}
</style>

  <style>
  a.page {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }
  </style>