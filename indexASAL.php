
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
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">TODAY</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="tableSub">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>C.Changer</th>
                        <th>Dryer</th>
                        <th>Washer</th>
                        <th>Detergent</th>
                        <th>Date / Time</th>
                      </tr>
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