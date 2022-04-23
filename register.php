<?php

require_once("./function.php");

if (isset($_POST["register"])) {
   insertAkun($_POST, "./index.php");
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
   <link rel="stylesheet" href="./style/register.css">
   <link rel="stylesheet" href="./style/user.css">
   <title>Joy Hotel</title>
</head>

<body>
   <div id="alert">
      <?php
      if (isset($_SESSION[FLASH]["not-confirmed"])) {
         flash("not-confirmed");
      }
      if (isset($_SESSION[FLASH]["not-inserted"])) {
         flash("akun-not-inserted");
      }
      flash("username-taken");
      ?>
   </div>

   <div class="background">
      <img src="./img/register.jpg" alt="">
   </div>

   <div class="flex-container">
      <div class="register-box">
         <h1 class="header">SIGN-UP</h1>
         <form action="" method="post">
            <div class="mb-3">
               <label for='username'>Username</label>
               <input type='text' name='username' id='username' autocomplete="off" required placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
               <label for='password'>Password</label>
               <input type='password' name='password' id='password' required placeholder="Masukkan Password">
            </div>

            <div class="mb-2">
               <label for='konfirmasi'>Konfirmasi Password</label>
               <input type='password' name='konfirmasi' id='konfirmasi' required placeholder="Re-Enter Password">
            </div>

            <div class="mb-3">
               <div class="d-grid col-9 mx-auto">
                  <input type='submit' name='register' value='register' class='btn btn-success'>
                  <p class="mt-3" class="login-link">
                     Sudah Punya Akun ? <a href="./login.php">Sign-In</a>
                  </p>
               </div>
            </div>

         </form>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   <script src="./style/script.js"></script>

</body>

</html>