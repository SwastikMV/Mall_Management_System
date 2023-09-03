<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shopid = $_POST['shopid'];
    $q = "select * from product natural join inventory where shop_id='$shopid'";
  $res = mysqli_query($con,$q);
}
else{
    header('location:shopmanager.php');
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>edit inventory</title>
</head>

<style>
  table, th, td {
  border: 2px solid;
  padding: 20px;
}
</style>
<body>
  <div class="card">
    <div class="card-header">
      MMS
    </div>
    <div class="card-body row">
    <button class="btn"> <a href="shopmanager.php">Back </a> </button>
      <h5 class="card-title" style="text-align: center;margin:auto;">Edit inventory</h5>
      <form method="POST" action="addProduct.php">
        <input type="hidden" name="sid" value="<?php echo $shopid?>">
      <button class="btn btn-primary" type="submit"> Add Product</button>
      </form>
    </div>
  </div>

  <table style="margin:35px auto ;width:max-content;">
  <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Action</th>
  </tr>
  <?php  
  while($row1 = mysqli_fetch_array($res)){
  ?>
  <tr><form method="POST" action="editInventoryItem.php">
    <input type='hidden' name='pid' value='<?php echo $row1['product_id']?>'>

    <input type='hidden' name='sid' value='<?php echo $row1['shop_id']?>'>
    <td><input name="name" type="text"  readonly class="form-control-plaintext" id="staticEmail" value='<?php echo $row1['name']?>'></td>
    <td><input name="price" type="text" readonly class="form-control-plaintext" id="staticEmail" value='<?php echo $row1['s_price']?>'></td>
    <td><input name="qty" type="text" readonly class="form-control-plaintext" id="staticEmail" value='<?php echo $row1['quantity']?>'></td>
    <td><input type='submit' class="btn btn-primary" value="Edit"></input> </td>
  </form>
  </tr>
  <?php } ?>
</table>
