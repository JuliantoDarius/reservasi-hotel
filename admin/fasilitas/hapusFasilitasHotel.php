<?php

require_once("../../function.php");

if (!isset($_GET["id"])) {
   header("Location: ../fasilitas/fasilitasHotel.php");
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
   flash("hapus-fasilitas", "Gagal Menghapus Fasilitas Hotel Silahkan Coba Lagi !", FLASH_ERROR);
   header("Location: ./fasilitasHotel.php");
   exit;
}

flash("hapus-fasilitas", "Berhasil Menghapus Fasilitas Hotel !", FLASH_WARNING);
header("Location: ./fasilitasHotel.php");
exit;
