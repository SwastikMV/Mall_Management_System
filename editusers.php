<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<?php
  $q1 = "select * from users order by name asc";
  $res1 = mysqli_query($con, $q1);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>editusers</title>
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
    <button class="btn"> <a href="admin/admins.php">Back </a> </button>
      <h5 class="card-title" style="text-align: center;margin:auto;">Edit Users</h5>
    </div>
  </div>

  <table style="margin:35px auto ;width:max-content;">
  <tr>
    <th>Name</th>
    <th>User Type</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <?php 
  while($row1 = mysqli_fetch_array($res1)){
  ?>
  <tr><form method="POST" action="edit.php">
    <input type='hidden' name='username' value='<?php echo $row1['username']?>'>
    <td><?php echo $row1['name']?></td>
    <td><?php echo $row1['user_type']?></td>
    <td><?php echo $row1['username']?></td>
    <td><input type='submit'  value="Edit"></input> </td>
  </form>
  </tr>
  <?php } ?>
</table>
