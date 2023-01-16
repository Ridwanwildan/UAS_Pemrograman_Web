<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <title>Data Jumlah Kas</title>
</head>
<body>
    <div class="container">
        <div class="my-4 fs-2 d-block">Data Jumlah Kas</div>
        <form action="jumlah_kas.php" method="GET" enctype="multipart/form-data">
          <div class="row justify-content-start mb-4">

            <div class="col-2">
              <select class="form-select" name="tahun" aria-label="Default select example">
                <option selected>Pilih Tahun</option>
                <?php
                include "koneksi.php";
                $query = mysqli_query($conn, "SELECT DATE_FORMAT(tanggal, '%Y') as tahun FROM iuran GROUP BY tahun");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$data['tahun'];?>"><?php echo $data['tahun'];?></option>
                <?php
                }
                ?>
              </select>
            </div>

            <div class="col-1 ">
              <input type="submit" id="submit" class="btn btn-primary px-4 me-1" name="submit" value="Cari"/>
            </div>

            <div class="col-1">
              <a href="index.php" type="button" class="btn btn-success">Kembali</a>
            </div>

            <div class="col-6"></div>
            
          </div>
        </form>
        <table class="table table-hover">
            <tr class="text-center">
                <th>Bulan</th>
                <th>Uang Kas</th>
                <th>Uang Sampah</th>
                <th>Sumbangan</th>
                <th>Total</th>
            </tr>
            <?php
            $tahun = NULL;
            if (isset($_GET['tahun'])) {
              $tahun = $_GET['tahun'];
              $sql = "SELECT DATE_FORMAT(tanggal, '%Y-%m') AS tahun_bulan, nominal, jenis_iuran ";
              $sql .= "FROM iuran ";
              $sql .= "WHERE DATE_FORMAT(tanggal, '%Y') = '{$tahun}' ";
              $sql .= "GROUP BY tahun_bulan";
              $result=mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) {
              ?>
            <tbody>
              <tr class="text-center">
                <td><?php echo $row['tahun_bulan'];?></td>
                <td>
                  <?php
                    $sql = "SELECT SUM(nominal) AS jumlah_nominal FROM iuran WHERE DATE_FORMAT(tanggal, '%Y-%m') = '{$row['tahun_bulan']}' AND jenis_iuran = 1";
                    $result2 = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result2);
                  ?>
                    Rp.<?php echo number_format($data['jumlah_nominal'], 2, ",", ".");?>,-
                </td>
                <td>
                  <?php
                    $sql = "SELECT SUM(nominal) AS jumlah_nominal FROM iuran WHERE DATE_FORMAT(tanggal, '%Y-%m') = '{$row['tahun_bulan']}' AND jenis_iuran = 2";
                    $result2 = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result2);
                    ?>
                    Rp.<?php echo number_format($data['jumlah_nominal'], 2, ",", ".");?>,-
                </td>
                <td>
                  <?php
                    $sql = "SELECT SUM(nominal) AS jumlah_nominal FROM iuran WHERE DATE_FORMAT(tanggal, '%Y-%m') = '{$row['tahun_bulan']}' AND jenis_iuran = 3";
                    $result2 = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result2);
                  ?>
                    Rp.<?php echo number_format($data['jumlah_nominal'], 2, ",", ".");?>,-
                </td>
                <td>
                  <?php
                    $sql = "SELECT SUM(nominal) AS total_nominal FROM iuran WHERE DATE_FORMAT(tanggal, '%Y-%m') = '{$row['tahun_bulan']}' AND (jenis_iuran = 1 OR jenis_iuran = 2 OR jenis_iuran = 3)";
                    $result2 = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result2);
                  ?>
                    Rp.<?php echo number_format($data['total_nominal'], 2, ",", ".");?>,-
                </td>
              </tr>
            </tbody>
            <?php
                }
              }
            ?>
            <tbody>
              <tr class="text-center fw-bolder">
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <?php
                    $sql = "SELECT SUM(nominal) AS total_nominal FROM iuran WHERE DATE_FORMAT(tanggal, '%Y') = '{$tahun}' AND (jenis_iuran = 1 OR jenis_iuran = 2 OR jenis_iuran = 3)";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_assoc($result);
                  ?>
                    Rp.<?php echo number_format($data['total_nominal'], 2, ",", ".");?>,-
                </td>
              </tr>
          </tbody>
        </table>
    </div>
</body>
</html>