<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
    header('location:index.php');
}
mysqli_select_db($con, 'mms');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
    <title>add user</title>
</head>
<body>

<style>

    
</style>

<div class="card">
    <div class="card-header">
      MMS
    </div>
    <div class="card-body row">
    <button class="btn"> <a href="admin/admins.php">Back </a> </button>
      <h5 class="card-title" style="text-align: center;margin:auto;">Add User</h5>
    </div>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=$_POST['username'];
    $q = "select * from users where username = '$username'";
    $res = mysqli_query($con, $q);
    $qarr = mysqli_fetch_assoc($res);
}
?>

    <form style="margin:20px auto; width: 40vw;" method="POST" action="">
    <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" name='username' class="form-control"  placeholder="Email">
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $username = $_POST['username'];
        $name = $_POST['name'];
        $user_type = $_POST['user_type'];
        $password = $_POST['password'];
        $q =  "select username from users where username='$username'";
        $res = mysqli_query($con,$q);
        if(mysqli_num_rows($res)!=0){
            echo "Email already used";
        }
        else{
            $q2 = "insert into users values ('$username', '$name', '$user_type', '$password')";
            if($user_type=="owner"){
              $q3 = "insert into owner (name,username) values ('$name','$username')";
              $res_3 = mysqli_query($con, $q3);
            }
            $res_2 = mysqli_query($con, $q2);
            header('location: added.php');
        }
    }
     ?>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">User Type</label>
    <div class="col-sm-10">
    <select name="user_type" id="cars" >
    <option value="admin">Admin</option>
    <option value="floor_manager">floor_manager</option>
    <option value="shop_manager">shop_manager</option>
    <option value="owner">Owner</option>
  </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name='name' class="form-control"  placeholder="Name">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name='password' class="form-control" id="inputPassword" placeholder="Password" >
    </div>
  </div>
  <input type="submit" value="Save">

    </form>

</body>
</html>