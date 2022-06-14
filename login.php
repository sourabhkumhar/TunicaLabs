<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login/Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,700,1,0" />

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="border border-3 rounded-3 login-box">
                <form action="" method="post" align="center">

                    <h4>Login to your account</h4>

                    <input type="text" class="form-control inputs" name="userid" id="userid" placeholder="Email or Mobile Number">
                    <input type="password" class="form-control inputs" name="password" id="password" placeholder="Password">

                    <button class="btn btn-success rounded-1 input-btn">Submit</button>

                    <br><br>
                    <sup><a class="text-black" href="signup.php">Create New Account</a></sup>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>