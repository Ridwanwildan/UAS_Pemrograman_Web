<?php
    include("koneksi.php");
    // query untuk menampilkan data
    $counter = 1;
    $i = 0;
    $sql = 'SELECT id, nik, nama, jenis_kelamin, no_hp, alamat, no_rumah FROM warga';
    $result = mysqli_query($conn, $sql);
?>

<?php
  $limit = 10; // jumlah data yang akan ditampilkan per halaman
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // nomor halaman saat ini
  $offset = ($page - 1) * $limit; // offset untuk query SELECT
  
  $sql = "SELECT id, nik, nama, jenis_kelamin, no_hp, alamat, no_rumah FROM warga LIMIT {$limit} OFFSET {$offset}";
  $result2 = mysqli_query($conn, $sql);
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
    <title>IURAN KAS RT005/003</title>
  </head>

  <body>
    <div class="container">
      <div class="my-4 fs-2 d-block">Data Warga RT005/003</div>
      <a href="tambah.php" type="button" class="btn btn-success mb-4 d-inline">Tambah Data</a>
      <a href="laporan.php" type="button" class="btn btn-primary mb-4">Data Yang Belum Bayar</a>
      <a href="jumlah_kas.php" type="button" class="btn btn-secondary mb-4">Jumlah Kas</a>
      <table class="table table-hover table-striped">
        <tr class="text-center">
          <th>No</th>
          <th>NIK</th>
          <th>Nama Warga</th>
          <th>Jenis Kelamin</th>
          <th>Nomor HP</th>
          <th>Alamat</th>
          <th>Nomor Rumah</th>
          <th></th>
        </tr>

        <?php if($result): ?>
        <?php $counter = 1; // variabel counter untuk nomor baris ?>
        <?php while($row = mysqli_fetch_array($result)): ?>
        <tr class="text-center">
          <td><?php echo $counter; ?></td>
          <td><?= $row['nik'];?></td>
          <td><?= $row['nama'];?></td>
          <td><?= $row['jenis_kelamin'];?></td>
          <td><?= $row['no_hp'];?></td>
          <td><?= $row['alamat'];?></td>
          <td><?= $row['no_rumah'];?></td>
          <td>
              <div>
                <a
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                <i class="bi bi-three-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="ubah.php?id=<?php echo $row['id'];?>">Ubah Data</a></li>
                  <li>
                    <a class="btn dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'];?>">
                      Hapus Data
                    </a>
                  </li>
                  <li><a class="dropdown-item" href="data_iuran.php?id=<?php echo $row['id'];?>">Lihat Transaksi Iuran</a></li>
                  <li><a class="dropdown-item" href="tambah_iuran.php?id=<?php echo $row['id'];?>">Tambah Transaksi Iuran</a></li>
                </ul>
              </div>
            </td>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data?</p>
                    <div class="float-end">
                      <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Batal</button>
                      <a class="btn btn-danger" href="hapus.php?id=<?php echo $row['id'];?>">Hapus</a>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
        </tr>
        <?php $counter++; // menambahkan nilai counter ?>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="6">Belum ada data</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
  </body>
</html>
