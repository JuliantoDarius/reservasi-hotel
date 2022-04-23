<?php 

require_once("../../function.php");

$tgl = date("Y-m-d", strtotime($_GET["tgl"]));
$namaTamu = strtolower($_GET["key"]);

$default = query("SELECT id_reservasi, nama_tamu, tgl_check_in, tgl_check_out FROM reservasi ORDER BY id_reservasi DESC");

if($tgl == "1970-01-01") {
   $tgl = "";
}

if($tgl === "" && $namaTamu !== "" ) {
   $cari = query("SELECT id_reservasi, nama_tamu, tgl_check_in, tgl_check_out FROM reservasi WHERE tgl_check_in = '$tgl' OR nama_tamu LIKE '%$namaTamu%'");
} else if($tgl !== "" && $namaTamu === "" || $tgl !== "" && $namaTamu !== "") {
   $cari = query("SELECT id_reservasi, nama_tamu, tgl_check_in, tgl_check_out FROM reservasi WHERE tgl_check_in = '$tgl' AND nama_tamu LIKE '%$namaTamu%'");
}

?>

<?php if($tgl == "" && $namaTamu == "") : ?>
   <?php if (mysqli_num_rows($default) < 1) : ?>
      <tr>
         <td colspan="4" class="table-warning">
            Belum Ada Customer Yang Melakukan Reservasi
         </td>
      </tr>

   <?php else : ?>
      <?php while ($data = mysqli_fetch_assoc($default)) : ?>
         <tr>
            <th scope="row">
               <?= ucwords($data["nama_tamu"]); ?>
            </th>

            <td>
               <?= date("d-m-Y", strtotime($data["tgl_check_in"])) ?>
            </td>

            <td>
               <?= date("d-m-Y", strtotime($data["tgl_check_out"])) ?>
            </td>

            <td>
               <a href="../detail/detail.php?id=<?= $data["id_reservasi"] ?>" class="btn btn-info">Lihat Detail</a>
            </td>

         </tr>
      <?php endwhile; ?>
   <?php endif; ?>

   <?php else : ?>
      <?php if (mysqli_num_rows($cari) < 1) : ?>
      <tr>
         <td colspan="4" class="table-danger">
            Data Reservasi Tidak Ditemukan
         </td>
      </tr>

   <?php else : ?>
      <?php while ($data = mysqli_fetch_assoc($cari)) : ?>
         <tr>
            <th scope="row">
               <?= ucwords($data["nama_tamu"]); ?>
            </th>

            <td>
               <?= date("d-m-Y", strtotime($data["tgl_check_in"])) ?>
            </td>

            <td>
               <?= date("d-m-Y", strtotime($data["tgl_check_out"])) ?>
            </td>

            <td>
               <a href="../detail/detail.php?id=<?= $data["id_reservasi"] ?>" class="btn btn-info">Lihat Detail</a>
            </td>

         </tr>
      <?php endwhile; ?>
   <?php endif; ?>


<?php endif; ?>

