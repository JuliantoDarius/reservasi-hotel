<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = "Fasilitas Hotel";

require_once("../layouts/header.php");

$query = query("SELECT * FROM fasilitas WHERE id_kamar IS NULL ORDER BY id_fasilitas DESC");

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("fasilitas-inserted");
   cekFlashMessage("fasilitas-updated");
   cekFlashMessage("hapus-fasilitas");
   ?>

</div>

<table class="table table-striped mb-3">
   <thead>
      <tr>
         <th scope="col">Nama Fasilitas</th>
         <th scope="col">Keterangan</th>
         <th scope="col">Image</th>
         <th scope="col">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="4" class="table-warning">Tidak Ada Fasilitas Hotel Yang Tersedia</td>
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
                     <a href="./editFasilitasHotel.php?id=<?= $data["id_fasilitas"]; ?>" title="Lihat Selengkapnya">...</a>
                  <?php endif; ?>
               </td>
               <td><img src="../../img/<?= $data["gambar"]; ?>" width="80"></td>
               <td>
                  <a href="./editFasilitasHotel.php?id=<?= $data["id_fasilitas"]; ?>" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a href="./hapusFasilitasHotel.php?id=<?= $data["id_fasilitas"]; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Fasilitas Hotel ?')"><i class="fa-regular fa-trash-can"></i>Hapus</a>
               </td>
            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<div class="text-end">
   <a href="./tambahFasilitasHotel.php"><img src="../../img/add.png" width="50" title="Tambah Fasilitas Hotel"></a>
</div>


<?php require_once("../layouts/footer.php"); ?>