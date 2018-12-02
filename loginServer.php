
<script type="text/javascript">
  var chk = 0;
  localStorage.setItem('chk', chk);


<?php


$errors = array(); 
$username = "";
$password = "";
    
  $db = mysqli_connect('localhost', 'root', '', 'laundritek');
// connect to the database
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  else if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {

    //$password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
       ?>
          var user = "<?php echo $username ?>"; 
          var chk = 1;
          localStorage.setItem('user', user);
          localStorage.setItem('chk', chk);
          window.location.href = '1daily.php';

      <?php

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";

      //header('location:home.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

    /*$sql = 'SELECT id from users where username="'.$_POST["username"].'" and password="'.$_POST["password"].'"';

    $id='';

    while ($row = mysql_fetch_array($result)) {
      $id=$row['id'] !==null? $row['id']:flase ;
    

    if($id !=""){
      ?>
      <script>
        var user = "<?php echo $name ?>"; 
        var chk = 1;
        localStorage.setItem('user', user);
        localStorage.setItem('chk', chk);
        window.location.href = 'home.php';
      </script>
      <?php
    }else
    {
      ?>
      <script>
          alert("Username or Password incorrect");
          window.location.href = 'index.php';
      </script>
      <?php
    }
  }*/

?>
</script>