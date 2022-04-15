<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ./user/home/home.php");
    exit;
}

if ($_SESSION["hakAkses"] == "admin") {
    header("Location: ./admin/home/home.php");
    exit;
} else {
    header("Location: ./user/home/home.php");
    exit;
}
