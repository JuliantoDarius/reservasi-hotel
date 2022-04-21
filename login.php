<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: ./index.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <script src="https://kit.fontawesome.com/76469cb42c.js" crossorigin="anonymous"></script>

    <title>Joy Hotel</title>
</head>

<body>
    <div class="background">
        <img src="./img/login.jpg" alt="">
    </div>

    <div class="flex-container">
        <div class="form-container">
            <div class="header">
                <h1>JOY HOTEL</h1>
            </div>
            <div class="login-box">
                <form action="./prosesLogin.php" method="post">

                    <div class="mb-4 mt-4 row">
                        <label for="username" class="col-sm-2 col-form-label"><i class="fa-solid fa-user"></i></label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" autofocus required autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="password" class="col-sm-2 col-form-label"><i class="fa-solid fa-lock"></i></label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <input type="submit" value="LOGIN" name="login" class="btn btn-login">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <p class="sign-up">
                                Tidak Punya Akun ? <a href="./register.php">Daftar</a> Sekarang
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>