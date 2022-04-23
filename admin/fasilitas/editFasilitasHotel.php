<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Edit Fasilitas Hotel";

require_once("../layouts/header.php");

if (!isset($_GET["id"])) {
   header("Location: ./fasilitasHotel.php");
   exit;
}

$idFasilitas = $_GET["id"];

$query = query("SELECT * FROM fasilitas WHERE id_fasilitas = '$idFasilitas'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST["update"])) {
   updateFasilitas($_POST, $idFasilitas, "./fasilitasHotel.php");
}

?>

<div id="alert" class="mb-3">
   <?php
   if (isset($_SESSION[FLASH]["false-extention"])) {
      cekFlashMessage("false-extention");
      unset($_SESSION[FLASH]);
   }
   cekFlashMessage("fasilitasHotel-sudah-ada");
   cekFlashMessage("fasilitas-not-updated");
   ?>
</div>

<form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="namaFasilitasLama" value="<?= $data["nama_fasilitas"]; ?>">
   <input type="hidden" name="gambarLama" value="<?= $data["gambar"]; ?>">
   <div class="mb-3 row">
      <label for="namaFasilitas" class="col-2 col-form-label">Nama Fasilitas</label>
      <div class="col-4">
         <input type="text" class="form-control" id="namaFasilitas" name="namaFasilitas" required autocomplete="off" value="<?= ucwords($data["nama_fasilitas"]); ?>">
         <div class="form-text">Untuk Ukuran Gunakan m2 Contoh : (24m2)</div>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="keterangan" class="col-2 col-form-label">Keterangan</label>
      <div class="col-4">
         <textarea name="keterangan" id="keterangan" class="form-control"><?= $data["keterangan"]; ?></textarea>
         <div class="form-text">Untuk Ukuran Gunakan m2 Contoh : (12m2)</div>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="gambar" class="col-2 col-form-label">Gambar</label>
      <div class="col-4">
         <img src="../../img/<?= $data["gambar"] ?>" class="mb-3" width="200">
         <input type="file" name="gambar" id="gambar" class="form-control">
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-4">
         <input type="submit" class="btn btn-lg btn-info" value="Update" name="update">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>