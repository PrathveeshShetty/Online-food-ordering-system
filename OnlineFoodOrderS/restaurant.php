<?php
session_start();
require 'connection.php';
$conn = Connect();

if (!isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_manager'])) { //if manager logged in
    header('location: manager.php');
}

if (isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: admin.php');
}


if (isset($_POST["choose"])) {
    $R_ID = $_POST["R_ID"];

    $sql = "select * from restaurant where R_ID = $R_ID";
    $result = mysqli_query($conn, $sql);

    $rest = mysqli_fetch_assoc($result);
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "add") {
        $RID = $_GET["rid"];
        echo '<script>console.log($RID)</script>';
        if (isset($_SESSION["cart"])) {
            $item_array_id = array_column($_SESSION["cart"], "item_ID");
            if (!in_array($_GET["id"], $item_array_id)) {
                $count = count($_SESSION["cart"]);

                $item_array = array(
                    'item_ID' => $_GET["id"],
                    'name' => $_POST["name"],
                    'price' => $_POST["price"],
                    'R_ID' => $_POST["R_ID"],
                    'quantity' => $_POST["quantity"]
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="restaurant.php?rid=' . $_GET["rid"] . '"</script>';
            } else {
                echo '<script>alert("Item already present in cart.\n To change quantity remove from cart.")</script>';
                echo '<script>window.location="restaurant.php?rid=' . $_GET["rid"] . '"</script>';
            }
        } else {
            $item_array = array(
                'item_ID' => $_GET["id"],
                'name' => $_POST["name"],
                'price' => $_POST["price"],
                'R_ID' => $_POST["R_ID"],
                'quantity' => $_POST["quantity"]
            );
            $_SESSION["cart"][0] = $item_array;
            echo '<script>window.location="restaurant.php?rid=' . $_GET["rid"] . '"</script>';
        }
    }
}

if (isset($_GET["rid"])) {
    $R_ID = $_GET["rid"];
    $sql = "select * from restaurant where R_ID = $R_ID";
    $result = mysqli_query($conn, $sql);

    $rest = mysqli_fetch_assoc($result);
}

if (!(isset($_GET["rid"]) || isset($_POST["R_ID"]))) {
    unset($_SESSION["cart"]);
    header("location: restaurant_choose.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <?php
            if (!$rest["name"]) {
                unset($_SESSION["cart"]);
                header("location: restaurant_choose.php");
            }
            ?>
            <h1><?php echo $rest["name"]; ?></h1>
            <p><a href="logout.php">LogOut</a></p>
            <?php
            echo '<a href="cart.php?rid=' . $R_ID . '" class="btn btn-primary btn-sm">Proceed to Checkout</a>'
            ?>
        </div>
    </div>
    <div class="site-section" style="background-image: url(images/food_bg.jpg); background-size: cover" id="section-home">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="400">
                <?php
                $sql = "select * from menu_item where R_ID=" . $R_ID . " order by item_ID";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="image-flip1">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <form method="post" action="restaurant.php?action=add&id=<?php echo $row["item_ID"]; ?>&rid=<?php echo $row["R_ID"]; ?>">
                                                    <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                                                    <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                                                    <input type="hidden" name="R_ID" value="<?php echo $row["R_ID"]; ?>">
                                                    <h4 class="card-title" style="margin-bottom:0px"><?php echo $row["name"]; ?></h4>
                                                    <p class="card-text" style="color: rgb(77,77,77); margin-bottom:0px">Price: &#8377;<?php echo $row["price"]; ?></p>
                                                    <p class="card-text" style="color: rgb(77,77,77)"><input type="number" min="1" max="25" name="quantity" value="1" style="width: 60px"></p>
                                                    <button type="submit" name="add" class="btn btn-primary btn-sm">Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>