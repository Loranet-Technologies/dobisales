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
    <!-- BARU KENA MASUK 19/11/2018 -->
    <link rel="stylesheet" type="text/css" href="css/tabpaging.css">
    <script src="js/sweet_alert.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <!--  <script type="text/javascript" src="js/footable.js"></script> 
    <script type="text/javascript" src="js/footable.min.js"></script>  -->
    <script>    
    $( document ).ready(function() {      
      var dateFrom = localStorage.getItem('dateFrom');
      var dateTo = localStorage.getItem('dateTo');
      if(dateTo!="")
      {
        document.getElementById("dateFrom").value = dateFrom;
        document.getElementById("dateTo").value = dateTo;
      }
    });
    </script>
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
            <li><a href="1daily.php" class="active"><i class="fa fa-home fa-fw"></i>Sales Record</a></li>
            <li><a href="customerRecord.php"><i class="fa fa-bar-chart fa-fw"></i>Customer Record</a></li>
            <li><a href="#"><i class="fa fa-database fa-fw"></i>Setting</a></li>
<!--             <li><a href="#"><i class="fa fa-map-marker fa-fw"></i></a></li>
            <li><a href="#"><i class="fa fa-users fa-fw"></i></a></li> 
            <li><a href="#"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>-->
            <li><a href="index.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">

        <div class="templatemo-content-container">

          <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
              <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
               <!--  <i class="fa fa-times"></i> -->
                <div class="templatemo-flex-row flex-content-row">
                  <div class="col-1 col-lg-6 col-md-12">
                    <h2 class="text-center">Select date:</h2><br>
                    <div>
                      <form method="post" action="Ndaily.php">           
                      <table class="table table-striped table-bordered">
                          <center>
                          <tr>
                            <th>DATE FROM:</th>
                            <td><input type="text" class="simple_date" id="dateFrom" ></td>              
                          </tr>
                          <tr>
                            <th>DATE TO:</th>
                            <td><input type="text" class="simple_date2" id="dateTo"  ></td>
                          </tr>
                          <tr>
                            <th>DATE TYPE:</th>
                            <td>
                              <select id="dateType"  >
                              <option name='daily' id="daily" selected>Daily</option>
                              <option name='weekly' id="weekly">Weekly</option>
                              <option name='monthly' id="monthly">Monthly</option>
                              <option name='yearly' id="yearly">Yearly</option>
                              </select</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="findtotal" onclick="clickme()" value="Submit" class="btn btn-primary">  </td>
                          </tr>
                          </center>
                      </table>
                      </form>
                    </div> <!-- Pie chart div -->
                  </div> 
                </div>                
              </div>
            </div>
          </div>

          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">DAILY SALES</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="tableSub" class="footable" data-page-size="4">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>C.Changer</th>
                        <th>Dryer</th>
                        <th>Washer</th>
                        <th>Detergent</th>
                        <th>TOTAL DAILY (RM)</th>
                      </tr>
                    </thead> 




                    <?php    
                    $chk = $_GET['chk'];
                    if($chk==0)
                    {
                      $dateFrom = $_GET['dateFrom']; //11/01/2018
                      $cutF1 = substr($dateFrom, -5,4);
                      $cutF2 = substr($dateFrom, -8,2);
                      $cutF3 = substr($dateFrom, -11,2);
                      $dateFrom = $cutF1.'-'.$cutF3.'-'.$cutF2;
                      $dateTo = $_GET['dateTo'];
                      $cutF1 = substr($dateTo, -5,4);
                      $cutF2 = substr($dateTo, -8,2);
                      $cutF3 = substr($dateTo, -11,2);
                      $dateTo = $cutF1.'-'.$cutF3.'-'.$cutF2;
                    }
                    else
                    {
                      $dateFrom = $_GET['dateFrom'];
                      $dateTo = $_GET['dateTo'];
                    }

                      // $currDateOnly = date("Y-m-d");
                      // $currDate = date("Y-m-d").' 00:00:00';
                      // $currDate = '2018-03-21 00:00:00'; //841 record
                      // $currDate = '2018-05-01 00:00:00';
                      // $dateFrom = '2018-02-01';
                      // $dateTo = '2018-12-01';
                      $connect = mysqli_connect('localhost', 'root', '', 'laundritek');

                      $totalWasher2=0;
                      $totalDryer2=0;
                      $totalInsert2=0;
                      $totalDetergent2=0;
                      $totalAll=0;

                      $totalDryer = "SELECT sqlitetimestamp, SUM(sales) FROM sales_record WHERE sqlitetimestamp >=  '".$dateFrom."' AND sqlitetimestamp <=  '".$dateTo."' AND type = 'DRYER'";
                      $result1 = mysqli_query($connect, $totalDryer);
                      $totalDryer2 = mysqli_fetch_assoc($result1);

                      $totalWasher = "SELECT sqlitetimestamp, SUM(sales) FROM sales_record WHERE sqlitetimestamp >=  '".$dateFrom."' AND sqlitetimestamp <=  '".$dateTo."' AND type = 'WASHER'";
                      $result2 = mysqli_query($connect, $totalWasher);
                      $totalWasher2 = mysqli_fetch_assoc($result2);

                      $totalInsert = "SELECT sqlitetimestamp, SUM(money_insert) FROM sales_record WHERE sqlitetimestamp >=  '".$dateFrom."' AND sqlitetimestamp <=  '".$dateTo."' AND type = 'MONEY_INSERT'";
                      $result3 = mysqli_query($connect, $totalInsert);
                      $totalInsert2 = mysqli_fetch_assoc($result3);

                      $totalDetergent = "SELECT sqlitetimestamp, SUM(sales) FROM sales_record WHERE sqlitetimestamp >=  '".$dateFrom."' AND sqlitetimestamp <=  '".$dateTo."' AND type = 'SABUN'";
                      $result2 = mysqli_query($connect, $totalDetergent);
                      $totalDetergent2 = mysqli_fetch_assoc($result2);

                      $totalAll = ($totalInsert2['SUM(money_insert)']/10) + ($totalDryer2['SUM(sales)']/10) +
                                  ($totalWasher2['SUM(sales)']/10) + ($totalDetergent2['SUM(sales)']/10);

                      $record_per_page = 20;
                      $page = '';
                      if(isset($_GET["page"]))
                      {
                       $page = $_GET["page"];
                      }
                      else
                      {
                       $page = 1;
                      }

                      $start_from = ($page-1)*$record_per_page;  

                      $query = "SELECT type,CAST(sqlitetimestamp AS DATE) AS tarikh, SUM(sales) AS total_sales FROM sales_record
                                WHERE sqlitetimestamp BETWEEN '".$dateFrom."' AND '".$dateTo."'
                                GROUP BY CAST(sqlitetimestamp AS DATE)  LIMIT $start_from, $record_per_page"; 
                      $result = mysqli_query($connect, $query);  

                      $count = floatval($page);
                      if($count>1){
                        $count = $count * 20;
                        $count = $count - 19;
                      }
                      while($row=mysqli_fetch_array($result))
                      {
                         $type = $row['type'];
                         $sqlitetimestamp = $row['tarikh'];
                         $sqlitetimestampFrom = $row['tarikh'].' 00:00:00';
                         $sqlitetimestampTo = $row['tarikh'].'23:59:59';

                         $queryWasher = "SELECT type,sqlitetimestamp, SUM(sales) AS total_sales FROM sales_record WHERE sqlitetimestamp >= '".$sqlitetimestampFrom."' AND sqlitetimestamp <= '".$sqlitetimestampTo."' AND type = 'WASHER'";
                         $result1 = mysqli_query($connect, $queryWasher);
                         $queryWasher2 = mysqli_fetch_assoc($result1);

                         $salesW = $queryWasher2['total_sales']/10;

                         $queryDryer = "SELECT type,sqlitetimestamp, SUM(sales) AS total_sales FROM sales_record WHERE sqlitetimestamp >= '".$sqlitetimestampFrom."' AND sqlitetimestamp <= '".$sqlitetimestampTo."' AND type = 'DRYER'";
                         $result2 = mysqli_query($connect, $queryDryer);
                         $queryDryer2 = mysqli_fetch_assoc($result2);
                         $salesD = $queryDryer2['total_sales']/10;

                         $querySabun = "SELECT type,sqlitetimestamp, SUM(sales) AS total_sales FROM sales_record WHERE sqlitetimestamp >= '".$sqlitetimestampFrom."' AND sqlitetimestamp <= '".$sqlitetimestampTo."' AND type = 'SABUN'";
                         $result3 = mysqli_query($connect, $querySabun);
                         $querySabun2 = mysqli_fetch_assoc($result3);
                         $salesS = $querySabun2['total_sales']/10;

                         $queryInsert = "SELECT type,sqlitetimestamp, SUM(money_insert) AS total_sales FROM sales_record WHERE sqlitetimestamp >= '".$sqlitetimestampFrom."' AND sqlitetimestamp <= '".$sqlitetimestampTo."' AND type = 'MONEY_INSERT'";
                         $result4 = mysqli_query($connect, $queryInsert);
                         $queryInsert2 = mysqli_fetch_assoc($result4);
                         $salesI = $queryInsert2['total_sales']/10;


                         $timestamp = strtotime($sqlitetimestamp);
                         $sqlitetimestamp = date("d-m-Y", $timestamp);

                         $totalDaily = $salesI + $salesD +$salesW + $salesS;

                      ?>
                        <tr>
                          <td><?php echo $sqlitetimestamp ?></td>
                          <td><?php echo number_format($salesI,2); ?></td>
                          <td><?php echo number_format($salesD,2); ?></td>
                          <td><?php echo number_format($salesW,2); ?></td>
                          <td><?php echo number_format($salesS,2); ?></td>
                          <td><?php echo number_format($totalDaily,2); ?></td>
                        </tr>
                    <?php                                        

                      }
                                ?>
                               <tr style="font-weight: bold;">
                                  <td>TOTAL (RM)</td>
                                  <td><?php echo number_format($totalInsert2['SUM(money_insert)']/10,2); ?></td>
                                  <td><?php echo number_format($totalDryer2['SUM(sales)']/10,2); ?></td>
                                  <td><?php echo number_format($totalWasher2['SUM(sales)']/10,2); ?></td>
                                  <td><?php echo number_format($totalDetergent2['SUM(sales)']/10,2); ?></td>
                                  <td><?php echo number_format($totalAll,2); ?></td>
                                </tr> 
                  </table>   

                  <div align="center">
                    <br />
                    <?php

                    $page_query = "SELECT type,CAST(sqlitetimestamp AS DATE) AS tarikh, SUM(sales) AS total_sales FROM sales_record
                                WHERE sqlitetimestamp BETWEEN '".$dateFrom."' AND '".$dateTo."'
                                GROUP BY CAST(sqlitetimestamp AS DATE)  ";
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
                     echo "<a class='page' href='Ndaily.php?page=1&dateFrom=".$dateFrom."&dateTo=".$dateTo."&chk=1'>First</a>";
                     echo "<a class='page' href='Ndaily.php?page=".($page - 1)."&dateFrom=".$dateFrom."&dateTo=".$dateTo."&chk=1'><<</a>";
                    }
                    for($i=$start_loop; $i<=$end_loop; $i++)
                    {     
                     echo "<a class='page' href='Ndaily.php?page=".$i."&dateFrom=".$dateFrom."&dateTo=".$dateTo."&chk=1'>".$i."</a>";
                    }
                    if($page < $end_loop)
                    {
                     echo "<a class='page' href='Ndaily.php?page=".($page + 1)."&dateFrom=".$dateFrom."&dateTo=".$dateTo."&chk=1'>>></a>";
                     echo "<a class='page' href='Ndaily.php?page=".$total_pages."&dateFrom=".$dateFrom."&dateTo=".$dateTo."&chk=1'>Last</a>";
                    }
                    // echo "string: ".$dateFrom22;
                    ?>
                </div>
                    <br /><br />




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

    <script>
      $( function() {
        $( ".simple_date" ).datepicker();
      } );

      $( function() {
        $( ".simple_date2" ).datepicker();
      } );


      function clickme()
      {
        var dateFrom = document.getElementById('dateFrom').value;
        var dateTo = document.getElementById('dateTo').value;
        var dateType = document.getElementById('dateType').value;

         localStorage.setItem('dateFrom', dateFrom);
         localStorage.setItem('dateTo', dateTo);
         localStorage.setItem('dateType', dateType);



        //alert("From: "+dateFrom+"---To: "+dateTo+" Type: "+dateType);
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.footable').footable();
      });
    </script>

  </body>
</html>