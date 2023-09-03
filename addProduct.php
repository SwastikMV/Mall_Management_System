<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');


if (empty($_SESSION['username'])) {
    header('location:index.php');
}
mysqli_select_db($con, 'mms');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Add Product</title>
</head>

<body>

    <style>


    </style>

    <div class="card">
        <div class="card-header">
            MMS
        </div>
        <div class="card-body row">
            <button class="btn"> <a href="editInventory.php">Back </a> </button>
            <h5 class="card-title" style="text-align: center;margin:auto;">Add Product</h5>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sid = $_POST['sid'];
    } else {
        header('location:shopmanager.php');
    }
    ?>
    <form style="margin:20px auto; width: 40vw;" method="POST" action="addProductValidation.php">
        
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Shop ID</label>
            <div class="col-sm-10">
                <input type="text" name='sid' readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $sid ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name='name' class="form-control" placeholder="Name">
            </div>
        </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="number" name='price' class="form-control" placeholder="Price">
            </div>
        </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="number" name='qty' class="form-control" placeholder="Quantty">
            </div>
        </div>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>

    </form>

</body>

</html>