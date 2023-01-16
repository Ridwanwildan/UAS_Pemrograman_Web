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
    <title>Data Warga Yang Belum Bayar</title>
</head>
<body>
    <div class="container">
        <div class="my-4 fs-2 d-block">Data Warga Yang Belum Bayar</div>
        <form action="laporan.php" method="GET" enctype="multipart/form-data">
          <div class="row justify-content-start mb-4">

            <div class="col-2">
              <select class="form-select" name="tahun_bulan" aria-label="Default select example">
                <option selected>Pilih Bulan</option>
                <?php
                include "koneksi.php";
                $query = mysqli_query($conn, "SELECT DATE_FORMAT(tanggal, '%Y-%m') as tahun_bulan FROM iuran GROUP BY tahun_bulan");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$data['tahun_bulan'];?>"><?php echo $data['tahun_bulan'];?></option>
                <?php
                }
                ?>
              </select>
            </div>

            <div class="col-2">
              <select class="form-select" name="jenis_iuran" aria-label="Default select example">
                <option selected>Pilih Jenis Iuran</option>
                <?php
                include "koneksi.php";
                $query = mysqli_query($conn, "SELECT jenis_iuran FROM iuran GROUP BY jenis_iuran ORDER BY jenis_iuran");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$data['jenis_iuran'];?>"><?php echo $data['jenis_iuran'];?></option>
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
                <th>No</th>
                <th>Nama</th>
            </tr>
            <?php
            include "koneksi.php";
            if (isset($_GET['tahun_bulan']) && isset($_GET['jenis_iuran'])) {
              $tahun_bulan = $_GET['tahun_bulan'];
              $jenis_iuran = $_GET['jenis_iuran'];
              $sql = "SELECT w.nama ";
              $sql .= "FROM warga w ";
              $sql .= "LEFT JOIN iuran i ON w.id = i.warga_id ";
              $sql .= "AND DATE_FORMAT(i.tanggal, '%Y-%m') = '{$tahun_bulan}' ";
              $sql .= "AND i.jenis_iuran = '{$jenis_iuran}' ";
              $sql .= "WHERE i.id IS NULL";
              $result=mysqli_query($conn, $sql);
              $no=0;
              while ($row = mysqli_fetch_array($result)) {
              $no++;
              ?>
            <tbody>
                <tr class="text-center">
                    <td><?php echo $no;?></td>
                    <td><?php echo $row['nama'];?></td>
                </tr>
            </tbody>
            <?php
                }
              }
            ?>
        </table>
    </div>
</body> 
</html>