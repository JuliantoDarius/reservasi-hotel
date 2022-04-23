<?php
if (isset($_SESSION["hakAkses"])) {
   if ($_SESSION["hakAkses"] !== "user") {
      header("Location: ../../index.php");
      exit;
   }
}
?>
<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <!-- CSS Bootstrap Datepicker -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">

   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

   <!-- Javascript Bootstrap -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js">
   </script>
   <!-- Javascript Bootstrap Datepicker -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
   </script>

   <script src="https://kit.fontawesome.com/76469cb42c.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../../style/user.css">
   <title>Joy Hotel</title>

</head>

<body>
   <div id="alert">
      <?php
      flash("tidak-valid");
      flash("isi-tanggal-checkin");
      flash("isi-tanggal-checkout");
      flash("isi-jumlahKamar");
      flash("reservasi");
      ?>
   </div>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
         <a class="navbar-brand fs-2" href="../home/home.php">JOY HOTEL</a>
         <ul class="navbar-nav nav justify-content-end">
            <li class="nav-item">
               <a class="nav-link <?= ($_SESSION["aktif"] === "home") ? "active" : "" ?>" href="../home/home.php">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?= ($_SESSION["aktif"] === "kamar") ? "active" : "" ?>" href="../kamar/kamar.php">Kamar</a>
            </li>
            <li class="nav-item">
               <a class="nav-link <?= ($_SESSION["aktif"] === "fasilitas") ? "active" : "" ?>" href="../fasilitas/fasilitas.php">Fasilitas</a>
            </li>
            <?php if (!isset($_SESSION["login"])) : ?>
               <li class="nav-item">
                  <a class="nav-link btn btn-outline-success" href="../../login.php" style="width: 100px; margin-left: 20px;">Login</a>
               </li>
            <?php else : ?>
               <li class="nav-item">
                  <a class="nav-link <?= ($_SESSION["aktif"] === "reservasi") ? "active" : "" ?>" href="../reservasi/riwayatReservasi.php">Reservasi</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link btn btn-outline-danger" href="../../logout.php" style="width: 100px; margin-left: 20px;" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')">Sign-Out</a>
               </li>
            <?php endif; ?>
         </ul>
      </div>
   </nav>

   <?php if ($_SESSION["aktif"] !== "kamar" && $_SESSION["aktif"] !== "reservasi") : ?>

      <div id="carouselExampleCaptions" class="carousel slide mb-3" data-bs-ride="carousel">
         <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
         </div>
         <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
               <img src="../../img/carousel1.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
               </div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
               <img src="../../img/carousel2.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
               </div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
               <img src="../../img/carousel3.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
               </div>
            </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>

      <div class="content">
      <?php endif; ?>