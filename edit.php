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
  
    <title>Edit User Details</title>
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
      <h5 class="card-title" style="text-align: center;margin:auto;">Edit User</h5>
    </div>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=$_POST['username'];
    $q = "select * from users where username = '$username'";
    $res = mysqli_query($con, $q);
    $qarr = mysqli_fetch_assoc($res);
}
else{
  header('location:admin.php');
}
?>
<form id="delete" method="POST" action="delete.php">
    <input type="hidden" name="username" value="<?php echo $username ?>">
</form>
    <form style="margin:20px auto; width: 40vw;" method="POST" action="update.php">
        <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" name='username' readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $username ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">User Type</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $qarr['user_type']; $_SESSION['user_type'] = $qarr['user_type'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name='name' class="form-control" value="<?php echo $qarr['name'] ?>" placeholder="Name">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name='password' class="form-control" id="inputPassword" placeholder="Password" value="<?php echo $qarr['password'] ?>">
    </div>
  </div>
  <button class="btn btn-danger" type="submit" form="delete" >Delete User</button>
  <button class="btn btn-primary" type="submit" >Update</button>

    </form>

</body>
</html>