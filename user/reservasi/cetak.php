<?php

require_once("../../function.php");
require_once("../../fpdf/fpdf.php");

if (!isset($_GET["id"])) {
   header("Location: ./riwayatReservasi.php");
   exit;
}

$idReservasi = $_GET["id"];
$query = query("SELECT nama_pemesan, nama_tamu, tgl_check_in, tgl_check_out, tipe_kamar, email, no_hp, R.jumlah_kamar FROM reservasi R INNER JOIN kamar K ON R.id_kamar = K.id_kamar WHERE id_reservasi = '$idReservasi'");

$data = mysqli_fetch_assoc($query);
$tipeKamar = ucwords($data["tipe_kamar"]);
$checkin = date("d-m-Y", strtotime($data["tgl_check_in"]));
$checkout = date("d-m-Y", strtotime($data["tgl_check_out"]));
$pemesan = ucwords($data["nama_pemesan"]);
$tamu = ucwords($data["nama_tamu"]);
$email = $data["email"];
$noHp = $data["no_hp"];
$jumlahKamar = $data["jumlah_kamar"];

$top = [
   ["label" => "Nama Hotel", "length" => 50, "newLine" => 0],
   ["label" => "Joy Hotel", "length" => 50, "newLine" => 1],
   ["label" => "Tipe Kamar", "length" => 50, "newLine" => 0],
   ["label" => $tipeKamar, "length" => 50, "newLine" => 1],
   ["label" => "Tgl Check-in", "length" => 50, "newLine" => 0],
   ["label" => $checkin, "length" => 50, "newLine" => 1],
   ["label" => "Tgl Check-out", "length" => 50, "newLine" => 0],
   ["label" => $checkout, "length" => 50, "newLine" => 1],
];

$bottom = [
   ["label" => "Nama Pemesan", "length" => 40, "newLine" => 0],
   ["label" => $pemesan, "length" => 0, "newLine" => 1],
   ["label" => "Nama Tamu", "length" => 40, "newLine" => 0],
   ["label" => $tamu, "length" => 0, "newLine" => 1],
   ["label" => "Email", "length" => 40, "newLine" => 0],
   ["label" => $email, "length" => 0, "newLine" => 1],
   ["label" => "No HP", "length" => 40, "newLine" => 0],
   ["label" => $noHp, "length" => 0, "newLine" => 1],
   ["label" => "Jumlah Kamar", "length" => 40, "newLine" => 0],
   ["label" => $jumlahKamar, "length" => 0, "newLine" => 1],
];

// TODO pengulangan buat Cell Berdasarkan Data $query

$judul = "BUKTI RESERVASI JOY HOTEL";

$pdf = new FPDF();
$pdf->AddPage("P", "A4");
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(0, 20, $judul, 0, 1, "C");
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(0, 0, 139);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 0, 0);
$pdf->Cell(0, 15, "Detail Hotel", 0, 0, "L", true);
$pdf->Ln();

$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 5, "", 0, 1);
foreach ($top as $kolom) {
   $pdf->Cell($kolom["length"], 12, $kolom["label"], 0, $kolom["newLine"], "L");
}
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 13);
$pdf->SetFillColor(192, 192, 192);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(192, 192, 192);

foreach ($bottom as $cell) {
   $pdf->Cell($cell["length"], 12, $cell["label"], 0, $cell["newLine"], "L", true);
}

$pdf->Output("D", "Bukti Reservasi Joy Hotel.pdf");
