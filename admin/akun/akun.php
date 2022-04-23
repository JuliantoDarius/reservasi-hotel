<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);
$_SESSION["fileAktif"] = basename(__FILE__, ".php");

require_once("../layouts/header.php");

$query = query("SELECT * FROM akun ORDER BY id_akun DESC");

?>

<div id="alert" class="mb-3">
   <?php
   cekFlashMessage("akun-inserted");
   cekFlashMessage("akun-updated");
   cekFlashMessage("hapus-akun");
   ?>

</div>

<table class="table table-striped mb-3">
   <thead>
      <tr>
         <th scope="col">No</th>
         <th scope="col">Username</th>
         <th scope="col">Hak Akses</th>
         <th scope="col">Aksi</th>
      </tr>
   </thead>
   <tbody>
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="4" class="table-danger">
               Tidak Ada Data Akun Pada Database
            </td>
         </tr>
      <?php else : ?>
         <?php $no = 1; ?>
         <?php while ($data = mysqli_fetch_assoc($query)) : ?>
            <tr>
               <th scope="row"><?= $no++; ?></th>
               <td>
                  <?= $data["username"]; ?>
               </td>
               <td><?= ucwords($data["hak_akses"]) ?></td>
               <td>
                  <a href="./editAkun.php?id=<?= $data["id_akun"]; ?>" class="btn btn-warning">
                     <i class="fa-regular fa-pen-to-square"></i>Edit
                  </a>

                  <a href="./hapusAkun.php?id=<?= $data["id_akun"]; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Akun Ini ?')">
                     <i class="fa-regular fa-trash-can"></i>Hapus
                  </a>
               </td>
            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<div class="text-end">
   <a href="./tambahAkun.php"><img src="../../img/add.png" width="50" title="Tambah Akun"></a>
</div>


<?php require_once("../layouts/footer.php"); ?>