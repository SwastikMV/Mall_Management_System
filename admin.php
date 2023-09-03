<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
    header('location:login.php');
}
mysqli_select_db($con, 'mms');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<style>
    a{
        color : white;
    }
    a:hover{
        color:white;
    }
</style>

<?php
$q1 = "select * from floor";
$res1 = mysqli_query($con, $q1);
$selected_floor = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $selected_floor = $_POST['floors'];
}
$q2 = "select * from shop where floor_no = $selected_floor";
$res2 = mysqli_query($con, $q2);

?>

<body>
    <div class="card">
        <div class="card-header">
            MMS
            <div style="display:flex;float:right">

                <form method="POST" action="login.php">
                    <input type="hidden" value="logout" name="type">
                    <button type="submit" class="btn btn-primary"> LOG OUT </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Admin page</h5>
        </div>
    </div>
</body>

<div style="display:flex;justify-content: space-around;" class="row">
    <div class="row">
        <div class="card-body" style="margin: 100px;border: 2px solid ;border-radius: 10px;width:30vw">
            <h3 style="text-align:center;">all shop details</h3>
            <div class="column">
                <form method="POST" action="">
                <span class="d-block p-2 text-bg-dark">Select floor :
                    <select name="floors" onchange="this.form.submit()" action="" >
                    <?php 
                        while($row1 = mysqli_fetch_array($res1)){
                        ?>
                        <option value=<?php echo $row1['floor_no']?> <?php if($row1['floor_no']==$selected_floor) echo 'selected'  ?>><?php echo $row1['floor_no']?> </option>
                        <?php } ?>
                    </select>
                </span>
                </form>
                <?php 
                if(isset($_POST["floors"])){
                    $selected_floor =$_POST["floors"];
                    $q2 = "select * from shop where floor_no = $selected_floor";
                    $res2 = mysqli_query($con, $q2);
                }
                ?>
                <ul class="list-group">
                <?php 

                while($row2 = mysqli_fetch_array($res2)){
                  ?>
                  <form method="POST" action="editShop.php">
                    <input name="shopid" type="hidden" value="<?php echo $row2['shop_id']; ?>">
                  <li class="list-group-item"><?php echo $row2['name']; ?><button type="submit" style="display:flex;float:right;" class="btn btn-primary">Edit</button></li>
                  </form>
                  <?php
                }
                ?>
              </ul>
                
            </div>
        </div>

        <div class="row">
            <div class="card-body" style="margin: 100px;border: 2px solid ;border-radius: 10px;width:30vw">
                <h3 style="text-align:center;">handle users</h3>
                <div class="column">
                    <span class="d-block p-2 text-bg-primary"><button type="button" style="display:flex;float:center;" class="btn btn-primary"><a href='displayusers.php'>View all users</a></button></span>
                    <span class="d-block p-2 text-bg-primary"><button type="button" style="display:flex;float:center;" class="btn btn-primary"><a href='editusers.php'>Edit users</a></button></span>
                    <span class="d-block p-2 text-bg-primary"><button type="button" style="display:flex;float:center;" class="btn btn-primary"><a href='adduser.php'>Add user</a></button></span>
                </div>
            </div>
        </div>





    </div>


</div>

</html>