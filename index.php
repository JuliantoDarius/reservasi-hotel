<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ./user/home/home.php");
    exit;
}

if ($_SESSION["hakAkses"] == "admin") {
    header("Location: ./admin/kamar/kamar.php");
    exit;
} else  if ($_SESSION["hakAkses"] == "resepsionis") {
    header("Location: ./resepsionis/home/home.php");
    exit;
} else {
    header("Location: ./user/home/home.php");
    exit;
}
