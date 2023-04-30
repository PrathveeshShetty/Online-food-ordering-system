<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php"); //Redirecting to myrestaurant Page
}
if (isset($_SESSION['login_manager'])) {
    header("location: index.php"); //Redirecting to myrestaurant Page
}
if (isset($_SESSION['login_admin'])) {
    header("location: index.php"); //Redirecting to myrestaurant Page
}

unset($_SESSION["cart"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <h1>Order Received</h1>
        </div>
    </div>
    <div class="site-section" id="section-home" style="background-image: url(images/food_bg.jpg); background-size: cover; margin-top: -2rem">

        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: green; padding-top: 5rem;"><span class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
            </div>
        </div>
        <br>
        <div class="container">
            <div style="background-color: #FFFFFF; padding-top:5rem; padding-bottom:5rem">

                <h3 class="text-center"> <strong>Your Order Number:</strong> <span><?php echo $_GET["orderid"]; ?></span> </h3>


                <div class="container">
                    <h5 class="text-center">Please read the following information about your order.</h5>
                    <div class="box">
                        <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                            <h4 style="color: black;">Your Shopping Cart Has Been Emptied</h3>

                                <h4>The items you purchased have been removed from your cart.</h4>
                        </div>
                        <h1 class="text-center">
                            <a href="restaurant_choose.php"><button class="btn btn-success"><span class="glyphicon glyphicon-circle-arrow-left"></span> Another Order</button></a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>