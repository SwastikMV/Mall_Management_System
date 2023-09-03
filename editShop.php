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
  
    <title>Edit Shop Details</title>
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
      <h5 class="card-title" style="text-align: center;margin:auto;">Edit Shop</h5>
    </div>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $shopid=$_POST['shopid'];
    $q = "select * from shop where shop_id = '$shopid'";
    $res = mysqli_query($con, $q);
    $qarr = mysqli_fetch_assoc($res);
}
else{
  header('location:admin.php');
}
?>
<form id="delete" method="POST" action="deleteShop.php">
    <input type="hidden" name="shopid" value="<?php echo $shopid ?>">
</form>
    <form style="margin:20px auto; width: 40vw;" method="POST" action="updateShop.php">
        <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Shop ID</label>
    <div class="col-sm-10">
      <input type="text" name='shopid' readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $shopid ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Shop Name</label>
    <div class="col-sm-10">
      <input type="text" name='name' class="form-control" value="<?php echo $qarr['name'] ?>" placeholder="Name">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
      <input type="number" name='category' class="form-control" value="<?php echo $qarr['category_id'] ?>" placeholder="Category">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Floor</label>
    <div class="col-sm-10">
      <input type="number" name='floor' class="form-control" value="<?php echo $qarr['floor_no'] ?>" placeholder="Floor">
    </div>
  </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Owner</label>
    <div class="col-sm-10">
      <input type="number" name='owner' class="form-control" value="<?php echo $qarr['owner_id'] ?>" placeholder="Owner">
    </div>
  </div>
  </div>
  <button class="btn btn-danger" type="submit" form="delete" >Delete Shop</button>
  <button class="btn btn-primary" type="submit" >Update</button>

    </form>

</body>
</html>