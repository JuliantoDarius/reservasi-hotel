<?php

require_once("../../function.php");

if (!isset($_GET["id"])) {
   header("Location: ../kamar/kamar.php");
   exit;
}

$idKamar = $_GET["id"];

$delete = delete("kamar", "id_kamar", $idKamar);

if (!$delete) {
   flash("hapus-kamar", "Gagal Menghapus Tipe Kamar Silahkan Coba Lagi !", FLASH_ERROR);
   header("Location: ./kamar.php");
   exit;
}

flash("hapus-kamar", "Berhasil Menghapus Tipe Kamar !", FLASH_WARNING);
header("Location: ./kamar.php");
exit;
