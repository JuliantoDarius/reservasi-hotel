<?php

require_once("../../function.php");

$_SESSION["aktif"] = basename(__DIR__);

require_once("../layouts/header.php");

?>

<div>
   <div class="row float-left">
      <div class="col-10">
         <input type="text" id="check-in" class="form-control datepicker" placeholder="Tanggal Check-in" onchange="handlePesan();">
      </div>
      <div class="col-2">
         <label for="check-in">
            <i class="fa-regular fa-calendar-days date-icon"></i>
         </label>
      </div>
   </div>

   <div class="row float-left">
      <div class="col-10">
         <input type="text" id="check-out" class="form-control datepicker" placeholder="Tanggal Check-out" onchange="handlePesan();">
      </div>
      <div class="col-2">
         <label for="check-out">
            <i class="fa-regular fa-calendar-days date-icon"></i>
         </label>
      </div>
   </div>

   <div class="row float-left">
      <div class="col-10">
         <input type="number" id="jumlahKamar" class="form-control" placeholder="Jumlah Kamar" onkeyup="handlePesan();" min="1">
      </div>
      <div class="col-2">
         <label for="">
            <i class="fa-solid fa-bed bed-icon"></i>
         </label>
      </div>
   </div>

   <?php if (!isset($_SESSION["login"])) : ?>
      <div>
         <button class="btn btn-success tombol-pesan" id="blmLogin" onclick="handleBtn(this, '../ajax/ajaxPesan.php');">Pesan Kamar</button>
      </div>
   <?php else : ?>
      <div>
         <button class="btn btn-success tombol-pesan" id="pesan" onclick="handleBtn(this, '../ajax/ajaxPesan.php');">Pesan Kamar</button>
      </div>
   <?php endif; ?>
</div>

<div class="article">
   <h1 class="mb-4 title text-center mt-4">Tentang Kami</h1>
   <p>
      Lepaskan diri Anda ke Joy Hotel, dikelilingi oleh keindahan pegununungan yang indah, danau, dan sawah menghijau. Nikmati sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid's Club yang luas - menawarkan bergam fasilitas dan kegiatan anak - anak yang akan melengkapi kenyamanan keluarga. Convention Center kami, dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Surabaya, mampu mengakomodasi hingga 5.000 delegasi. Manfaatkan ruang penyelnggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah.
   </p>
</div>

<?php require_once("../layouts/footer.php"); ?>