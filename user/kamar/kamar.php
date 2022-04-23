<?php

require_once("../../function.php");
$_SESSION["aktif"] = basename(__DIR__);
require_once("../layouts/header.php");

$queryKamar = query("SELECT id_kamar, tipe_kamar FROM kamar ORDER BY id_kamar ASC");

?>

<?php while ($tipeKamar = mysqli_fetch_assoc($queryKamar)) :  ?>
   <?php
   $idKamar = $tipeKamar["id_kamar"];

   $queryGambarKamar = mysqli_query($koneksi, "SELECT gambar FROM fasilitas WHERE nama_fasilitas LIKE 'kamar%' AND id_kamar = '$idKamar'") or die(mysqli_error($koneksi));

   $gambarKamar = mysqli_fetch_assoc($queryGambarKamar);
   ?>

   <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img src="../../img/<?= $gambarKamar["gambar"] ?>" class="d-block w-100">
         </div>
      </div>
   </div>

   <div class="content">
      <h1 class="nama-kamar">Tipe <?= ucwords($tipeKamar["tipe_kamar"]) ?></h1>
      <ul class="list-fasilitas-kamar">
         <li class="fs-4">Fasilitas :</li>

         <?php

         $queryFasilitasKamar = query("SELECT nama_fasilitas FROM fasilitas WHERE id_kamar = '$idKamar'");
         while ($dataFasilitas = mysqli_fetch_assoc($queryFasilitasKamar)) :
            $fasilitas = $dataFasilitas["nama_fasilitas"];

            if (strpos($dataFasilitas["nama_fasilitas"], "m2")) {
               $fasilitas = str_replace("m2", "m<sup>2</sup>", $dataFasilitas["nama_fasilitas"]);
            }
         ?>
            <li class="fs-5"><?= ucwords($fasilitas); ?></li>
         <?php endwhile; ?>

      </ul>
   </div>
<?php endwhile; ?>

<?php require_once("../layouts/footer.php"); ?>