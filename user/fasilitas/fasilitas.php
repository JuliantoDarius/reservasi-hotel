<?php

require_once("../../function.php");
$_SESSION["aktif"] = basename(__DIR__);
require_once("../layouts/header.php");

$query = query("SELECT keterangan, gambar FROM fasilitas WHERE id_kamar IS NULL");

?>

<h1 class="mt-3">Fasilitas Hotel</h1>

<div class="row mt-3">
   <?php while ($data = mysqli_fetch_assoc($query)) : ?>
      <div class="col-4 my-3">
         <div class="card" style="width: 20rem;">
            <img src="../../img/<?= $data["gambar"] ?>" class="card-img-top" style="height: 200px;">
            <div class="card-body card-height">
               <p class="card-text">
                  <?php
                  $keterangan = $data["keterangan"];
                  if (strpos($keterangan, "m2")) {
                     $keterangan = str_replace("m2", "m<sup>2</sup>", $keterangan);
                  }

                  if (strlen($keterangan) <= 80) {
                     echo $keterangan;
                  } else {
                     echo
                     substr($keterangan, 0, 180) .
                        "<span class=\"text-primary\" id=\"detail\" onclick=\"handleDetail(this);\" title=\"Lihat Selengkapnya\"> ...</span>
                        <input type=\"hidden\" value=\"$keterangan\">";
                  }
                  ?>
               </p>
            </div>
         </div>
      </div>
   <?php endwhile; ?>
</div>

<?php require_once("../layouts/footer.php"); ?>