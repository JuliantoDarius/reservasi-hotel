<?php

require_once("../../function.php");

$query = query("SELECT id_kamar, tipe_kamar FROM kamar");

?>
<div>
   <button class="btn btn-danger tombol-pesan" id="batal" onclick="handleBtn(this, '../ajax/ajaxBatal.html');">
      Batalkan Pesanan
   </button>
</div>

<h1 class="mb-4 mt-4">Form Pemesanan</h1>

<form action="../reservasi/reservasi.php" method="post">
   <input type="hidden" name="check-in" id="inputCheckIn">
   <input type="hidden" name="check-out" id="inputCheckOut">
   <input type="hidden" name="jumlahKamar" id="inputJumlahKamar">
   <div class="mb-3 row">
      <label for="namaPemesan" class="col-2 col-form-label">Nama Pemesan</label>
      <div class="col-4">
         <input type="text" class="form-control" id="namaPemesan" placeholder="Nama Anda" name="namaPemesan" onkeyup="handleEnter(event);" required>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="email" class="col-2 col-form-label">Email</label>
      <div class="col-4">
         <input type="email" class="form-control" id="email" placeholder="Email Pemesan" name="email" onkeyup="handleEnter(event);" required>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="noHp" class="col-2 col-form-label">No Handphone</label>
      <div class="col-4">
         <input type="tel" pattern="^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$" class="form-control" placeholder="087812345678" id="noHp" name="noHp" required>
      </div>
   </div>

   <div class="mb-3 row">
      <label for="namaTamu" class="col-2 col-form-label">Nama tamu</label>
      <div class="col-4">
         <input type="text" class="form-control" id="namaTamu" placeholder="Nama Tamu Yang Akan Menginap" name="namaTamu" onkeyup="handleEnter(event);" required>
      </div>
   </div>

   <div class="mb-4 row">
      <label for="tipeKamar" class="col-2 col-form-label">Tipe Kamar</label>
      <div class="col-4">
         <select class="form-select" id="tipeKamar" name="idKamar" required>
            <option selected value="">Pilih Tipe Kamar</option>
            <?php while ($data = mysqli_fetch_assoc($query)) : ?>
               <option value="<?= $data["id_kamar"] ?>">
                  <?= ucwords($data["tipe_kamar"]) ?>
               </option>
            <?php endwhile; ?>
         </select>
      </div>
   </div>

   <div>
      <input type="submit" value="Pesan Kamar" name="pesan" id="pesanKamar" onclick="handlePesan();" onkeyup="handleEnter(event);" class="btn btn-success btn-lg">
   </div>

</form>