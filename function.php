<?php 

session_start();
$koneksi = mysqli_connect("localhost", "root", "", "hotel");

function query($query) {
   global $koneksi;
   return mysqli_query($koneksi, $query);
}
