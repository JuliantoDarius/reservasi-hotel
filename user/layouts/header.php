<?php cekLogin(); ?>
<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <script src="https://kit.fontawesome.com/76469cb42c.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../../style/user.css">
   <title>Joy Hotel</title>
</head>

<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
         <a class="navbar-brand fs-2" href="../home/home.php">JOY HOTEL</a>
         <ul class="navbar-nav nav justify-content-end">
            <li class="nav-item">
               <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Kamar</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Fasilitas</a>
            </li>
            <?php if (!isset($_SESSION["login"])) : ?>
               <li class="nav-item">
                  <a class="nav-link btn btn-outline-success" href="../../login.php" style="width: 100px; margin-left: 20px;">Login</a>
               </li>
            <?php else : ?>
               <li class="nav-item">
                  <a class="nav-link btn btn-outline-danger" href="../../logout.php" style="width: 100px; margin-left: 20px;" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')">Sign-Out</a>
               </li>
            <?php endif; ?>
         </ul>
      </div>
   </nav>