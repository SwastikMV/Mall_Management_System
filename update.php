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
    <title>Update Status</title>
</head>
<body>


<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=$_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $user_type = $_SESSION['user_type'];
    
    $q = "update users set name='$name',password='$password' where username='$username'";

    if($user_type=="owner"){
      $q3 = "update owner set name='$name' where username='$username'";
      $res_3 = mysqli_query($con, $q3);
    }

    $res = mysqli_query($con, $q);
  }
  else{
    header('location:admin.php');
  }
?>

<div class="card">
    <div class="card-header">
      MMS
    </div>
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Update Status</h5>
    </div>
  </div>
    <h2> UPDATE SUCCESSFULL </h2>
    <button class="btn"> <a href="admin/admins.php">Back </a> </button>
</body>
</html>