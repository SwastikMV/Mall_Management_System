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

<style>
  table, th, td {
  border: 2px solid;
  padding: 20px;
}
</style>

<?php
$username = $_SESSION['username'];
$q1 = "select * from owner where username='$username'";
$res1 = mysqli_query($con, $q1);
$row1 = mysqli_fetch_assoc($res1);
$q2 = "select * from shop where owner_id = (select owner_id from owner where username='$username')";
$res2 = mysqli_query($con, $q2);
$q3 = "select * from shop where owner_id = (select owner_id from owner where username='$username')";
$res3 = mysqli_query($con, $q3);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>owner</title>
</head>

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
    <div class="card-body" style="background-image: url('owner.png');">
      <h5 class="card-title" style="text-align: center;">Owner's page</h5>
    </div>
  </div>
  <div style="display:flex;justify-content: space-around;">
    <div class="row">
      <div class="card-body" style="margin: 150px;border: 2px solid ;border-radius: 10px;width: 40vw">
        <h3 style="text-align:center;">details</h3>
        <div class="column">
          <span class="d-block p-2 text-bg-primary">Name : <?php echo $row1['name']; ?></span>
          <span class="d-block p-2 text-bg-dark">ID : <?php
                                                      echo $row1['owner_id'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Address : <?php
                                                            echo $row1['address'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Phone : <?php
                                                          echo $row1['phone'] ?> </span>
          <span class="d-block p-2 text-bg-dark">Email : <?php
                                                          echo $username; ?> </span>
          <span class="d-block p-2 text-bg-primary">List of shops : </span>
          <?php

          while ($row2 = mysqli_fetch_array($res2)) {

          ?>
            <li class="list-group-item"><?php printf($row2['name']) ?></li>
          <?php
          }
          ?>
          <span class="d-block p-2 text-bg-primary" style="padding: top 30px;">This weeks stats of shop: </span>
          <span class="d-block p-2 text-bg-dark">

            <table style="margin:20px auto ;width:max-content;">
              <tr>
                <th>Name</th>
                <th>Top Line</th>
                <th>Bottom Line</th>
              </tr>
              <?php
              while ($row3 = mysqli_fetch_array($res3)) {
              ?>
                <tr>
                  <td><?php echo $row3['name'] ?></td>
                  <td>
                  <?php 
                  $q4 = "select * from transaction where shop_id='$row3[shop_id]'";
                  $res4 = mysqli_query($con, $q4);
                  $sum=0;
                  $profit = 0;
                while ($row4 = mysqli_fetch_array($res4)){
                    $q5 = "select * from product where product_id='$row4[product_id]'";
                    $res5 = mysqli_query($con, $q5);
                    $row5 = mysqli_fetch_array($res5);
                    $sum += $row4['quantity']*$row5['s_price'];
                    $profit += ( ($row4['quantity']*$row5['s_price'])-($row4['quantity']*$row5['price']) );
                 }
                  echo $sum; 
                  ?> 
                  </td>
                  <td><?php echo $profit; ?></td>
                </tr>
              <?php } ?>
            </table>

          </span>
          <div>
             <!-- Reports -->
             <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/This Month</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->


          </div>

      </div>



    </div>

  </div>
  </div>

  </div>

   <!-- Vendor JS Files -->
   <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>