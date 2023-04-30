<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php"); //Redirecting to myrestaurant Page
}
if (isset($_SESSION['login_manager'])) {
    header("location: manager.php"); //Redirecting to myrestaurant Page
}
if (isset($_SESSION['login_admin'])) {
    header("location: admin.php"); //Redirecting to myrestaurant Page
}
?>

<?php
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $cnt = 0;
        $pos = 0;
        $RID = "hello";
        foreach ($_SESSION["cart"] as $keys => $values) {
            $RID = $values["R_ID"];
            if ($values["item_ID"] == $_GET["id"]) {
                $pos = $cnt;
            }
            $cnt = $cnt + 1;
        }
        $count = count($_SESSION["cart"]);
        while ($pos < ($count - 1)) {
            $_SESSION["cart"][$pos] = $_SESSION["cart"][$pos + 1];
            $pos = $pos + 1;
        }
        unset($_SESSION["cart"][$pos]);
        echo '<script>window.location="cart.php?rid=' . $_GET["rid"] . '"</script>';
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "empty") {
        foreach ($_SESSION["cart"] as $keys => $values) {
            $RID = $values["R_ID"];
            unset($_SESSION["cart"]);
            echo '<script>window.location="cart.php?rid=' . $_GET["rid"] . '"</script>';
        }
    }
}

if (!isset($_GET["rid"])) {
    unset($_SESSION["cart"]);
    header("location: restaurant_choose.php");
}


?>

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("placeorder").style.display = "none";
    };

    function addAdd() {
        document.getElementById("placeorder").style.display = "block";
    }
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <h1>Cart</h1>
        </div>
    </div>
    <div class="site-section" id="section-home">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="400">

                <div class="col-md-12">
                    <?php
                    if (!empty($_SESSION["cart"])) {
                    ?>
                        <div class="container">
                            <div class="jumbotron" style="margin-top: 4rem">
                                <h1 style="color: rgb(77,77,77) !important">Your Shopping Cart</h1>
                            </div>
                        </div>
                        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="40%">Food Name</th>
                                        <th width="10%">Quantity</th>
                                        <th width="20%">Price Details</th>
                                        <th width="15%">Order Total</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>

                                <?php

                                $total = 0;
                                foreach ($_SESSION["cart"] as $keys => $values) {
                                ?>
                                    <tr style="background-color: #e9ecef">
                                        <td><?php echo $values["name"]; ?></td>
                                        <td><?php echo $values["quantity"] ?></td>
                                        <td>&#8377; <?php echo $values["price"]; ?></td>
                                        <td>&#8377; <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                                        <td><a href="cart.php?action=delete&id=<?php echo $values["item_ID"]; ?>&rid=<?php echo $_GET["rid"]; ?>"><span class="text-danger">Remove</span></a></td>
                                    </tr>
                                <?php
                                    $total = $total + ($values["quantity"] * $values["price"]);
                                }
                                ?>
                                <tr style="color: #FFFFFF; background-color: #212529">
                                    <td colspan="3" align="right">Total</td>
                                    <td align="right">&#8377; <?php echo number_format($total, 2); ?></td>
                                    <td></td>
                                </tr>
                            </table>
                            <?php
                            echo '<a href="cart.php?action=empty&rid=' . $_GET["rid"] . '"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</button></a>&nbsp;<a href="restaurant.php?rid=' . $_GET["rid"] . '"><button class="btn btn-warning">Continue Shopping</button></a>&nbsp;<a onclick="addAdd()"><button class="btn btn-success pull-right" data-toggle="modal" data-target="#placeorder"><span class="glyphicon glyphicon-share-alt" ></span> Check Out</button></a>';
                            ?>

                        </div>
                        <br><br><br><br><br><br><br>
                    <?php
                    }
                    if (empty($_SESSION["cart"])) {
                    ?>
                        <div class="container">
                            <div class="jumbotron" style="margin-top: 4rem">
                                <h1 style="color: rgb(77,77,77) !important">Your Shopping Cart</h1>
                                <p style="color: rgb(77,77,77) !important">Oops!.Go back and <a href="restaurant.php?rid=<?php echo $_GET["rid"]; ?>">order now.</a></p>

                            </div>

                        </div>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="placeorder" tabindex="-1" role="dialog" style="margin-top: 10rem">
        <div class="modal-dialog mw-100 w-75" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Delivery Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="payment.php" method="POST" class="p-5 bg-white">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <h4 class="text-primary">Type your address</h4>
                                <input type="text" name="address" id="address" list="chooseaddress" style="height: 5rem" class="form-control" required>
                                <datalist id="chooseaddress">
                                    <?php
                                    $username = $_SESSION['login_customer'];
                                    $address_query = "select * from address where username='" . $username . "'";
                                    $result = mysqli_query($conn, $address_query);
                                    while ($add_row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $add_row["address"] . '">' . $add_row["address"] . '</option>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Place Order" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>