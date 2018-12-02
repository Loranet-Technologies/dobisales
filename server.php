
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="css/simple-sidebar.css" rel="stylesheet">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php include('check.php') ?>

<?php
    $db = mysqli_connect('localhost', 'root', '', 'laundritek');
    $result=mysqli_query($db,"select * from sales_record");          
?>
<?php
	
	$errors = array(); 
	if(isset($_POST['findtotal']))
	{
    // $dateFrom = $_POST['dateFrom'];
    // $dateTo = $_POST['dateTo'];
	?>
	<script type="text/javascript"> 
    	var dateType = localStorage.getItem('dateType');
    	var dateTo = localStorage.getItem('dateTo');
    	var dateFrom = localStorage.getItem('dateFrom');
      var chk = 0;
    	if(dateTo=="" || dateFrom=="")
    	{
    		<?php array_push($errors, "Please select date.") ?>
    	}
    	else
    	{
    		if(dateType=='Monthly')    			
    			window.location.href = 'Nmonthly.php?dateFrom="'+dateFrom+'"&dateTo="'+dateTo+'"&chk="'+chk+'"';
    		if(dateType=='Daily')    			
    			window.location.href = 'Ndaily.php?dateFrom="'+dateFrom+'"&dateTo="'+dateTo+'"&chk="'+chk+'"';
    		if(dateType=='Weekly')    			
    			window.location.href = 'Nweekly.php';
    		if(dateType=='Yearly')    			
    			window.location.href = 'Nyearly.php';
    	}
	</script>
	<?php
	}

	// REGISTER USER
if (isset($_POST['addUser'])) {
  // receive all input values from the form
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($pwd)) { array_push($errors, "Password is required"); }

   $db = mysqli_connect('localhost', 'root', '', 'laundritek');

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    //$pwd = md5($pwd);//encrypt the password before saving in the database

    $query = "INSERT INTO users (username, password) 
          VALUES('".$username."','".$pwd."')";
    mysqli_query($db, $query);
    array_push($errors, "Records created successfully");
  }
}

?>