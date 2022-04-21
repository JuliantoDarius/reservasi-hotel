<?php

session_start();

$hakAkses = $_SESSION["hakAkses"];

session_unset();
session_destroy();

if ($hakAkses == "admin" || $hakAkses == "resepsionis") {
   header("Location: ./login.php");
   exit;
} else {
   header("Location: ./index.php");
   exit;
}
