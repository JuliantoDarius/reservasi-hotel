<?php

require_once("../../function.php");
require_once("../layouts/header.php");

if (!isset($_GET["id"])) {
   header("Location: ../home/home.php");
   exit;
}

$idReservasi = $_GET["id"];

$query = query("SELECT * FROM reservasi WHERE id_reservasi = '$idReservasi'");
$data = mysqli_fetch_assoc($query);
?>

<div class="mt-3 mb-4">
   <h1>Detail Reservasi</h1>

   <div class="mt-5 mb-3 row">
      <label for="namaPemesan" class="col-2 col-form-label">Nama Pemesan</label>
      <div class="col-3">
         <input type="text" class="form-control disabled" id="namaPemesan" name="namaPemesan" disabled value="<?= ucwords($data["nama_pemesan"]); ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="namaTamu" class="col-2 col-form-label">Nama Tamu</label>
      <div class="col-3">
         <input type="text" class="form-control disabled" id="namaTamu" name="namaTamu" disabled value="<?= ucwords($data["nama_tamu"]); ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="email" class="col-2 col-form-label">Email</label>
      <div class="col-3">
         <input type="email" class="form-control disabled" id="email" name="email" disabled value="<?= $data["email"]; ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="noHp" class="col-2 col-form-label">No HP</label>
      <div class="col-3">
         <input type="tel" class="form-control disabled" id="noHp" name="noHp" disabled value="<?= $data["no_hp"]; ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="jumlahKamar" class="col-2 col-form-label">Jumlah Kamar</label>
      <div class="col-3">
         <input type="number" class="form-control disabled" id="jumlahKamar" name="jumlahKamar" disabled value="<?= formatAngka($data["jumlah_kamar"]); ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="checkin" class="col-2 col-form-label">Tgl Check-in</label>
      <div class="col-3">
         <input type="text" class="form-control disabled" id="checkin" name="checkin" disabled value="<?= date("d-m-Y", strtotime($data["tgl_check_in"])); ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-5 mb-3 row">
      <label for="checkout" class="col-2 col-form-label">Tgl Check-out</label>
      <div class="col-3">
         <input type="text" class="form-control disabled" id="checkout" name="checkout" disabled value="<?= date("d-m-Y", strtotime($data["tgl_check_out"])); ?>" required autocomplete="off">
      </div>
   </div>

   <div class="mt-4">
      <a href="../home/home.php" class="btn btn-danger">Kembali</a>
   </div>
</div>

<?php require_once("../layouts/footer.php"); ?>