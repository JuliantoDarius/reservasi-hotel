<?php

require_once("../../function.php");

if (!isset($_GET["id"])) {
   header("Location: ../akun/akun.php");
   exit;
}

$idAkun = $_GET["id"];

$delete = delete("akun", "id_akun", $idAkun);

if (!$delete) {
   flash("hapus-akun", "Gagal Menghapus Akun Silahkan Coba Lagi !", FLASH_ERROR);
   header("Location: ./akun.php");
   exit;
}

flash("hapus-akun", "Berhasil Menghapus Akun !", FLASH_WARNING);
header("Location: ./akun.php");
exit;
