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
                              <option name='daily' id="daily">Daily</option>
                              <option name='weekly' id="weekly">Weekly</option>
                              <option name='monthly' id="monthly">Monthly</option>
                              <option name='yearly' id="yearly" selected>Yearly</option>
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
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">YEARLY SALES</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="tableSub">
                    <thead>
                      <tr>
                        <th>Year</th>
                        <th>C.Changer</th>
                        <th>Dryer</th>
                        <th>Washer</th>
                        <th>Detergent</th>
                        <th>TOTAL MONTHLY (RM)</th>
                      </tr>
                      <script type="text/javascript">
                          var totalAll=0;
                          var totalW=0;
                          var totalD=0;
                          var totalI=0;
                          var totalS=0;
                          var countI=0;
                          var nn1=0;
                          var mmAsal = 0;
                          var mmTemp = 0;
                          var ii=0;
                          var totalSemua=0;
                          var totalSemuaW=0;
                          var totalSemuaD=0;
                          var totalSemuaI=0;
                          var totalSemuaS=0;


                          var dateType = localStorage.getItem('dateType');
                          var dateTo = localStorage.getItem('dateTo');
                          var dateFrom = localStorage.getItem('dateFrom');

                          var count = 1;

                          var mmFrom = dateFrom.substring(0,2);
                          var ddFrom = dateFrom.substring(3,5);
                          var yyFrom = dateFrom.substring(6,10);
                          var yyTo = dateTo.substring(6,10);
                          var mmAsal = mmFrom;
                          var yyAsal = yyFrom;
                            //alert(dateFrom+dateTo);
                           while(yyFrom<=yyTo)
                           {

                              var dateFrom = mmFrom+"/"+ddFrom+"/"+yyFrom;
                              //alert(dateFrom);
                              ddFrom = parseInt(ddFrom) + 1;
                              if(ddFrom<10)
                                ddFrom = "0"+ddFrom;

                              if(ddFrom>32)
                              { 
                                mmFrom = parseInt(mmFrom) + 1;
                                ddFrom = 1;
                                if(mmFrom<10)
                                  mmFrom = "0"+mmFrom;
                                if(ddFrom<10)
                                  ddFrom = "0"+ddFrom;
                                if(mmFrom==13)
                                  mmTempy=55;              
                              }

                              if(mmFrom>12)
                              {              
                                mmTemp = 99;
                                yyFrom = parseInt(yyFrom) + 1;
                                mmFrom = 1;
                                ddFrom = 1;
                                if(mmFrom<10)
                                  mmFrom = "0"+mmFrom;
                                if(ddFrom<10)
                                  ddFrom = "0"+ddFrom;
                              }


                                <?php
                                while($row=mysqli_fetch_array($result)){
                                $formatted_date = $row['sqlitetimestamp'] ; 
                                $sales = $row['sales'];
                                $moneyI = $row['money_insert'];
                                $id = $row['id'];
                                $type = $row['type']; 
                              ?>      

                                var javascript_date = "<?php echo $formatted_date; ?>";
                                var aa = javascript_date;
                                var kk = aa.toString();
                                var yy= kk.substring(0,4);
                                var mm= kk.substring(5, 7);
                                var dd= kk.substring(8, 10);
                                var comp = kk.substring(11, 19); 

                                var n = mm+"/"+dd+"/"+yy;
                                var nwhile = dd+"."+mm+"."+yy;
                                var id = "<?php echo $id; ?>";
                                var moneyI = parseFloat("<?php echo $moneyI; ?>");
                                var sales = parseFloat("<?php echo $sales; ?>");
                                var type = "<?php echo $type; ?>";

                                
                                //alert(n);

                                sales = sales / 10;
                                moneyI = moneyI / 10;///////////
                                //alert(comp); jadi

                                if(n==dateFrom)
                                {
                                    if (type=="MONEY_INSERT") 
                                    {
                                        totalI = parseFloat(totalI) + moneyI;                      
                                        totalSemuaI = parseFloat(totalSemuaI) + moneyI;
                                        count++;
                                    }
                                    if (type=="DRYER") 
                                    {
                                        totalD = parseFloat(totalD) + sales;                      
                                        totalSemuaD = parseFloat(totalSemuaD) + sales;
                                        count++;
                                    }  
                                    if (type=="WASHER") 
                                    {
                                        totalW = parseFloat(totalW) + sales;                      
                                        totalSemuaW = parseFloat(totalSemuaW) + sales;
                                        count++;
                                    }     
                                    if (type=="SABUN") 
                                    {
                                        totalS = parseFloat(totalS) + sales;                      
                                        totalSemuaS = parseFloat(totalSemuaS) + sales;
                                        count++;
                                    }                 
                                }

                            <?php
                            }
                            ?>
                          var arr = ["","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                                  var monthN = "";
                                  for(var i=0; i<arr.length; ++i)
                                  {
                                      if(i==mmAsal)
                                          monthN = arr[i];
                                  }
                            if(mmTemp==99 || dateFrom==dateTo)
                            {

                                  totalAll = totalI + totalD + totalW + totalS;
                                  totalAll = totalAll.toFixed(2);
                                  totalI = totalI.toFixed(2);
                                  totalD = totalD.toFixed(2);
                                  totalW = totalW.toFixed(2);
                                  totalS = totalS.toFixed(2);
                              //alert(totalW);
                              document.getElementById("tableSub").innerHTML+="<tr><td>"+yyAsal+"</td><td>"+totalI+"</td><td>"+totalD+"</td><td>"+totalW+"</td><td>"+totalS+"</td><td>"+totalAll+"</td></tr>";
                                   
                                   totalW=0;
                                   totalD=0;
                                   totalI=0;
                                   totalS=0;
                                   totalAll=0;
                            }
                            mmTemp = 0;
                            yyAsal = yyFrom;

                            if(dateFrom==dateTo)
                              break;
                           }


                          totalSemua = totalSemuaI+totalSemuaS+totalSemuaW+totalSemuaD;
                          totalSemua = totalSemua.toFixed(2);
                          totalSemuaI = totalSemuaI.toFixed(2);
                          var dd = totalSemuaD.toFixed(2);
                          totalSemuaW = totalSemuaW.toFixed(2);
                          totalSemuaS = totalSemuaS.toFixed(2);
                                   
                          document.getElementById("tableSub").innerHTML+="<tr><th>"+'TOTAL (RM)'+"</th><th>"+totalSemuaI+"</th><th>"+dd+"</th><th>"+totalSemuaW+"</th><th>"+totalSemuaS+"</th><th>"+totalSemua+"</th></tr>";

                        </script>
                    </thead>                    
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