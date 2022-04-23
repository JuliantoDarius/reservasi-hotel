<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Tambah Akun";

require_once("../layouts/header.php");

if (isset($_POST["tambah"])) {
   insertAkun($_POST, "./akun.php");
}

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("username-taken");
   cekFlashMessage("not-confirmed");
   cekFlashMessage("akun-not-inserted");
   ?>
</div>

<form action="" method="post">
   <div class="mb-3 row">
      <label for="username" class="col-2 col-form-label">Username</label>
      <div class="col-4">
         <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="password" class="col-2 col-form-label">Password</label>
      <div class="col-4">
         <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="konfiramsi" class="col-2 col-form-label">Konfirmasi Password</label>
      <div class="col-4">
         <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" required autocomplete="off">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="hakAkses" class="col-2 col-form-label">Hak Akses</label>
      <div class="col-4">
         <select class="form-select" required name="hakAkses">
            <option selected value="">Pilih Hak Akses Akun Ini</option>
            <option value="user">User</option>
            <option value="resepsionis">Resepsionis</option>
            <option value="admin">Admin</option>
         </select>
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-4">
         <input type="submit" class="btn btn-lg btn-success" value="Tambah" name="tambah">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>