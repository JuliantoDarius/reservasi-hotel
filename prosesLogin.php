<?php

require_once("./function.php");

if (!isset($_POST["login"])) {
    header("Location: ./login.php");
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

$query = query("SELECT * FROM akun WHERE username = '$username' AND password = '$password'");

if (mysqli_num_rows($query) < 1) {
    echo "
        <script>
            alert('Username atau Password Salah !');
            document.location.href = './login.php';
        </script>
    ";
    return false;
}

$data = mysqli_fetch_assoc($query);

$_SESSION["login"] = "sudah login";
$_SESSION["idAkun"] = $data["id_akun"];
$_SESSION["hakAkses"] = $data["hak_akses"];
header("Location: ./index.php");
exit;
