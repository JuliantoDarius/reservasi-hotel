<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = basename(__FILE__, ".php");

require_once("../layouts/header.php");

$query = query("SELECT * FROM kamar ORDER BY id_kamar DESC");

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("kamar-inserted");
   cekFlashMessage("kamar-updated");
   cekFlashMessage("hapus-kamar");
   ?>

</div>

<table class="table table-striped mb-3">
   <thead>
      <tr>
         <th scope="col">Tipe Kamar</th>
         <th scope="col">Jumlah Kamar</th>
         <th scope="col">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="3" class="table-danger">
               Belum Ada Tipe Kamar Yang Tersedia
            </td>
         </tr>
      <?php else : ?>
         <?php while ($data = mysqli_fetch_assoc($query)) : ?>
            <tr>
               <th scope="row"><?= ucwords($data["tipe_kamar"]); ?></th>
               <td><?= formatAngka($data["jumlah_kamar"]); ?></td>
               <td>
                  <a href="./editKamar.php?id=<?= $data["id_kamar"]; ?>" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a href="./hapusKamar.php?id=<?= $data["id_kamar"]; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tipe Kamar <?= ucwords($data['tipe_kamar']); ?> ?')"><i class="fa-regular fa-trash-can"></i>Hapus</a>
               </td>
            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<div class="text-end">
   <a href="./tambahKamar.php"><img src="../../img/add.png" width="50" title="Tambah Tipe Kamar"></a>
</div>


<?php require_once("../layouts/footer.php"); ?>