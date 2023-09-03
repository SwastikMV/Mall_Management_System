<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


mysqli_select_db($con, 'mms');
?>

<?php
  $hesaru = 1;
  $q1 = "select * from floor where floor_no=$hesaru";
  $res1 = mysqli_query($con, $q1);
  $row1 = mysqli_fetch_assoc($res1);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>floor</title>
</head>

<body>
  <div class="card">
    <div class="card-header">
      MMS
    </div>
    <div class="card-body">
      <h5 class="card-title" style="text-align: center;">Floor</h5>
    </div>
  </div>

  <div style="display:flex;justify-content: space-around;">
      <div class="row">
        <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;width : 40vw">
          <h3 style="text-align:center;">details</h3>
          <div class="column">
            <span class="d-block p-2 text-bg-primary">Floor number : <?php echo $hesaru; ?></span>
            <span class="d-block p-2 text-bg-dark">No of categories : <?php 
            echo $row1['no_of_categories']?> </span>
            <span class="d-block p-2 text-bg-dark">No of shops : <?php 
            echo $row1['no_of_shops']?> </span>
            <span class="d-block p-2 text-bg-dark">Shops to let : <?php 
            echo $row1['shops_to_let']?> </span>
            
              <ul class="list-group">
                
              </ul>
            </span>
          </div>
        </div>
      </div>


    </div>

  </div>
</body>

</html>

