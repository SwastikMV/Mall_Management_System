
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
    header('location:login.php');
}




mysqli_select_db($con, 'mms');
$q = $_GET['q'];


$sql="SELECT * FROM product WHERE name = '$q' ";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td><input  type='number' name='price[]' value=".$row['s_price']." placeholder='Unit Price' class='form-control price' step='0.00' min='0' readonly/></td>";
  echo "<td> <input type='number' id='qty' name='qty[]' placeholder='Enter Qty' value='1' class='form-control qty' step='0' min='0' /> </td>";
  echo "<td><input type='number' name='total[]' placeholder='0.00' class='form-control total' readonly /></td>";
  echo "</tr>";
}
mysqli_close($con);
?>