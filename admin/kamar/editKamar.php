<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Edit Kamar";

require_once("../layouts/header.php");

if (!isset($_GET["id"])) {
   header("Location: ../kamar/kamar.php");
   exit;
}

$idKamar = $_GET["id"];

$query = query("SELECT * FROM kamar WHERE id_kamar = '$idKamar'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST["update"])) {
   updateKamar($_POST, $idKamar);
}

?>

<div id="alert" class="mb-3">
   <?php cekFlashMessage("tipeKamar-taken"); ?>
   <?php cekFlashMessage("kamar-not-updated"); ?>
</div>

<form action="" method="post">
   <input type="hidden" name="tipeKamarLama" value="<?= $data["tipe_kamar"]; ?>">
   <div class="mb-3 row">
      <label for="tipeKamar" class="col-2 col-form-label">Tipe Kamar</label>
      <div class="col-3">
         <input type="text" class="form-control" id="tipeKamar" name="tipeKamar" required autocomplete="off" value="<?= ucwords($data["tipe_kamar"]); ?>">
      </div>
   </div>

   <div class="row">
      <label for="jumlahKamar" class="col-2 col-form-label">Jumlah Kamar</label>
      <div class="col-3">
         <input type="number" class="form-control" id="jumlahKamar" name="jumlahKamar" required autocomplete="off" min="0" value="<?= $data["jumlah_kamar"]; ?>">
      </div>
   </div>

   <div class="mt-4">
      <input type="submit" class="btn btn-lg btn-info" value="Update" name="update">
      <a href="./kamar.php" class="btn btn-lg btn-danger mx-3">Cancel</a>
   </div>
</form>

<?php require_once("../layouts/footer.php"); ?>