<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Edit Akun";

require_once("../layouts/header.php");

if (!isset($_GET["id"])) {
   header("Location: ./akun.php");
   exit;
}

$idAkun = $_GET["id"];
$query = query("SELECT * FROM akun WHERE id_akun = '$idAkun'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST["update"])) {
   updateAkun($_POST, $idAkun);
}

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("username-taken");
   cekFlashMessage("not-confirmed");
   cekFlashMessage("akun-not-updated");
   ?>
</div>

<form action="" method="post">
   <div class="mb-3 row">
      <input type="hidden" name="usernameLama" value="<?= $data["username"]; ?>">
      <input type="hidden" name="passwordLama" value="<?= $data["password"]; ?>">
      <label for="username" class="col-2 col-form-label">Username</label>
      <div class="col-5">
         <input type="text" class="form-control" id="username" name="username" required autocomplete="off" value="<?= $data["username"]; ?>">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="password" class="col-2 col-form-label">Ubah Password</label>
      <div class="col-5">
         <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Jika Tidak Ingin Mengganti Password, Kosongkan !">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="konfiramsi" class="col-2 col-form-label">Konfirmasi Password</label>
      <div class="col-5">
         <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" autocomplete="off">
      </div>
   </div>

   <div class="mb-3 row">
      <label for="hakAkses" class="col-2 col-form-label">Hak Akses</label>
      <div class="col-5">
         <select class="form-select" required name="hakAkses">
            <option selected value="<?= $data["hak_akses"] ?>"><?= ucwords($data["hak_akses"]); ?></option>
            <option value="user">User</option>
            <option value="resepsionis">Resepsionis</option>
            <option value="admin">Admin</option>
         </select>
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-4">
         <input type="submit" class="btn btn-lg btn-info" value="Update" name="update">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>