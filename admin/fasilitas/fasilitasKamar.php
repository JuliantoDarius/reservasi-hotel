<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Fasilitas Kamar";

require_once("../layouts/header.php");

$query = query("SELECT * FROM fasilitas INNER JOIN kamar ON fasilitas.id_kamar = kamar.id_kamar WHERE fasilitas.id_kamar IS NOT NULL ORDER BY id_fasilitas DESC");

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("fasilitas-inserted");
   cekFlashMessage("fasilitas-updated");
   cekFlashMessage("hapus-fasilitas");
   ?>

</div>

<table class="table mb-3">
   <thead>
      <tr>
         <th scope="col">Nama Fasilitas</th>
         <th scope="col">Keterangan</th>
         <th scope="col">Tipe Kamar</th>
         <th scope="col">Image</th>
         <th scope="col">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="5" class="table-warning">Tidak Ada Fasilitas Kamar Yang Tersedia</td>
         </tr>
      <?php else : ?>
         <?php while ($data = mysqli_fetch_assoc($query)) : ?>
            <tr>
               <th scope="row"><?= ucwords($data["nama_fasilitas"]); ?></th>
               <td>
                  <?php if (strlen($data["keterangan"]) <= 50) : ?>
                     <?= $data["keterangan"] ?>
                  <?php else : ?>
                     <?= substr($data["keterangan"], 0, 50); ?>
                     <a href="./editFasilitasKamar.php?id=<?= $data["id_fasilitas"]; ?>" title="Lihat Selengkapnya">...</a>
                  <?php endif; ?>
               </td>
               <th scope="row"><?= ucwords($data["tipe_kamar"]); ?></th>
               <td><img src="../../img/<?= $data["gambar"]; ?>" width="80"></td>
               <td>
                  <a href="./editFasilitasKamar.php?id=<?= $data["id_fasilitas"]; ?>" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a href="./hapusFasilitasKamar.php?id=<?= $data["id_fasilitas"]; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Fasilitas Kamar ?')"><i class="fa-regular fa-trash-can"></i>Hapus</a>
               </td>
            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<div class="text-end">
   <a href="./tambahFasilitasKamar.php"><img src="../../img/add.png" width="50" title="Tambah Fasilitas Kamar"></a>
</div>


<?php require_once("../layouts/footer.php"); ?>