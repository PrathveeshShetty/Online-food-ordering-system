<?php
session_start(); // Starting Session
if (isset($_SESSION['login_customer'])) {
    header('location: index.php');
}
if (isset($_SESSION['login_manager'])) {
    header('location: manager.php');
}
if (!isset($_SESSION['login_admin'])) {
    header('location: index.php');
}
if (!isset($_GET['id'])) {
    header('location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 order-md-1" data-aos="fade-up">
                <div class="text-left pb-1 border-primary mb-4">
                    <h2 class="text-primary">Add manager for restaurant <?php echo $_GET['id'] ?> </h2>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-7 mb-5">


                            <?php
                            echo '<form action="add_manager_action.php?id=' . $_GET['id'] . '" class="p-5 bg-white" method="POST">';
                            ?>
                            <div class="row form-group">
                                <div class="col-md-12 mb-6 mb-md-0">
                                    <label class="text-black" for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12 mb-6 mb-md-0">
                                    <label class="text-black" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12 mb-6 mb-md-0">
                                    <label class="text-black" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-12">
                                    <label class="text-black" for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-12">
                                    <label class="text-black" for="contact_no">Contact No</label>
                                    <input type="text" name="contact_no" id="contact_no" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-12">
                                    <label class="text-black" for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" name="submit" value="ADD MANAGER" class="btn btn-primary py-2 px-4 text-white">
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