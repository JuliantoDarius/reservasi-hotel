<?php

require_once("../../function.php");
require_once("../layouts/header.php");

if (isset($_POST["register"])) {
   insertAkun($_POST, "../home/home.php");
}

?>

<div id="alert">
   <?php
   if (isset($_SESSION[FLASH]["not-confirmed"])) {
      flash("not-confirmed");
   }
   if (isset($_SESSION[FLASH]["not-inserted"])) {
      flash("not-inserted");
   }
   ?>
</div>

<div class="background">
   <img src="../../img/register.jpg" alt="">
</div>

<div class="flex-container">
   <div class="register-box">
      <h1 class="header">Sign-Up</h1>
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
                  Sudah Punya Akun ? <a href="../../login.php">Sign-In</a>
               </p>
            </div>
         </div>

      </form>
   </div>
</div>


<?php require_once("../layouts/footer.php"); ?>