<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Tambah Fasilitas Hotel";

require_once("../layouts/header.php");

if (isset($_POST["tambah"])) {
   insertFasilitas($_POST, "./fasilitasHotel.php");
}

?>

<div id="alert" class="mb-3">
   <?php
   if (isset($_SESSION[FLASH]["false-extention"])) {
      cekFlashMessage("false-extention");
      unset($_SESSION[FLASH]);
   }

   cekFlashMessage("fasilitasHotel-sudah-ada");
   cekFlashMessage("fasilitas-not-inserted");
   ?>
</div>

<form action="" method="post" enctype="multipart/form-data">
   <div class="mb-3 row">
      <label for="namaFasilitas" class="col-2 col-form-label">Nama Fasilitas</label>
      <div class="col-4">
         <input type="text" class="form-control" id="namaFasilitas" name="namaFasilitas" required autocomplete="off">
         <div class="form-text">Untuk Ukuran Gunakan m2 Contoh : (24m2)</div>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="keterangan" class="col-2 col-form-label">Keterangan</label>
      <div class="col-4">
         <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="gambar" class="col-2 col-form-label">Gambar</label>
      <div class="col-4">
         <input type="file" name="gambar" id="gambar" required class="form-control">
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-4">
         <input type="submit" class="btn btn-lg btn-success" value="Tambah" name="tambah">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>