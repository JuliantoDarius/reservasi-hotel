<?php

require_once("../../function.php");
require_once("../layouts/header.php");

$query = query("SELECT id_reservasi, nama_tamu, tgl_check_in, tgl_check_out FROM reservasi ORDER BY id_reservasi DESC");

?>

<div class="mb-4 row">
   <div class="col-3">
      <input type="text" class="form-control datepicker" placeholder="Cari Tanggal Check-in" id="search-tgl-checkin" onchange="handleSearch(this);">
   </div>
   <label for="search-tgl-checkin" class="col-6 col-form-label">
      <i class="fa-regular fa-calendar-days date-icon"></i>
   </label>
   <div class="col-3">
      <input type="text" class="form-control" id="search" placeholder="Cari Nama Tamu" onkeyup="handleSearch();">
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

   <tbody id="reservation-list">
      <?php if (mysqli_num_rows($query) < 1) : ?>
         <tr>
            <td colspan="4" class="table-warning">
               Belum Ada Customer Yang Melakukan Reservasi
            </td>
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
                  <a href="../detail/detail.php?id=<?= $data["id_reservasi"] ?>" class="btn btn-info">Lihat Detail</a>
               </td>

            </tr>
         <?php endwhile; ?>
      <?php endif; ?>
   </tbody>
</table>

<?php require_once("../layouts/footer.php"); ?>