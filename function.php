<?php

session_start();
$koneksi = mysqli_connect("localhost", "root", "", "hotel");
const FLASH = "FLASH_MESSAGE";
const FLASH_ERROR = "danger";
const FLASH_SUCCESS = "success";
const FLASH_INFO = "info";

function query($query)
{
   global $koneksi;
   return mysqli_query($koneksi, $query);
}

// * Insert Query's

function insertAkun($post, $direct)
{
   $username = htmlspecialchars($post["username"]);
   $password = htmlspecialchars($post["password"]);
   $konfirmasi = htmlspecialchars($post["konfirmasi"]);

   if (isset($post["hakAkses"])) {
      $hakAkses = $post["hakAkses"];
   } else {
      $hakAkses = "user";
   }

   if ($password !== $konfirmasi) {
      flash("not-confirmed", "Password Yang Anda Masukkan Tidak Sama", FLASH_ERROR);
   }

   if ($hakAkses === "admin") {
      $format = "ADM";
   } else {
      $format = "USR";
   }

   $query = query("SELECT id_akun FROM akun WHERE id_akun LIKE '$format%' ORDER BY id_akun DESC LIMIT 1");

   if (mysqli_num_rows($query) < 1) {
      $idAkun = autoNumber($format . "0000", $format);
   } else {
      $data = mysqli_fetch_assoc($query);
      $idAkun = autoNumber($data["id_akun"], $format);
   }

   $value = "'$idAkun', '$username', '$password', '$hakAkses'";
   $insert = insert("akun", $value);

   if (!$insert) {
      flash("not-inserted", "Terjadi Kesalahan Silahkan Coba Lagi", FLASH_ERROR);
      return false;
   }

   header("Location: $direct");
   exit;
}

function insert($tbl, $value)
{
   $query = "INSERT INTO $tbl VALUES ($value)";
   $insert = query($query);
   return $insert;
}

// * Update Query's

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

function autoNumber($str, $format)
{
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
