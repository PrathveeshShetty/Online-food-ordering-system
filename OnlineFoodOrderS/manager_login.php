<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 order-md-1" data-aos="fade-up">
                <div class="text-left pb-1 border-primary mb-4">
                    <h2 class="text-primary">Login Manager</h2>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-7 mb-5">



                            <form action="manager_login_action.php" class="p-5 bg-white" method="POST">

                                <div class="row form-group">
                                    <div class="col-md-12 mb-6 mb-md-0">
                                        <label class="text-black" for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12 mb-6 mb-md-0">
                                        <label class="text-black" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group" style="padding-top: 1rem;">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit" value="LOGIN" class="btn btn-primary py-2 px-4 text-white">
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