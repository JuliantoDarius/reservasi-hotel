<?php

require_once("../../function.php");

if (!isset($_GET["id"])) {
   header("Location: ../fasilitas/fasilitasKamar.php");
   exit;
}

$idFasilitas = $_GET["id"];

$selectGambar = query("SELECT gambar FROM fasilitas WHERE id_fasilitas = '$idFasilitas'");

$selectGambar = mysqli_fetch_assoc($selectGambar);

$deleteImg = "../../img/" . $selectGambar["gambar"];
if (file_exists($deleteImg)) {
   unlink($deleteImg);
}

$delete = delete("fasilitas", "id_fasilitas", $idFasilitas);

if (!$delete) {
   flash("hapus-fasilitas", "Gagal Menghapus Fasilitas Kamar Silahkan Coba Lagi !", FLASH_ERROR);
   header("Location: ./fasilitasKamar.php");
   exit;
}

flash("hapus-fasilitas", "Berhasil Menghapus Fasilitas Kamar !", FLASH_WARNING);
header("Location: ./fasilitasKamar.php");
exit;
