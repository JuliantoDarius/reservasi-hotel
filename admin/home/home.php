<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = basename(__FILE__, ".php");

require_once("../layouts/header.php");

$queryUser = query("SELECT * FROM akun WHERE hak_akses = 'user'");
$jumlahUser = mysqli_num_rows($queryUser);

$queryKamar = query("SELECT SUM(jumlah_kamar) AS \"jumlah_kamar\" FROM kamar");
$jumlahKamar = mysqli_fetch_assoc($queryKamar)["jumlah_kamar"];

$queryFasilitas = query("SELECT COUNT(id_fasilitas) AS \"jumlah_fasilitas\" FROM fasilitas");
$jumlahFasilitas = mysqli_fetch_assoc($queryFasilitas)["jumlah_fasilitas"];

?>

<div class="row mb-5">

   <div class="col-4">
      <div class="card" style="width: 18rem;">
         <div class="card-body">
            <h5 class="card-title">Total User</h5>
            <p class="card-text"><?= formatAngka($jumlahUser); ?> Orang Telah Menjadi User Website Joy Hotel</p>
         </div>
      </div>
   </div>

   <div class="col-4">
      <div class="card" style="width: 18rem;">
         <div class="card-body">
            <h5 class="card-title">Total Kamar</h5>
            <p class="card-text">Terdapat <?= formatAngka($jumlahKamar); ?> Buah Kamar Yang Ada Di Joy Hotel</p>
         </div>
      </div>
   </div>

   <div class="col-4">
      <div class="card" style="width: 18rem;">
         <div class="card-body">
            <h5 class="card-title">Total Fasilitas</h5>
            <p class="card-text">Terdapat <?= formatAngka($jumlahFasilitas); ?> Fasilitas Yang Dapat Dinikmati Pengunjung Di Joy Hotel</p>
         </div>
      </div>
   </div>
</div>


<table class="table">
   <thead>
      <tr>
         <th scope="col">No</th>
         <th scope="col">Fasilitas</th>
         <th scope="col">Gambar</th>
         <th scope="col">ID Kamar</th>
      </tr>
   </thead>
   <tbody>

      <?php
      $no = 1;
      $query = query("SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");
      while ($data = mysqli_fetch_assoc($query)) :

      ?>
         <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= ucwords($data["nama_fasilitas"]); ?></td>
            <td><?= $data["gambar"]; ?></td>
            <td><?= $data["id_kamar"]; ?></td>
         </tr>
      <?php endwhile; ?>
   </tbody>
</table>


<?php require_once("../layouts/footer.php"); ?>