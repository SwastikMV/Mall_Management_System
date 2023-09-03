<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


  mysqli_select_db($con, 'mms');
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>MMS</title>
</head>

<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
  font-size: 17px;
}

#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}

</style>
</head>
<body>
<video autoplay muted loop id="myVideo">
  <source src="video.png" type="video/mp4">
  Your browser does not support HTML5 video.
</video>




  <script type="text/javascript">
    console.log("hello");

    function jsFunction(error) {
      alert(error);
    }
  </script>
  
  
  <div style="height:100px;"></div>
  
  <div class="card shadow p-5 mt-5 bg-white rounded" style="margin: auto;width: 30vw;opacity:100%;border-radius: 15px; ">
  <h1 style="text-align: center;width: max-content;margin: auto; ">Welcome to MMS</h1>

    <div class="row" >

      <!-- Login Form -->
      <div class="col">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group mt-4">
            <input type="hidden" name="type" value="login">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div style="height:20px;"></div>
          <button type="submit" class="btn btn-primary" style="margin-left: 75px;width:200px">Login</button>
        </form>
      </div>

      <!-- Register Form -->
      <!-- <div class="col">
        <form method="POST" action="">
          <div class="form-group mt-4">
            <input type="hidden" name="type" value="register">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div> -->

    </div>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // collect value of input field
      
     
      $type = $_POST['type'];
       if ($type == 'register') {
        if (empty($name)) {
          echo '<br>Email is empty';
        }
        if (empty($pass)) {
          echo '<br>Password is empty';
        }
        $name = $_POST['Email'];
      $pass = $_POST['pass'];

        $q = " select * from users where username = '$name'";
        $res = mysqli_query($con, $q);

        if (mysqli_num_rows($res) == 1) {
          echo '<br>User already exists';
        } else {
          $i = " insert into users values('$name', '','admin', '$pass')";
          mysqli_query($con, $i);
          echo '<script>jsFunction(\'User registration successfull\');</script>';
        }
      } else if ($type == 'login') {
       
        $name = $_POST['Email'];
      $pass = $_POST['pass'];

        $q = " select * from users where username = '$name' and password = '$pass'";
        $res = mysqli_query($con, $q);

        if (mysqli_num_rows($res) != 0) {
        $store =  mysqli_fetch_array($res)['user_type'];
        }

        if (mysqli_num_rows($res) == 0) {
          echo '<br>User credentials incorrect';
        } else {
          $_SESSION['username'] = $name;
          if($store=='admin'){
            header('location:admin/admins.php');
          }
          else if($store=='shop_manager'){
            header('location:dashboard.php');
          }
          else if($store=='owner'){
            header('location:ownerDashboard.php');
          }
          else if($store=='floor_manager'){
            header('location:floor.php');
          }
        }
      }else if($_POST['type']=='logout'){
          $_SESSION['username']=null;
      }
    }
    ?>

  </div>



</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>