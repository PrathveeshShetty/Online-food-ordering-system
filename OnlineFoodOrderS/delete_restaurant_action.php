<?php
session_start();
if (isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_manager'])) { //if manager not logged in
    header('location: manager.php');
}

if (!isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="modal fade" id="signupDialog" tabindex="-1" role="dialog" onclick="window.location='admin.php'">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3>
                    <div id="dialogMsg" class="modal-body bg-primary">
                    </div>
                </h3>
                <div class="modal-footer">
                    <a type="button" href="admin.php" class="btn btn-primary">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    require 'connection.php';

    $conn = Connect();

    if (isset($_GET['id'])) {
        $R_ID = $_GET['id'];
        $query = "delete from manager where R_ID='$R_ID'";
        $success = $conn->query($query);
        $query = "delete from menu_item where R_ID='$R_ID'";
        $success = $conn->query($query);
        $query = "delete from orders where R_ID='$R_ID'";
        $success = $conn->query($query);
        $query = "delete from restaurant where R_ID='$R_ID'";
        $success = $conn->query($query);
        if (!$success) {
            $msg = "Failed to delete restaurant";
            echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';
        }
        $conn->close();

        unlink("images/restaurants/restaurant_" . $R_ID . ".jpg");
    }

    header('location: admin.php');
    ?>
</body>

</html>