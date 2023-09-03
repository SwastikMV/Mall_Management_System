<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');

   
    if(empty($_SESSION['username'])){
        header('location:login.php');
    }



mysqli_select_db($con, 'mms');
?>

<?php
$user = $_SESSION['username'];
  $q = "select * from shop where manager_id='$user'";
  $res = mysqli_query($con,$q);
  $row = mysqli_fetch_assoc($res);

  $hesaru = $row['name'];
  $shopid = $row['shop_id'];
  $_SESSION['shop_id'] = $shopid;
  $q = "select * from product natural join inventory where shop_id='$shopid'";
  $res = mysqli_query($con,$q);
  $q1 = "select * from transaction t where t.shop_id IN(select shop_id from shop where name='$hesaru') order by t.transaction_id desc";
  $res1 = mysqli_query($con, $q1);
 
  $q4 = "select * from goods where shop_id = (select shop_id from shop where name='$hesaru')";
  $res4 = mysqli_query($con, $q4);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
</head>

<style>
  .heading{
    background-image: url('wooden.png');
    background-size: cover;
  }
</style>

<body>
  <div class="card">
    <div class="heading" style="height: 60px;">
    <div class="card-header">
      MMS
      <div style="display:flex;float:right">
      <a href="/MMS/bill.php"><button type="submit" class="btn btn-primary" style="margin-right:50px" > Generate bill </button></a>
      <form method="POST" action="login.php">
        <input type="hidden" value="logout" name="type">
      <button type="submit" class="btn btn-primary" > LOG OUT </button>
      </form>
    </div>
  </div>
</div>
    <div class="card-body" style="background-color:	 #e6e6e6">
      <h5 class="card-title" style="text-align: center;">Shop managers page</h5>
    </div>
  </div>

  <div style="display:flex;justify-content: space-around;padding:60px;" class="row" >
    <div class="row">
      <div class="card-body" style="margin: 20px 40px;border: 2px solid ;border-radius: 10px;width:30vw;align-items:center">
        <h3 style="text-align:center;">inventory</h3>
        <div class="column" style="align-items:center">
        <span class="d-block p-2 text-bg-dark">Name of shop : <?php echo $hesaru; ?></span>
        
          <span class="d-block p-2 text-bg-dark">List of products left : <?php 

      while($row4 = mysqli_fetch_array($res)){
            ?>
        <li class="list-group-item"><?php echo ($row4['name']);  echo ",  &nbsp   Quantity: ";printf($row4['quantity']);?></li>
          <?php
        }
      ?> </span>
      <form method="POST" action="editInventory.php">
        <input type="hidden" value="<?php echo $row['shop_id']; ?>" name="shopid" style="align:center">
          <button type="submit" class="btn btn-primary" >Edit</button>
      </form>
        </div>
      </div>

      <div class="row">
        <div class="card-body" style="margin: 20px 40px;border: 2px solid ;border-radius: 10px;width:30vw">
          <h3 style="text-align:center;">sales</h3>
          <div class="column">
            <span class="d-block p-2 text-bg-primary">Todays recent sales:</span>
            <span class="d-block p-2 text-bg-dark">
              <ul class="list-group">
                <?php 

                while($row1 = mysqli_fetch_array($res1)){
                  ?>
                  <li class="list-group-item"><?php echo "ID : ";printf($row1['product_id']);  echo ",     Quantity: ";printf($row1['quantity']);?></li>
                  <?php
                }
                ?>
              </ul>
              
            </span>
          </div>
        </div>
      </div>

    
    
    

    </div>
   

  </div>
  
</body>

</html>

