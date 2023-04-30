<?php
session_start(); // Starting Session
if (isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: admin.php');
}

if (!isset($_SESSION['login_manager'])) { //if manager logged in
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
    <title>Manager Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="site-navbar py-3 js-site-navbar site-navbar-target" role="banner" id="site-navbar">

        <div class="container">
            <div class="row align-items-center">

                <div class="text-center text-primary" style="font-size: large;">
                    <a href="manager.php">
                        <?php
                        $username = $_SESSION['login_manager'];
                        $query = "select * from manager where username='$username'";
                        $result = $conn->query($query);
                        echo "Welcome ";
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['name'];
                        }
                        ?>
                    </a>
                </div>

                <div class="site-section" style="padding-top: 2rem">
                    <p class="text-center"><a href="logout.php">LogOut Manager</a></p>
                    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3"></span></a></div>

                </div>

            </div>
        </div>

    </header>
    <div class="site-section" style="padding-top: 5rem">
        <h1 class="text-center text-primary">
            Menu
        </h1>
        <table class="table table-striped table-hover container" style="margin-left: 15rem; width :75%">
            <tr>
                <th>Item_ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php
            $username = $_SESSION['login_manager'];
            $query = "select * from manager, menu_item where manager.username='$username' and menu_item.R_ID=manager.R_ID order by menu_item.item_ID";
            $result = $conn->query($query);
            while ($row = ($result->fetch_assoc())) {
                echo
                '
                            <tr>
                                <td>' . $row['item_ID'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['price'] . '</td>
                                <td>' . $row['description'] . '</td>
                                <td>
                                <a href="delete_item_action.php?id=' . $row['item_ID'] . '" type="button" class="btn btn-primary btn-sm text-white">Delete</a>
                                </td>
                            </tr>
                    ';
            }
            ?>
        </table>
    </div>
    <div class="site-section">
        <h1 class="text-center text-primary">
            Pending Orders
        </h1>
        <table class="table table-striped table-hover container" style="margin-left: 15rem; width :75%">
            <tr>
                <th>Order_ID</th>
                <th>Customer</th>
                <th>Order_date</th>
                <th>Delivery_address</th>
                <th>Total_price</th>
                <th>Action</th>
            </tr>
            <?php
            $username = $_SESSION['login_manager'];
            $query = "select * from manager, orders where manager.username='$username' and orders.R_ID=manager.R_ID and orders.order_status='PLACED' order by orders.order_date";
            $result = $conn->query($query);
            while ($row = ($result->fetch_assoc())) {
                echo
                '
                            <tr>
                                <td>' . $row['order_ID'] . '</td>
                                <td>' . $row['username'] . '</td>
                                <td>' . $row['order_date'] . '</td>
                                <td>' . $row['delivery_address'] . '</td>
                                <td>' . $row['total_price'] . '</td>
                                <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order' . $row['order_ID'] . '">
                                    Expand
                                </button>
                                </td>
                            </tr>
                    ';
            }
            ?>
        </table>
    </div>
    <?php
    $username = $_SESSION['login_manager'];
    $query = "select * from manager, orders where manager.username='$username' and orders.R_ID=manager.R_ID and orders.order_status='PLACED'";
    $result = $conn->query($query);
    while ($row = ($result->fetch_assoc())) {
        echo '
                        <div class="modal fade" id="order' . $row['order_ID'] . '" tabindex="-1" role="dialog" aria-labelledby="orderLabel' . $row['order_ID'] . '">
                                    <div class="modal-dialog mw-100 w-75" role="document"  >
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-primary" id="orderLabel' . $row['order_ID'] . '">DETAILS OF ORDER ' . $row['order_ID'] . '</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover container">
                                                <tr>
                                                <th>Item_name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                </tr>
                            ';
        $query = "select * from order_item, menu_item where order_item.order_ID='" . $row['order_ID'] . "' and menu_item.item_ID = order_item.item_ID";
        $result_item = $conn->query($query);
        while ($row_item = ($result_item->fetch_assoc())) {
            echo
            '
                                                <tr>
                                                <td>' . $row_item['name'] . '</td>
                                                <td>' . $row_item['quantity'] . '</td>
                                                <td>' . $row_item['price'] . '</td>
                                                <td>' . $row_item['description'] . '</td>
                                                </tr>
                                    ';
        }

        echo
        '
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="mark_delivered.php?id=' . $row['order_ID'] . '" type="button" class="btn btn-primary text-white">Mark Delivered</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                    ';
    }
    ?>
    <div class="site-section">
        <h1 class="text-center text-primary">
            Delivered Orders
        </h1>
        <table class="table table-striped table-hover container" style="margin-left: 15rem; width :75%">
            <tr>
                <th>Order_ID</th>
                <th>Customer</th>
                <th>Order_date</th>
                <th>Delivery_address</th>
                <th>Total_price</th>
            </tr>
            <?php
            $username = $_SESSION['login_manager'];
            $query = "select * from manager, orders where manager.username='$username' and orders.R_ID=manager.R_ID and orders.order_status='DELIVERED' order by orders.order_date desc";
            $result = $conn->query($query);
            while ($row = ($result->fetch_assoc())) {
                echo
                '
                                <tr>
                                    <td>' . $row['order_ID'] . '</td>
                                    <td>' . $row['username'] . '</td>
                                    <td>' . $row['order_date'] . '</td>
                                    <td>' . $row['delivery_address'] . '</td>
                                    <td>' . $row['total_price'] . '</td>
                                </tr>
                        ';
            }
            ?>
        </table>
    </div>
    <div class="site-section" id="section-add">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 order-md-1" data-aos="fade-up">
                    <div class="text-left pb-1 border-primary mb-4">
                        <h2 class="text-primary">ADD MENU ITEM</h2>
                    </div>
                    <div id="customersignup">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="add_item_action.php" method="POST" enctype="multipart/form-data" class="p-5 bg-white">

                                    <div class="row form-group">
                                        <div class="col-md-12 mb-6 mb-md-0">
                                            <label class="text-black" for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12 mb-6 mb-md-0">
                                            <label class="text-black" for="price">Price</label>
                                            <input type="number" step="0.5" name="price" id="price" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12 mb-6 mb-md-0">
                                            <label class="text-black" for="description">Description</label>
                                            <input type="text" name="description" id="description" class="form-control" required>
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
    </div>
</body>

</html>