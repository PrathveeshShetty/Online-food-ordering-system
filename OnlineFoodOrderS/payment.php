<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php");
}
if (isset($_SESSION['login_manager'])) {
    header("location: index.php");
}
if (isset($_SESSION['login_admin'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <h1>Choose your payment option</h1>
        </div>
    </div>
    <?php
    $g_total = 0;
    foreach ($_SESSION["cart"] as $keys => $values) {
        $total = ($values["quantity"] * $values["price"]);
        $g_total = $g_total + $total;
    }
    ?>
    <div class="site-section" id="section-home" style="background-size: cover; margin-top: -2rem">
        <div class="container">
            <div class="" style="height: 10rem">
                <h1 class="text-center" style="margin: auto ; padding: 5rem;">Delivery Address: <?php if (isset($_POST["address"])) {
                                                                                                    echo $_POST["address"];
                                                                                                } else {
                                                                                                    echo $_GET["address"];
                                                                                                } ?></h1><br>
            </div>
            <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th width="40%">Food Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price Details</th>
                            <th width="15%">Order Total</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($_SESSION["cart"] as $keys => $values) {
                    ?>
                        <tr style="background-color: #e9ecef">
                            <td><?php echo $values["name"]; ?></td>
                            <td><?php echo $values["quantity"] ?></td>
                            <td>&#8377; <?php echo $values["price"]; ?></td>
                            <td>&#8377; <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <h1 class="text-center" style="color: black">Grand Total: &#8377;<?php echo "$g_total"; ?>/-</h1>
            <br>
            <h1 class="text-center">
                <a href="cart.php?rid=<?php echo $_SESSION["cart"][0]["R_ID"]; ?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go back to cart</button></a>
                <button class="btn btn-success" data-toggle="modal" data-target="#onlineod"><span class="glyphicon glyphicon-"></span> Pay Online</button>
                <a href="cashpay.php?address=<?php if (isset($_POST["address"])) {
                                                    echo $_POST["address"];
                                                } else {
                                                    echo $_GET["address"];
                                                } ?>"><button class="btn btn-success"><span class="glyphicon glyphicon-"></span> Cash On Delivery</button></a>
            </h1>
        </div>
    </div>
    <div class="modal" id="onlineod" tabindex="-1" role="dialog" style="margin-top: 10rem">
        <div class="modal-dialog mw-100 w-75" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Online Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="credit-card-div">
                                    <div class="panel-heading" style="position: relative; left:-30rem;">

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h5 class="text-muted"> Credit Card Number</h5>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input type="text" class="form-control" placeholder="0000" maxlength="4" required>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input type="text" class="form-control" placeholder="0000" maxlength="4" required>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input type="text" class="form-control" placeholder="0000" maxlength="4" required>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <input type="text" class="form-control" placeholder="0000" maxlength="4" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font"> Expiry Month</span>
                                                <input type="text" class="form-control" placeholder="MM" maxlength="2" required>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font"> Expiry Year</span>
                                                <input type="text" class="form-control" placeholder="YY" maxlength="2" required>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font"> CVV</span>
                                                <input type="text" class="form-control" placeholder="CVV" maxlength="3" required>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-12 pad-adjust">

                                                <input type="text" class="form-control" placeholder="Name On The Card" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                                <a href="payment.php?address=<?php if (isset($_POST["address"])) {
                                                                                    echo $_POST["address"];
                                                                                } else {
                                                                                    echo $_GET["address"];
                                                                                } ?>"><input type="submit" class="btn btn-danger btn-block" value="CANCEL" required="" /></a>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                                <a href="onlinepay.php?address=<?php if (isset($_POST["address"])) {
                                                                                    echo $_POST["address"];
                                                                                } else {
                                                                                    echo $_GET["address"];
                                                                                } ?>"><input type="submit" class="btn btn-success btn-block" value="PAY NOW" required="" /></a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>