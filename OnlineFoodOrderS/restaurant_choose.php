<?php
session_start();

require 'connection.php';
$conn = Connect();

if (!isset($_SESSION['login_customer'])) { //if customer logged in
    header('location: index.php');
}

if (isset($_SESSION['login_manager'])) { //if manager logged in
    header('location: index.php');
}

if (isset($_SESSION['login_admin'])) { //if manager logged in
    header('location: index.php');
}

unset($_SESSION["cart"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Ordering System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <div class="jumbotron" style="color: #FFFFFF; margin-bottom: 0rem; background: #333333; border-radius:0rem">
        <div class="container text-center">
            <h1>Select a Restaurant</h1>
            <p><a href="logout.php">LogOut</a></p>
            <p><a href="customer.php" class="nav-link">Welcome, <?php echo $_SESSION["login_customer"] ?></a></p>
        </div>
    </div>
    <div class="site-section" id="section-home">
        <div class="container" style="padding-top: 1rem">
            <div class="row align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="400">
                <?php
                $sql = "select * from restaurant order by R_ID";
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
                                                <form method="post" action="restaurant.php">
                                                    <input type="hidden" name="R_ID" value="<?php echo $row["R_ID"]; ?>">
                                                    <h4 class="card-title" style="margin-bottom:0px"><?php echo $row["name"]; ?></h4>
                                                    <p class="card-text" style="color: rgb(77,77,77); margin-bottom:0px">Location: <?php echo $row["location"]; ?></p>
                                                    <p class="card-text" style="color: rgb(77,77,77)">Rating: <?php echo $row["rating"]; ?>/5.0</p>
                                                    <button type="submit" name="choose" class="btn btn-primary btn-sm">Choose<i class="fa fa-plus"></i></button>
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