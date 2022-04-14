<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ./user/home/home.php");
    exit;
}

header("Location: ./admin/home/home.php");
exit;
