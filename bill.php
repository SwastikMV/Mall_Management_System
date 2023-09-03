<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Bootstrap Css -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="bill.js"></script>
  <link href="assets/css/style.css" rel="stylesheet">
  <title>Billing</title>
</head>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
  header('location:login.php');
}




mysqli_select_db($con, 'mms');
?>

<body>

  <?php
  $user = $_SESSION['username'];
  $q = "select * from shop where manager_id='$user'";
  $res = mysqli_query($con, $q);
  $row = mysqli_fetch_assoc($res);
  $q = "select * from users where username='$user'";
  $res = mysqli_query($con, $q);
  $row = mysqli_fetch_assoc($res);
  ?>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">MMS</span>
      </a>
    </div><!-- End Logo -->


  </header><!-- End Header -->

  <main id="main" class="main">

    <script>
      function showUser(str) {
        if (str == "") {
          document.getElementById("tab_logic").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("tab_logic").innerHTML += this.responseText;
              console.log();
            }
          };
          xmlhttp.open("GET", "getprice.php?q=" + str, true);
          xmlhttp.send();
        }
      }

      function quantity(num) {
        document.getElementsById("qty").innerHTML = num;
      }
    </script>
<input type="text" name='term' id="term" value="<?php $qty; ?>" onchange="showUser(document.getElementById('term').value)" placeholder='Enter Product Name' class="form-control" />
    <!-- <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> Product </th>
                <th class="text-center"> Qty </th>
                <th class="text-center"> Price </th>
                <th class="text-center"> Total </th>
              </tr>
            </thead>
            <tbody>
              <tr id='addr0'>
                <td>1</td>
                <form>
                  <td><input type="text" name='term' id="term" value="<?php $qty; ?>" onchange="showUser(document.getElementById('term').value)" placeholder='Enter Product Name' class="form-control" /></td>
                  <td><input type="number" name='qty[]' id="quan" placeholder='Enter Qty' onchange="quantity(document.getElementById('quan').value)" class="form-control qty" step="0" min="0" /></td>
                  <td><input id="s_p" type="number" name='price[]' value="<?php $row1['price']; ?>" placeholder='Unit Price' class="form-control price" step="0.00" min="0" /></td>
                  <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly /></td>
                </form>

              </tr>
              <tr id='addr1'></tr>
            </tbody>
          </table>
        </div>
      </div> -->
      <div>
        <table id="tab_logic" class="table table-bordered table-hover">
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </table>
      </div>

      <!-- <div class="row clearfix">
        <div class="col-md-12">
          <button id="add_row" class="btn btn-default pull-left">Add Row</button>
          <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
        </div>
      </div> -->

      <div class="row clearfix" style="margin-top:20px">
        <div class="pull-right col-md-4">
          <table class="table table-bordered table-hover" id="tab_logic_total">
            <tbody>
              <tr>
                <th class="text-center">Sub Total</th>
                <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
              </tr>
              <tr>
                <th class="text-center">Tax</th>
                <td class="text-center">
                  <div class="input-group mb-2 mb-sm-0">
                    <input type="number" class="form-control" id="tax" placeholder="0">
                    <div class="input-group-addon">%</div>
                  </div>
                </td>
              </tr>
              <tr>
                <th class="text-center">Tax Amount</th>
                <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly /></td>
              </tr>
              <tr>
                <th class="text-center">Grand Total</th>
                <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
  <!-- Script -->

  <script type="text/javascript">
    $(function() {
      $("#term").autocomplete({
        source: 'ajax-db-search.php',
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- jQuery UI -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Bootstrap Css -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

</body>