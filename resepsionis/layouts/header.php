<?php cekLogin("resepsionis"); ?>
<!DOCTYPE html>
<html>

<head>
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

   <style>
      .date-icon {
         position: relative;
         top: -4px;
         left: -10px;
      }
   </style>

   <title>Joy Hotel</title>
</head>

<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
         <a class="navbar-brand fs-2" href="../home/home.php">JOY HOTEL</a>
         <ul class="navbar-nav nav justify-content-end">
            <li class="nav-item">
               <a class="nav-link btn btn-outline-danger" href="../../logout.php" style="width: 100px; margin-left: 20px;" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')">Sign-Out</a>
            </li>
         </ul>
      </div>
   </nav>

   <div class="content">