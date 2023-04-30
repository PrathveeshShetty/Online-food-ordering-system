<?php
session_start(); // Starting Session

if (isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_manager'])) { //if manager logged in
    header('location: manager.php');
}

if (!isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: index.php');
}

require 'connection.php';

$conn = Connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="site-section" style="padding-top: 5rem">
        <p class="text-center"><a href="logout.php">LogOut Admin</a></p>

        <h1 class="text-center text-primary">
            Restaurants
        </h1>
        <table class="table table-striped table-hover container" style="margin-left: 15rem; width :75%">
            <tr>
                <th>R_ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Phone_number</th>
                <th>Action</th>
            </tr>
            <?php
            $query = "select * from restaurant order by restaurant.R_ID";
            $result = $conn->query($query);
            while ($row = ($result->fetch_assoc())) {
                echo
                '
                            <tr>
                                <td>' . $row['R_ID'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['location'] . '</td>
                                <td>' . $row['phone_number'] . '</td>
                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#restaurant' . $row['R_ID'] . '">
                                    EXPAND
                                </button>
                                </td>
                            </tr>
                    ';
            }
            ?>
        </table>
    </div>

    <?php
    $query = "select * from restaurant";
    $result = $conn->query($query);
    while ($row = ($result->fetch_assoc())) {
        echo '
                        <div class="modal fade" id="restaurant' . $row['R_ID'] . '" tabindex="-1" role="dialog" aria-labelledby="restaurantLabel' . $row['R_ID'] . '">
                                    <div class="modal-dialog mw-100 w-75" role="document"  >
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-primary" id="restaurantLabel' . $row['R_ID'] . '">MANAGERS OF RESTAURANT: ' . $row['name'] . '</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover container">
                                                <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Contact_no</th>
                                                <th>Action</th>
                                                </tr>
                            ';
        $query = "select * from manager where R_ID='" . $row['R_ID'] . "'";
        $result_item = $conn->query($query);
        while ($row_item = ($result_item->fetch_assoc())) {
            echo
            '
                                                <tr>
                                                <td>' . $row_item['name'] . '</td>
                                                <td>' . $row_item['email'] . '</td>
                                                <td>' . $row_item['address'] . '</td>
                                                <td>' . $row_item['contact_no'] . '</td>
                                                <td>
                                                <a href="delete_manager_action.php?id=' . $row_item['username'] . '" type="button" class="btn btn-primary btn-sm text-white">Delete</a>
                                                </td>
                                                </tr>
                                    ';
        }

        echo
        '
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="delete_restaurant_action.php?id=' . $row['R_ID'] . '" type="button" class="btn btn-primary text-white">Delete Restaurant</a>
                                            <a href="add_manager.php?id=' . $row['R_ID'] . '" type="button" class="btn btn-primary text-white">Add Manager</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                    ';
    }
    ?>
    <div class="container" id="demo" class="collapse">
        <div class="row mb-5">
            <div class="col-md-12 order-md-1" data-aos="fade-up">
                <div class="text-left pb-1 border-primary mb-4">
                    <h2 class="text-primary">ADD RESTAURANT</h2>
                </div>
                <div id="customersignup">
                    <div class="row">
                        <div class="col-md-7">

                            <form action="add_restaurant_action.php" method="POST" enctype="multipart/form-data" class="p-5 bg-white">

                                <div class="row form-group">
                                    <div class="col-md-12 mb-6 mb-md-0">
                                        <label class="text-black" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12 mb-6 mb-md-0">
                                        <label class="text-black" for="location">Location</label>
                                        <input type="text" name="location" id="location" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12 mb-6 mb-md-0">
                                        <label class="text-black" for="phone_number">Phone_number</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit" value="ADD" class="btn btn-primary py-2 px-4 text-white">
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>