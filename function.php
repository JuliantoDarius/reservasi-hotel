<?php

session_start();
$koneksi = mysqli_connect("localhost", "root", "", "hotel");
const FLASH = "FLASH_MESSAGE";
const FLASH_ERROR = "danger";
const FLASH_SUCCESS = "success";
const FLASH_INFO = "info";
const FLASH_WARNING = "warning";

function cekLogin($hakAkses)
{
   if (!isset($_SESSION["login"])) {
      header("Location: ../../index.php");
      exit;
   }

   if ($_SESSION["hakAkses"] !== $hakAkses) {
      header("Location: ../../index.php");
      exit;
   }
}

function query($query)
{
   global $koneksi;
   return mysqli_query($koneksi, $query);
}

// * Insert Query's

function insertReservasi($post)
{
   $idReservasi = query("SELECT id_reservasi FROM reservasi ORDER BY id_reservasi DESC LIMIT 1");
   $idReservasi = autoNumber($idReservasi, "id_reservasi", "RSV");
   $idAkun = $_SESSION["idAkun"];
   $idKamar = $post["idKamar"];

   $namaPemesan = htmlspecialchars($post["namaPemesan"]);
   $email = htmlspecialchars($post["email"]);
   $noHp = htmlspecialchars($post["noHp"]);
   $namaTamu = htmlspecialchars($post["namaTamu"]);
   $jumlahKamar = $post["jumlahKamar"];

   $dataKamar = query("SELECT jumlah_kamar FROM kamar WHERE id_kamar = '$idKamar'");
   $dataKamar = mysqli_fetch_assoc($dataKamar)["jumlah_kamar"];
   $jumlahKamarTersedia = $dataKamar - $jumlahKamar;
   if ($jumlahKamarTersedia < 0) {
      $sisaKamar = abs($dataKamar);
      flash("reservasi", "Hanya Tersisa $sisaKamar Kamar Yang Tersedia Untuk Tipe Kamar Ini", FLASH_WARNING);
      header("Location: ../home/home.php");
      exit;
   }

   $valueUpdate = "jumlah_kamar = '$jumlahKamarTersedia'";
   update("kamar", $valueUpdate, "id_kamar", $idKamar);

   $checkin = date("Y-m-d", strtotime($post["check-in"]));
   $checkout = date("Y-m-d", strtotime($post["check-out"]));

   $value = "
      '$idReservasi',
      '$idAkun',
      '$idKamar',
      '$namaPemesan',
      '$email',
      '$noHp',
      '$namaTamu',
      '$jumlahKamar',
      '$checkin',
      '$checkout'
   ";

   $insert = insert("reservasi", $value);
   if (!$insert) {
      flash("reservasi", "Gagal Melakukan Reservasi Silahkan Coba Lagi !", FLASH_ERROR);
      header("Location: ../home/home.php");
      exit;
   }

   flash("reservasi", "Berhasil Melakukan Reservasi ! Silahkan Cetak Bukti Reservasi !", FLASH_SUCCESS);
   header("Location: ../reservasi/riwayatReservasi.php");
   exit;
}

function insertFasilitas($post, $direct)
{
   $idFasilitas = query("SELECT id_fasilitas FROM fasilitas ORDER BY id_fasilitas DESC LIMIT 1");

   $idFasilitas = autoNumber($idFasilitas, "id_fasilitas", "FLT");
   $namaFasilitas = strtolower(htmlspecialchars($post["namaFasilitas"]));
   $keterangan = htmlspecialchars($post["keterangan"]);

   if (isset($post["idKamar"])) {
      $idKamar = $post["idKamar"];

      if (!cekTable("fasilitas", "id_kamar", $idKamar, "nama_fasilitas", $namaFasilitas)) {
         $query = query("SELECT tipe_kamar FROM kamar WHERE id_kamar = '$idKamar'");
         $data = mysqli_fetch_assoc($query);
         $tipeKamar = ucwords($data["tipe_kamar"]);

         flash("fasilitas-sudah-ada", "Fasilitas Ini Sudah Tersedia Di Tipe Kamar $tipeKamar", FLASH_ERROR);
         return false;
      }

      $idGambar = query("SELECT gambar FROM fasilitas ORDER BY gambar DESC LIMIT 1");
      $idGambar = autoNumber($idGambar, "gambar", "IMG");
      $gambar = uploadGambar($_FILES["gambar"], $idGambar);

      $value = "'$idFasilitas', '$namaFasilitas', '$keterangan', '$gambar', '$idKamar'";
   } else {
      if (!cekTable("fasilitas", "nama_fasilitas", $namaFasilitas, "id_kamar", "NULL")) {
         flash("fasilitasHotel-sudah-ada", "Fasilitas Ini Sudah Tersedia", FLASH_ERROR);
         return false;
      }

      $idGambar = query("SELECT gambar FROM fasilitas ORDER BY gambar DESC LIMIT 1");
      $idGambar = autoNumber($idGambar, "gambar", "IMG");
      $gambar = uploadGambar($_FILES["gambar"], $idGambar);

      $value = "'$idFasilitas', '$namaFasilitas', '$keterangan', '$gambar', NULL";
   }

   $insert = insert("fasilitas", $value);

   if (!$insert) {
      flash("fasilitas-not-inserted", "Gagal Menambah Fasilitas Silahkan Coba Lagi !", FLASH_ERROR);
      return false;
   }

   flash("fasilitas-inserted", "Berhasil Menambah Fasilitas !", FLASH_SUCCESS);
   header("Location: $direct");
   exit;
}

function insertKamar($post)
{
   $tipeKamar = strtolower(htmlspecialchars($post["tipeKamar"]));

   if (!cekTable("kamar", "tipe_kamar", $tipeKamar)) {
      flash("tipeKamar-taken", "Tipe Kamar Ini Sudah Ada !", FLASH_ERROR);
      return false;
   }

   $jumlahKamar = htmlspecialchars($post["jumlahKamar"]);

   $query = query("SELECT id_kamar FROM kamar ORDER BY id_kamar DESC LIMIT 1");

   $idKamar = autoNumber($query, "id_kamar", "KMR");

   $value = "'$idKamar', '$tipeKamar', '$jumlahKamar'";
   $insert = insert("kamar", $value);

   if (!$insert) {
      flash("kamar-not-inserted", "Tidak Dapat Menambah Tipe Kamar Silahkan Coba Lagi !", FLASH_ERROR);
      return false;
   }

   flash("kamar-inserted", "Berhasil Menambah Tipe Kamar !", FLASH_SUCCESS);
   header("Location: ./kamar.php");
   exit;
}

function insertAkun($post, $direct)
{
   $username = strtolower(htmlspecialchars($post["username"]));

   if (!cekTable("akun", "username", $username)) {
      flash("username-taken", "Maaf Username Telah Digunakan !", FLASH_ERROR);
      return false;
   }

   $password = strtolower(htmlspecialchars($post["password"]));
   $konfirmasi = strtolower(htmlspecialchars($post["konfirmasi"]));

   if (isset($post["hakAkses"])) {
      $hakAkses = $post["hakAkses"];
      if ($hakAkses === "admin") {
         $format = "ADM";
      } else if ($hakAkses === "resepsionis") {
         $format = "RSR";
      } else {
         $format = "USR";
      }
   } else {
      $hakAkses = "user";
      $format = "USR";
   }


   if ($password !== $konfirmasi) {
      flash("not-confirmed", "Password Yang Anda Masukkan Tidak Sama", FLASH_ERROR);
      return false;
   }


   $query = query("SELECT id_akun FROM akun WHERE id_akun LIKE '$format%' ORDER BY id_akun DESC LIMIT 1");

   $idAkun = autoNumber($query, "id_akun", "$format");

   $value = "'$idAkun', '$username', '$password', '$hakAkses'";
   $insert = insert("akun", $value);

   if (!$insert) {
      flash("akun-not-inserted", "Terjadi Kesalahan ! Tidak Dapat Membuat Akun Silahkan Coba Lagi", FLASH_ERROR);
      return false;
   }

   if (isset($_SESSION["hakAkses"])) {
      flash("akun-inserted", "Berhasil Menambah Akun !", FLASH_SUCCESS);
      header("Location: $direct");
      exit;
   } else {
      $_SESSION["login"] = "sudah login";
      $_SESSION["idAkun"] = $idAkun;
      $_SESSION["hakAkses"] = $hakAkses;

      header("Location: $direct");
      exit;
   }
}

function insert($tbl, $value)
{
   $query = "INSERT INTO $tbl VALUES ($value)";
   $insert = query($query);
   return $insert;
}

// * Update Query's

function updateAkun($post, $idAkun)
{
   $username = strtolower(htmlspecialchars($post["username"]));
   $usernameLama = strtolower($post["usernameLama"]);
   if ($username !== $usernameLama) {
      if (!cekTable("akun", "username", $username)) {
         flash("username-taken", "Maaf Username Telah Digunakan !", FLASH_ERROR);
         return false;
      }
   }

   if ($post["password"] === "" && $post["konfirmasi"] === "") {
      $password = $post["passwordLama"];
   } else {
      $password = htmlspecialchars($post["password"]);
      $konfirmasi = htmlspecialchars($post["konfirmasi"]);
      if ($password !== $konfirmasi) {
         flash("not-confirmed", "Password Yang Anda Masukkan Tidak Sama", FLASH_ERROR);
         return false;
      }
   }

   $hakAkses = $post["hakAkses"];

   $value = "username = '$username', password = '$password', hak_akses = '$hakAkses'";
   $update = update("akun", $value, "id_akun", $idAkun);
   if (!$update) {
      flash("akun-not-updated", "Gagal Mengupdate Akun Silahkan Coba Lagi !", FLASH_ERROR);
      return false;
   }

   flash("akun-updated", "Berhasil Mengupdate Akun !", FLASH_INFO);
   header("Location: ./akun.php");
   exit;
}

function updateFasilitas($post, $idFasilitas, $direct)
{
   $namaFasilitas = strtolower(htmlspecialchars($post["namaFasilitas"]));
   $keterangan = htmlspecialchars($post["keterangan"]);

   $namaFasilitasLama = strtolower($post["namaFasilitasLama"]);
   if (isset($post["idKamar"])) {
      $idKamar = $post["idKamar"];

      if ($namaFasilitas !== $namaFasilitasLama) {
         if (!cekTable("fasilitas", "id_kamar", $idKamar, "nama_fasilitas", $namaFasilitas)) {
            $query = query("SELECT tipe_kamar FROM kamar WHERE id_kamar = '$idKamar'");
            $data = mysqli_fetch_assoc($query);
            $tipeKamar = ucwords($data["tipe_kamar"]);

            flash("fasilitas-sudah-ada", "Fasilitas Ini Sudah Tersedia Di Tipe Kamar $tipeKamar", FLASH_ERROR);
            return false;
         }
      }

      if ($_FILES["gambar"]["error"] === 4) {
         $gambar = $post["gambarLama"];
      } else {
         $idGambar = query("SELECT gambar FROM fasilitas ORDER BY gambar DESC LIMIT 1");
         $idGambar = autoNumber($idGambar, "gambar", "IMG");

         $gambar = uploadGambar($_FILES["gambar"], $idGambar);
         if (!$gambar) {
            return false;
         }

         $deleteOldImg = "../../img/" . $post["gambarLama"];
         if (file_exists($deleteOldImg)) {
            unlink($deleteOldImg);
         }
      }

      $value = "nama_fasilitas = '$namaFasilitas', keterangan = '$keterangan', gambar = '$gambar', id_kamar = '$idKamar'";
   } else {
      if ($namaFasilitas !== $namaFasilitasLama) {
         if (!cekTable("fasilitas", "nama_fasilitas", $namaFasilitas, "id_kamar", "NULL")) {
            flash("fasilitasHotel-sudah-ada", "Fasilitas Ini Sudah Tersedia", FLASH_ERROR);
            return false;
         }
      }

      if ($_FILES["gambar"]["error"] === 4) {
         $gambar = $post["gambarLama"];
      } else {
         $idGambar = query("SELECT gambar FROM fasilitas ORDER BY gambar DESC LIMIT 1");
         $idGambar = autoNumber($idGambar, "gambar", "IMG");

         $gambar = uploadGambar($_FILES["gambar"], $idGambar);
         if (!$gambar) {
            return false;
         }

         $deleteOldImg = "../../img/" . $post["gambarLama"];
         if (file_exists($deleteOldImg)) {
            unlink($deleteOldImg);
         }
      }

      $value = "nama_fasilitas = '$namaFasilitas', keterangan = '$keterangan', gambar = '$gambar'";
   }

   $update = update("fasilitas", $value, "id_fasilitas", $idFasilitas);

   if (!$update) {
      flash("fasilitas-not-updated", "Gagal Mengupdate Fasilitas Silahkan Coba Lagi !", FLASH_ERROR);
      return false;
   }


   flash("fasilitas-updated", "Berhasil Mengupdate Fasilitas !", FLASH_INFO);
   header("Location: ./$direct");
   exit;
}

function updateKamar($post, $idKamar)
{
   $tipeKamar = strtolower(htmlspecialchars($post["tipeKamar"]));

   $tipeKamarLama = strtolower($post["tipeKamarLama"]);
   if ($tipeKamar !== $tipeKamarLama) {
      if (!cekTable("kamar", "tipe_kamar", $tipeKamar)) {
         flash("tipeKamar-taken", "Tipe Kamar Ini Sudah Ada !", FLASH_ERROR);
         return false;
      }
   }

   $jumlahKamar = htmlspecialchars($post["jumlahKamar"]);

   $value = "tipe_kamar = '$tipeKamar', jumlah_kamar = '$jumlahKamar'";
   $update = update("kamar", $value, "id_kamar", $idKamar);

   if (!$update) {
      flash("kamar-not-updated", "Tidak Dapat Mengupdate Tipe Kamar Silahkan Coba Lagi !", FLASH_ERROR);
      return false;
   }

   flash("kamar-updated", "Berhasil Mengupdate Tipe Kamar !", FLASH_INFO);
   header("Location: ./kamar.php");
   exit;
}

function update($tbl, $value, $unique, $uniqueValue)
{
   $query = "UPDATE $tbl SET $value WHERE $unique = '$uniqueValue'";
   $update = query($query);
   return $update;
}

// * Delete Query's

function delete($tbl, $unique, $uniqueValue)
{
   $query = "DELETE FROM $tbl WHERE $unique = '$uniqueValue'";
   $delete = query($query);
   return $delete;
}

function autoNumber($query, $key, $format)
{
   if (mysqli_num_rows($query) < 1) {
      $str = $format . "0000";
   } else {
      $data = mysqli_fetch_assoc($query);
      $str = $data[$key];
   }
   $split = substr($str, 3);
   $angka = (int) $split + 1;
   if ($angka >= 1000) {
      return sprintf("%s%s", $format, $angka);
   } else if ($angka >= 100) {
      return sprintf("%s0%s", $format, $angka);
   } else if ($angka >= 10) {
      return sprintf("%s00%s", $format, $angka);
   } else {
      return sprintf("%s000%s", $format, $angka);
   }
}

function flash($name = "", $message = "", $type = "")
{
   if ($name !== "" && $message !== "" && $type !== "") {
      createFlashMessage($name, $message, $type);
   } else if ($name != "" && $message == "" && $type == "") {
      displayMessage($name);
   } else {
      echo "
          <script>
              alert('Buat Flash Message Terlebih Dahulu');
          </script>
      ";
   }
}

function createFlashMessage($flashName, $flashMessage, $flashType)
{
   if (isset($_SESSION[FLASH][$flashName])) {
      unset($_SESSION[FLASH][$flashName]);
   }

   $_SESSION[FLASH][$flashName] = ["message" => $flashMessage, "type" => $flashType];
}

function formatFlashMessage($flashArr)
{
   return sprintf(
      "<div class='alert alert-%s flash' role='alert' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Click to Close'>%s</div>",
      $flashArr["type"],
      $flashArr["message"]
   );
}

function displayMessage($name)
{
   if (!isset($_SESSION[FLASH][$name])) {
      return;
   }

   // get message from the session
   $flashSession = $_SESSION[FLASH][$name];

   unset($_SESSION[FLASH][$name]);

   echo formatFlashMessage($flashSession);
}

function cekFlashMessage($name)
{
   if (isset($_SESSION[FLASH][$name])) {
      flash($name);
   } else {
      return;
   }
}

function formatAngka($angka)
{
   return number_format($angka, 0, ",", ".");
}

function uploadGambar($files, $namaGambarBaru)
{
   $namaGambar = $files["name"];
   $tmpName = $files["tmp_name"];
   $ekstensiGambar = explode(".", $namaGambar);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   $ekstensiGambarValid = ["jpg", "jpeg", "png"];

   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      flash("false-extention", "Gagal Mengupload Gambar ! Silahkan Upload Gambar Yang Berekstensi jpg, jpeg, atau png", FLASH_WARNING);
      return false;
   }

   $gambar = $namaGambarBaru . "." . $ekstensiGambar;

   move_uploaded_file($tmpName, "../../img/" . $gambar);
   return $gambar;
}

function cekTable($tbl, $unique, $uniqueValue, $unique2 = "", $uniqueValue2 = "")
{
   if ($unique2 == "" && $uniqueValue2 == "") {
      $cek = query("SELECT * FROM $tbl WHERE $unique = '$uniqueValue'");
      if (mysqli_num_rows($cek) > 0) {
         return false;
      } else {
         return true;
      }
   } else if ($uniqueValue2 == "NULL") {
      $cek = query("SELECT * FROM $tbl WHERE $unique = '$uniqueValue' AND $unique2 IS NULL");
      if (mysqli_num_rows($cek) > 0) {
         return false;
      } else {
         return true;
      }
   } else {
      $cek = query("SELECT * FROM $tbl WHERE $unique = '$uniqueValue' AND $unique2 = '$uniqueValue2'");
      if (mysqli_num_rows($cek) > 0) {
         return false;
      } else {
         return true;
      }
   }
}
