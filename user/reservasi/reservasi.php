<?php

require_once("../../function.php");

if (isset($_POST["pesan"])) {
   $checkin = $_POST["check-in"];
   $checkout = $_POST["check-out"];
   $jumlahKamar = $_POST["jumlahKamar"];

   if ($checkin == "") {
      flash("isi-tanggal-checkin", "Anda Harus Menentukan Tanggal Check-in", FLASH_WARNING);
      header("Location: ../home/home.php");
      exit;
   } else if ($checkout == "") {
      flash("isi-tanggal-checkout", "Anda Harus Menentukan Tanggal Check-out", FLASH_WARNING);
      header("Location: ../home/home.php");
      exit;
   }
   if ($jumlahKamar == "") {
      flash("isi-jumlahKamar", "Anda Harus Menentukan Jumlah Kamar Yang Ingin Anda Pesan", FLASH_WARNING);
      header("Location: ../home/home.php");
      exit;
   }

   insertReservasi($_POST);
}
