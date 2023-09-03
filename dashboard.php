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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard-Shop Manager</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php
    $user = $_SESSION['username'];
    $q = "select * from shop where manager_id='$user' ";
    $res = mysqli_query($con, $q);
    $row = mysqli_fetch_assoc($res);

    $q3 = "select * from users where username='$user'";
    $res3 = mysqli_query($con, $q3);
    $row3 = mysqli_fetch_assoc($res3);


    $hesaru = $row['name'];
    $shopid = $row['shop_id'];
    $_SESSION['shop_id'] = $shopid;
    $q2 = "select * from product natural join inventory where shop_id='$shopid'";
    $res2 = mysqli_query($con, $q2);
    $q1 = "select * from transaction t where t.shop_id IN(select shop_id from shop where manager_id='$user') order by t.transaction_id desc";
    $res1 = mysqli_query($con, $q1);

    $q4 = "select * from goods where shop_id = (select shop_id from shop where name='$hesaru')";
    $res4 = mysqli_query($con, $q4);

    $q5 = "select distinct(customer_name) from transaction t where t.shop_id IN(select shop_id from shop where manager_id='$user')";
    $res5 = mysqli_query($con, $q5);
    ?>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">MMS</span>
            </a>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <button class="btn btn-primary m-5" onclick="location.href = 'bill.php';">Generate Bill</button>
                        <img src="1698.jpg" alt="Profile" class="rounded-circle">

                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row3['name'] ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $row3['name'] ?></h6>
                            <span>Shop Manager</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>



                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="login.php">
                                <input type="hidden" value="logout" name="type">

                                <a class="dropdown-item d-flex align-items-center">

                                    <button style="margin: auto;" class="btn center" type="submit" class="btn btn-primary"> LOG OUT </button>

                                </a>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active"><?php echo $row['name'] ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row" style="margin: auto; width: 80vw">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">



                        <div class="card-body">
                            <h5 class="card-title">Sales <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo mysqli_num_rows($res1) ?></h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">



                        <div class="card-body">
                            <h5 class="card-title">Revenue <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>₹3,264</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">


                        <div class="card-body">
                            <h5 class="card-title">Customers <span>| This Year</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo mysqli_num_rows($res5) ?></h6>

                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->


                <!-- Left side columns -->
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                    <table class="table table-borderless ">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            while ($row1 = mysqli_fetch_array($res1)) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><a href="">#<?php echo $row1['transaction_id'] ?></a></th>
                                                    <td><?php echo $row1['customer_name'] ?></td>
                                                    <td><a href="#" class="text-primary">Product: <?php echo $row1['product_id'] ?></a></td>
                                                    <td><?php echo $row1['quantity'] ?></td>

                                                </tr>
                                            <?php
                                            }
                                            ?>


                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                        <!-- Top Selling -->


                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-6">

                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            

                            <div class="card-body pb-0">
                                <h5 class="card-title">Inventory </h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-8">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($row4 = mysqli_fetch_array($res2)) {
                                        ?>

                                            <tr>
                                                <td><a href="" class="text-primary fw-bold"><?php echo ($row4['name']); ?></a></td>
                                                <td>₹<?php echo ($row4['s_price']); ?></td>
                                                <td class="fw-bold"><?php echo ($row4['quantity']); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>


                                <form method="POST" action="editInventory.php" style="margin: 10px auto; ">
                                    <input type="hidden" value="<?php echo $row['shop_id']; ?>" name="shopid" style="align:center">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->



                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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