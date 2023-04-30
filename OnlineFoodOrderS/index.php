<?php
session_start();
if (isset($_SESSION['login_customer'])) {
    header('location: restaurant_choose.php');
}

if (isset($_SESSION['login_manager'])) {
    header('location: manager.php');
}
if (isset($_SESSION['login_admin'])) {
    header('location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Online Food Ordering System</title>
</head>

<script type="text/javascript">
    window.onload = function() {
        myfunction()
    };

    function myfunction() {
        document.getElementById("customersignup").style.display = "block";
        document.getElementById("customerlogin").style.display = "none";
    }

    function myfunction1() {
        document.getElementById("customerlogin").style.display = "block";
        document.getElementById("customersignup").style.display = "none";
    }
</script>

<body>
    <div class="container-fluid" style="background-color: black;">
        <h1 style="text-align: center;color: white" style="color: white;">Online Food Ordering System</h1>
        <ul>
            <li style="text-align: center;"><a href="admin_login.php">Login Admin</a></li>
            <li style="text-align: center;"><a href="manager_login.php">Login Manager</a></li>
            <li style="text-align: center;"><a href=""></a></li>
        </ul>
    </div>
    <section>
        <div id="customersignup">
            <div class="row">
                <div class="col-md-11">

                    <form action="customer_signup.php" method="POST" class="p-5 bg-white">

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

                        <div class="row form-group" style="margin-bottom: 1rem;">

                            <div class="col-md-12">
                                <label class="text-black" for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="SIGNUP" class="btn btn-primary py-2 px-4 text-white">
                            </div>
                        </div>


                    </form>
                </div>
                <div class="col-md-5">

                    <div class="p-4 mb-3 bg-white">
                    </div>

                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Already a User?</h3>
                        <p><a href="#section-login" class="btn btn-primary px-4 py-2 text-white" onclick="myfunction1()">LOGIN</a></p>
                    </div>

                </div>
            </div>
        </div>
        <div id="customerlogin">
            <div class="row">
                <div class="col-md-7 mb-5">



                    <form role="form" action="customer_login.php" method="POST" class="p-5 bg-white">

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

                        <div class="row form-group" style="padding-top: 1rem;">
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="LOGIN" class="btn btn-primary py-2 px-4 text-white">
                            </div>
                        </div>


                    </form>
                </div>
                <div class="col-md-5">
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">New User?</h3>
                        <p><a href="#section-login" class="btn btn-primary px-4 py-2 text-white" onclick="myfunction()">SIGNUP</a></p>
                    </div>

                </div>

            </div>
        </div>

    </section>

</body>

</html>