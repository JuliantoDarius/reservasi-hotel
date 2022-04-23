<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Tambah Kamar";

require_once("../layouts/header.php");

if (isset($_POST["tambah"])) {
   insertKamar($_POST);
}
?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("tipeKamar-taken");
   cekFlashMessage("kamar-not-inserted");
   ?>
</div>

<form action="" method="post">
   <div class="mb-3 row">
      <label for="tipeKamar" class="col-2 col-form-label">Tipe Kamar</label>
      <div class="col-3">
         <input type="text" class="form-control" id="tipeKamar" name="tipeKamar" required autocomplete="off">
      </div>
   </div>

   <div class="row">
      <label for="jumlahKamar" class="col-2 col-form-label">Jumlah Kamar</label>
      <div class="col-3">
         <input type="number" class="form-control" id="jumlahKamar" min="0" name="jumlahKamar" required autocomplete="off">
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-3">
         <input type="submit" class="btn btn-lg btn-success" value="Tambah" name="tambah">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>