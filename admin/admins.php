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

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>admin page</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.11.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>MMS</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown"><a href="#"><span>Manipulate users</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="/Mms/adduser.php">Add users</a></li>
              <li><a href="/Mms/displayusers.php">View users</a></li>
              <li><a href="/Mms/editusers.php">Edit users</a></li>
            </ul>
          </li>
          <div style="display:flex;float:right;padding-left:30px">

                <form method="POST" action="/Mms/login.php">
                    <input type="hidden" value="logout" name="type">
                    <button type="submit" class="btn btn-primary"> LOG OUT </button>
                </form>
            </div>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">ADMIN</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Admin can see,alter,edit all shop details and user details.</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>See all shop details</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h2 style="size:30px;">All shop details.</h2>
              <p>
                You can select the required floor and edit all the shop details.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Move up</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
          <div class="row">
        <div class="card-body" style="margin: 100px;border: 2px solid ;border-radius: 10px;width:30vw">
            <h3 style="text-align:center;">all shop details</h3>
            <div class="column">
                <form method="POST" action="#about">
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
                  <form method="POST" action="/Mms/editShop.php">
                    <input name="shopid" type="hidden" value="<?php echo $row2['shop_id']; ?>">
                  <li class="list-group-item" style="height:56px;"><?php echo $row2['name']; ?><button type="submit" style="display:flex;float:right;margin:auto" class="btn btn-primary">Edit</button></li>
                  </form>
                  <?php
                }
                ?>
              </ul>
                
            </div>
        </div>

          </div>

        </div>
      </div>

    </section><!-- End About Section -->

   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>