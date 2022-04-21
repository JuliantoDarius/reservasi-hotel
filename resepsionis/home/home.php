<?php

require_once("../../function.php");
require_once("../layouts/header.php");

$query = mysqli_query($koneksi, "SELECT nama_tamu, tgl_check_in, tgl_check_out FROM reservasi ORDER BY id_reservasi DESC") or die(mysqli_error($koneksi));

?>

<div class="mb-4 row">
   <div class="col-3">
      <input type="text" class="form-control datepicker" id="tanggal" placeholder="Cari Tanggal Check-in" onchange="tgl(this);" onkeypress="tgl(this);">
   </div>
   <label for="tanggal" class="col-6 col-form-label">
      <i class="fa-regular fa-calendar-days date-icon"></i>
   </label>
   <div class="col-3">
      <input type="text" name="" class="form-control" id="search" placeholder="Cari Nama Tamu">
   </div>
</div>

<table class="table table-striped">
   <thead>
      <tr>
         <th scope="col">Nama Tamu</th>
         <th scope="col">Tanggal Check In</th>
         <th scope="col">Tanggal Check Out</th>
         <th scope="col">Aksi</th>
      </tr>
   </thead>

   <tbody>
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="4" class="table-warning">Tidak Ada Customer Yang Melakukan Reservasi</td>
         </tr>

      <?php else : ?>
         <?php while ($data = mysqli_fetch_assoc($query)) : ?>
            <tr>
               <th scope="row">
                  <?= ucwords($data["nama_tamu"]); ?>
               </th>

               <td>
                  <?= date("d-m-Y", strtotime($data["tgl_check_in"])) ?>
               </td>

               <td>
                  <?= date("d-m-Y", strtotime($data["tgl_check_out"])) ?>
               </td>

               <td>
                  <a href="#" class="btn btn-info">Lihat Detail</a>
                  <a href="#" class="btn btn-warning">Cetak Bukti</a>
               </td>

            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<?php require_once("../layouts/footer.php"); ?>