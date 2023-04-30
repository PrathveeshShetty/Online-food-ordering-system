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

<body>
    <div class="modal fade" id="signupDialog" tabindex="-1" role="dialog" onclick="func()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3>
                    <div id="dialogMsg" class="modal-body bg-primary">
                    </div>
                </h3>
                <div class="modal-footer">
                    <a type="button" href="customer.php" class="btn btn-primary">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $order_ID = $_GET["orderid"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    $query = "insert into review (rating, description, order_ID) values(" . $rating . ",'" . $description . "'," . $order_ID . ")";
    $success = $conn->query($query);

    $rating_query = 'select * from review where review.order_ID in (select orders.order_ID from orders where orders.R_ID = (select orders.R_ID from orders where order_ID = ' . $order_ID . '))';
    $rating_result = mysqli_query($conn, $rating_query);
    $trating = 0;
    $cnt = 0;
    while ($rating_row = mysqli_fetch_assoc($rating_result)) {
        $trating = $trating + $rating_row["rating"];
        $cnt = $cnt + 1;
    }
    echo $trating;
    echo $cnt;
    $final_rating = ($trating / $cnt);

    $update_rating = 'update restaurant set restaurant.rating = ' . $final_rating . ' where restaurant.R_ID in (select orders.R_ID from orders where orders.order_ID = ' . $order_ID . ')';
    $success = $conn->query($update_rating);

    $msg = "Review Added Succesfully";
    echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';


    ?>

    <script>
        function func() {
            window.location = "customer.php";
        }
    </script>


</body>

</html>