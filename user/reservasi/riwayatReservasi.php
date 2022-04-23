<?php
require_once("../../function.php");
$_SESSION["aktif"] = basename(__DIR__);
require_once("../layouts/header.php");

$idAkun = $_SESSION["idAkun"];

$query = query("SELECT id_reservasi, nama_pemesan, nama_tamu, tipe_kamar, tgl_check_in, tgl_check_out  FROM reservasi R INNER JOIN kamar K ON R.id_kamar = K.id_kamar WHERE id_akun = '$idAkun'");

?>
<div class="content">
   <h1>Reservasi Anda</h1>
   <h6>
      Cetak Bukti Reservasi Untuk Diserahkan Kepada Resepsionis Pada Saat Check-in
   </h6>
   <table class="table table-striped mt-4">
      <thead>
         <tr>
            <th scope="col">Nama Pemesan</th>
            <th scope="col">Nama Tamu</th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Tgl Check-in</th>
            <th scope="col">Tgl Check-out</th>
            <th scope="col">Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php if (mysqli_num_rows($query) < 1) : ?>
            <tr>
               <td colspan="6" class="table-warning">
                  Anda Belum Melakukan Reservasi, Silahkan Lakukan Pemesanan Terlebih Dahulu !
               </td>
            </tr>
         <?php else : ?>
            <?php while ($data = mysqli_fetch_assoc($query)) : ?>
               <tr>
                  <td><?= ucwords($data["nama_pemesan"]); ?></td>
                  <td><?= ucwords($data["nama_tamu"]); ?></td>
                  <td><?= ucwords($data["tipe_kamar"]); ?></td>
                  <td>
                     <?= date("d-m-Y", strtotime($data["tgl_check_in"])); ?>
                  </td>
                  <td>
                     <?= date("d-m-Y", strtotime($data["tgl_check_out"])); ?>
                  </td>
                  <td>
                     <a href="./cetak.php?id=<?= $data["id_reservasi"]; ?>" class="btn btn-info">Cetak Bukti</a>
                  </td>
               </tr>
            <?php endwhile; ?>
         <?php endif; ?>
      </tbody>
   </table>
</div>

<?php require_once("../layouts/footer.php"); ?>