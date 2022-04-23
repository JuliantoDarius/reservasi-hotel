<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Edit Fasilitas Kamar";

require_once("../layouts/header.php");

if (!isset($_GET["id"])) {
   header("Location: ./fasilitasKamar.php");
   exit;
}

$idFasilitas = $_GET["id"];

$query = query("SELECT * FROM fasilitas INNER JOIN kamar ON fasilitas.id_kamar = kamar.id_kamar WHERE id_fasilitas = '$idFasilitas'");

$data = mysqli_fetch_assoc($query);
$gambar = $data["gambar"];
$queryKamar = query("SELECT id_kamar, tipe_kamar FROM kamar");

if (isset($_POST["update"])) {
   updateFasilitas($_POST, $idFasilitas, "./fasilitasKamar.php");
}

?>

<div id="alert" class="mb-3">
   <?php
   if (isset($_SESSION[FLASH]["false-extention"])) {
      cekFlashMessage("false-extention");
      unset($_SESSION[FLASH]);
   }
   cekFlashMessage("fasilitas-sudah-ada");
   cekFlashMessage("fasilitas-not-updated");
   ?>
</div>

<form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="namaFasilitasLama" value="<?= $data["nama_fasilitas"]; ?>">
   <input type="hidden" name="gambarLama" value="<?= $data["gambar"]; ?>">
   <div class="mb-3 row">
      <label for="namaFasilitas" class="col-2 col-form-label">Nama Fasilitas</label>
      <div class="col-5">
         <input type="text" class="form-control" id="namaFasilitas" name="namaFasilitas" required autocomplete="off" value="<?= ucwords($data["nama_fasilitas"]); ?>">
         <div class="form-text">Untuk Ukuran Kamar Gunakan m2 Contoh : (31m2)</div>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="keterangan" class="col-2 col-form-label">Keterangan</label>
      <div class="col-5">
         <textarea name="keterangan" id="keterangan" class="form-control" required><?= $data["keterangan"]; ?></textarea>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="tipeKamar" class="col-2 col-form-label">Tipe Kamar</label>
      <div class="col-5">
         <select class="form-select" required name="idKamar">
            <option selected value="<?= $data["id_kamar"] ?>"><?= ucwords($data["tipe_kamar"]); ?></option>
            <?php while ($data = mysqli_fetch_assoc($queryKamar)) : ?>
               <option value="<?= $data["id_kamar"] ?>"><?= ucwords($data["tipe_kamar"]) ?></option>
            <?php endwhile; ?>
         </select>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="gambar" class="col-2 col-form-label">Gambar</label>
      <div class="col-5">
         <img src="../../img/<?= $gambar ?>" class="mb-3" width="200">
         <input type="file" name="gambar" id="gambar" class="form-control">
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-5">
         <input type="submit" class="btn btn-lg btn-info" value="Update" name="update">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>