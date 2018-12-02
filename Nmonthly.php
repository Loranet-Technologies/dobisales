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
    <script>    
    $( document ).ready(function() {      
      var dateTo = localStorage.getItem('dateTo');
      var dateFrom = localStorage.getItem('dateFrom');
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
                      <form method="post" action="1daily.php">           
                      <table class="table table-striped table-bordered">
                          <center>
                          <tr>
                            <th>DATE FROM:</th>
                            <td><input type="text" class="simple_date" id="dateFrom" name="dateFrom" ></td>              
                          </tr>
                          <tr>
                            <th>DATE TO:</th>
                            <td><input type="text" class="simple_date2" id="dateTo" name="dateTo"  ></td>
                          </tr>
                          <tr>
                            <th>DATE TYPE:</th>
                            <td>
                              <select id="dateType"  >
                              <option name='daily' id="daily">Daily</option>
                              <option name='weekly' id="weekly">Weekly</option>
                              <option name='monthly' id="monthly" selected>Monthly</option>
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
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">MONTHLY SALES</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="tableSub">
                    <thead>
                      <tr>
                        <th>Month</th>
                        <th>C.Changer</th>
                        <th>Dryer</th>
                        <th>Washer</th>
                        <th>Detergent</th>
                        <th>TOTAL MONTHLY (RM)</th>
                      </tr>                     
                    </thead> 


                    <?php  
                      $chk = $_GET['chk'];
                      if($chk==0)
                      {
                        $dateFrom = $_GET['dateFrom']; //"11/31/2018"
                        $cutF1 = substr($dateFrom, -5,4);
                        $cutF2 = substr($dateFrom, -8,2);
                        $cutF3 = substr($dateFrom, -11,2);
                        $dateFromMonth = $cutF3;
                        $dateFromYear = $cutF1;
                        $dateTo = $_GET['dateTo'];
                        $cutF1 = substr($dateTo, -5,4);
                        $cutF2 = substr($dateTo, -8,2);
                        $cutF3 = substr($dateTo, -11,2);
                        $dateToMonthAsal = $cutF3;
                        $dateToMonth = $cutF3;
                        $dateToYear = $cutF1;

                        $dateLastYear = $dateToYear - $dateFromYear;
                      }  
                      // echo "string: ".$dateFrom.$dateTo;
                      $connect = mysqli_connect('localhost', 'root', '', 'laundritek');

                      $totalWasher2=0;
                      $totalDryer2=0;
                      $totalInsert2=0;
                      $totalDetergent2=0;
                      $totalAll=0;

                      $totalDaily = 0;
                      $salesI = 0;
                      $salesD = 0;
                      $salesW = 0;
                      $salesS = 0;

                      while($dateFromYear<=$dateToYear)
                      {
                        if($dateLastYear>=1) $dateToMonth = 12;
                        else {
                          $dateToMonth = $dateToMonthAsal;
                        }
                        while($dateFromMonth<=$dateToMonth)
                        {                          
                         $queryWasher = "SELECT sqlitetimestamp,sum(sales) AS monthlySales FROM sales_record WHERE MONTH(`sqlitetimestamp`) = '".$dateFromMonth."' AND YEAR(`sqlitetimestamp`) = '".$dateFromYear."'";
                         $result1 = mysqli_query($connect, $queryWasher);
                         $queryWasher2 = mysqli_fetch_assoc($result1);
                         $salesW = $queryWasher2['monthlySales']/10;
                         
                         if($salesW==null)
                         {
                         }
                         else
                         {
                           $queryWasher = "SELECT sqlitetimestamp,sum(sales) AS monthlySales FROM sales_record WHERE MONTH(`sqlitetimestamp`) = '".$dateFromMonth."' AND YEAR(`sqlitetimestamp`) = '".$dateFromYear."' AND type='WASHER'";
                           $result1 = mysqli_query($connect, $queryWasher);
                           $queryWasher2 = mysqli_fetch_assoc($result1);
                           $salesW = $queryWasher2['monthlySales']/10;

                           $queryDryer = "SELECT sqlitetimestamp,sum(sales) AS monthlySales FROM sales_record WHERE MONTH(`sqlitetimestamp`) = '".$dateFromMonth."' AND YEAR(`sqlitetimestamp`) = '".$dateFromYear."' AND type='DRYER'";
                           $result2 = mysqli_query($connect, $queryDryer);
                           $queryDryer2 = mysqli_fetch_assoc($result2);
                           $salesD = $queryDryer2['monthlySales']/10;

                           $querySabun = "SELECT sqlitetimestamp,sum(sales) AS monthlySales FROM sales_record WHERE MONTH(`sqlitetimestamp`) = '".$dateFromMonth."' AND YEAR(`sqlitetimestamp`) = '".$dateFromYear."' AND type='SABUN'";
                           $result3 = mysqli_query($connect, $querySabun);
                           $querySabun2 = mysqli_fetch_assoc($result3);
                           $salesS = $querySabun2['monthlySales']/10;

                           $queryInsert = "SELECT sqlitetimestamp,sum(money_insert) AS monthlySales FROM sales_record WHERE MONTH(`sqlitetimestamp`) = '".$dateFromMonth."' AND YEAR(`sqlitetimestamp`) = '".$dateFromYear."' AND type='money_insert'";
                           $result4 = mysqli_query($connect, $queryInsert);
                           $queryInsert2 = mysqli_fetch_assoc($result4);
                           $salesI = $queryInsert2['monthlySales']/10;
                         }

                         $totalDaily = $salesI + $salesD +$salesW + $salesS;
                         $totalWasher2= $totalWasher2 + $salesW;
                         $totalDryer2= $totalDryer2 + $salesD;
                         $totalInsert2= $totalInsert2 + $salesI;
                         $totalDetergent2= $totalDetergent2 +$salesS;

                      ?>
                        <tr>
                          <td><?php echo $dateFromMonth.'/'.$dateFromYear; ?></td>
                          <td><?php echo number_format($salesI,2); ?></td>
                          <td><?php echo number_format($salesD,2); ?></td>
                          <td><?php echo number_format($salesW,2); ?></td>
                          <td><?php echo number_format($salesS,2); ?></td>
                          <td><?php echo number_format($totalDaily,2); ?></td>
                        </tr>
                    <?php  
                          $dateFromMonth = $dateFromMonth + 1;  
                          if($dateFromMonth<10) $dateFromMonth = '0'.$dateFromMonth;

                          $totalDaily = 0;
                          $salesI = 0;
                          $salesD = 0;
                          $salesW = 0;
                          $salesS = 0;                                      
                        }
                        $dateLastYear = $dateLastYear - 1;
                        $dateFromMonth = 1;
                        $dateFromMonth = '0'.$dateFromMonth;
                        $dateFromYear = $dateFromYear + 1;
                      }

                      $totalAll = $totalInsert2 + $totalDryer2 + $totalWasher2 + $totalDetergent2;
                    ?>
                   <tr style="font-weight: bold;">
                      <td>TOTAL (RM)</td>
                      <td><?php echo number_format($totalInsert2,2); ?></td>
                      <td><?php echo number_format($totalDryer2,2); ?></td>
                      <td><?php echo number_format($totalWasher2,2); ?></td>
                      <td><?php echo number_format($totalDetergent2,2); ?></td>
                      <td><?php echo number_format($totalAll,2); ?></td>
                    </tr> 
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

  </body>
</html>