<?php
session_start(); // Starting Session
if (isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: index.php');
}

if (!isset($_SESSION['login_manager'])) { //if manager not logged in
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Delivered</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="modal fade" id="signupDialog" tabindex="-1" role="dialog" onclick="window.location='manager.php'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3>
                    <div id="dialogMsg" class="modal-body bg-primary">
                    </div>
                </h3>
                <div class="modal-footer">
                    <a type="button" href="manager.php" class="btn btn-primary">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    require 'connection.php';

    $conn = Connect();

    if (isset($_GET['id'])) {
        $order_ID = $_GET['id'];
        $query = "update orders set order_status='DELIVERED' where order_ID='$order_ID'";
        $success = $conn->query($query);

        if (!$success) {
            $msg = "Failed to change order status";
            echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';
        }

        $conn->close();
    }
    header('location: manager.php');
    ?>
</body>

</html>