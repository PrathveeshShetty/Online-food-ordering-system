 <?php
session_start(); // Starting Session
if (isset($_SESSION['login_customer'])) { 
    header('location: index.php');
}

if (isset($_SESSION['login_admin'])) { 
    header('location: index.php');
}

if (!isset($_SESSION['login_manager'])) { 
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item Action</title>
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

    if (isset($_POST['submit'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $price = $_POST['price'];
        $description = $conn->real_escape_string($_POST['description']);
        $username = $_SESSION['login_manager'];
        $msg = "Failed to add menu item";
        $query = "select * from manager where username='$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $R_ID = $row['R_ID'];
            $query = "insert into menu_item(name,price,description,R_ID) values('$name','$price','$description','$R_ID')";
            $success = $conn->query($query);

            if ($success) {
                $msg = "Menu item added successfully";
            }

            $item_ID = $conn->insert_id;
        }
        echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';
        $conn->close();
    } else {
        header('location: manager.php');
    }
    ?>
</body>

</html>