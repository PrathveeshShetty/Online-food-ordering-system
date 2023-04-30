<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset($_SESSION['login_customer'])) {
    header("location: index.php"); //Redirecting to myrestaurant Page
}

if (!isset($_GET["orderid"])) {
    header("location: customer.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
    <div class="container text-center">
        <li><a href="customer.php" class="nav-link">Welcome, <?php echo $_SESSION["login_customer"] ?></a></li>
        <li><a href="restaurant_choose.php"><span class="glyphicon glyphicon-shopping-cart"></span>Restaurants</a></li>
        <li><a href="logout.php" class="nav-link">Logout</a></li>
        <h1>Add Review</h1>
    </div>
</div>

<div class="site-section" id="section-home" style="background-image: url(images/food_bg.jpg); background-size: cover; margin-top: -2rem">
    <div class="m" role="dialog" style="color:#000000;">
        <div class="modal-dialog" role="document" style="width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Review of Order No: <?php echo $_GET["orderid"] ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-12">
                            <div class="credit-card-div">
                                    <div class="panel-heading" style="position: relative; left:-50rem">
                                        <form action="add_review_action.php?orderid=<?php echo $_GET["orderid"] ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <h5 class="text-muted" style="color:#000000 !important; font-size: 20px"> Rating</h5>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" name="rating" class="form-control" min="1" max="5" placeholder="5" required />
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h5 class="text-muted" style="color:#000000 !important; font-size: 20px"> Description</h5>
                                                    <input type="text" style="height:10rem" name="description" class="form-control" maxlength="2000" required />
                                                </div>
                                            </div>
                                            <div class="row " style="margin-top: 10px">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input type="submit" class="form-control btn btn-success" value="Submit" />
                                                </div>
                                            </div>
                                            <form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<body>

</body>

</html>