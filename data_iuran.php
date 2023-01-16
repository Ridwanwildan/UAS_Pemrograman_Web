<?php
    include("koneksi.php");
    // query untuk menampilkan data
    //$id = $_POST['id'];
    $id = $_GET['id'];
    $sql = "SELECT warga.nama, iuran.jenis_iuran, iuran.nominal, iuran.tanggal, iuran.keterangan ";
    $sql .= "FROM warga ";
    $sql .= "INNER JOIN iuran ON warga.id = iuran.warga_id WHERE warga_id = '{$id}' ";
    $sql .= "ORDER BY tanggal DESC";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Error: Data tidak tersedia');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DAFTAR IURAN</title>
  </head>

  <body>
    <div class="container">
      <a href="index.php" type="button" class="btn btn-success my-5">Kembali</a>
      <table class="table table-hover">
        <tr class="text-center">
          <th>Nama</th>
          <th>Jenis Iuran</th>
          <th>Nominal</th>
          <th>Tanggal Pembayaran</th>
          <th>Keterangan</th>
        </tr>

        <?php if($result): ?>
        <?php while($row = mysqli_fetch_array($result)): ?>
        <tr class="text-center">
          <td><?= $row['nama'];?></td>
          <td><?= $row['jenis_iuran'];?></td>
          <td>Rp.<?= number_format($row['nominal'], 2, ",", ".");?>,-</td>
          <td><?= $row['tanggal'];?></td>
          <td><?= $row['keterangan'];?></td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="5">Belum ada data</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
  </body>
</html>
