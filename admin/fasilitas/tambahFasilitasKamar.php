<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Tambah Fasilitas Kamar";

require_once("../layouts/header.php");

$queryKamar = query("SELECT id_kamar, tipe_kamar FROM kamar");

if (isset($_POST["tambah"])) {
   insertFasilitas($_POST, "./fasilitasKamar.php");
}

?>

<div id="alert" class="mb-3">
   <?php
   if (isset($_SESSION[FLASH]["false-extention"])) {
      cekFlashMessage("false-extention");
      unset($_SESSION[FLASH]);
   }
   cekFlashMessage("fasilitas-sudah-ada");
   cekFlashMessage("fasilitas-not-inserted");
   ?>
</div>

<form action="" method="post" enctype="multipart/form-data">
   <div class="mb-3 row">
      <label for="namaFasilitas" class="col-2 col-form-label">Nama Fasilitas</label>
      <div class="col-5">
         <input type="text" class="form-control" id="namaFasilitas" name="namaFasilitas" required autocomplete="off">
         <div class="form-text">Untuk Ukuran Kamar Gunakan m2 Contoh : (24m2)</div>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="keterangan" class="col-2 col-form-label">Keterangan</label>
      <div class="col-5">
         <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="tipeKamar" class="col-2 col-form-label">Tipe Kamar</label>
      <div class="col-5">
         <select class="form-select" required name="idKamar">
            <option selected value="">Pilih Tipe Kamar Yang Mendapatkan Fasilitas Ini</option>
            <?php while ($data = mysqli_fetch_assoc($queryKamar)) : ?>
               <option value="<?= $data["id_kamar"] ?>"><?= ucwords($data["tipe_kamar"]) ?></option>
            <?php endwhile; ?>
         </select>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="gambar" class="col-2 col-form-label">Gambar</label>
      <div class="col-5">
         <input type="file" name="gambar" id="gambar" required class="form-control">
      </div>
   </div>

   <div class="mt-4 row">
      <div class="col-5">
         <input type="submit" class="btn btn-lg btn-success" value="Tambah" name="tambah">
      </div>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>