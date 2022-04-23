<?php cekLogin("admin"); ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="../../style/admin.css">
  <script src="https://kit.fontawesome.com/76469cb42c.js" crossorigin="anonymous"></script>

  <title>Joy Hotel</title>
</head>

<body>

  <div class="sidebar">
    <ul>
      <li class="brand">JOY HOTEL</li>
      <li class="item">
        <a href="../kamar/kamar.php" class="<?= ($_SESSION["aktif"] === "kamar") ? "aktif" : "" ?>"><i class="fa-solid fa-bed"></i>Kamar
        </a>
      </li>

      <li class="item dropdown">
        <a href="#" class="<?= ($_SESSION["aktif"] === "fasilitas") ? "aktif" : "" ?>" id="dropdownMenuLink" data-bs-toggle="dropdown">
          <i class="fa-solid fa-hotel"></i>Fasilitas
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li>
            <a class="dropdown-item" href="../fasilitas/fasilitasKamar.php">Fasilitas Kamar
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="../fasilitas/fasilitasHotel.php">Fasilitas Hotel</a>
          </li>
        </ul>
      </li>

      <li class="item">
        <a href="../akun/akun.php" class="<?= ($_SESSION["aktif"] === "akun") ? "aktif" : "" ?>"><i class="fa-solid fa-users"></i>Akun
        </a>
      </li>

      <li class="item">
        <a href="../../logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')"><i class="fa-solid fa-arrow-right-from-bracket"></i>Sign-Out
        </a>
      </li>
    </ul>
  </div>

  <div class="content">

    <h1 class="mb-4"><?= ucwords($_SESSION["fileAktif"]); ?></h1>