<?php
    error_reporting(E_ALL);
    include_once 'koneksi.php';
    $id = $_GET['id'];
    if (isset($_POST['submit']))
    {
        $warga_id = $_POST['warga_id'];
        $jenis_iuran = $_POST['jenis_iuran'];
        $nominal = $_POST['nominal'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $sql = 'INSERT INTO iuran (warga_id, jenis_iuran, nominal, tanggal, keterangan) ';
        $sql .= "VALUE ('{$warga_id}', '{$jenis_iuran}', '{$nominal}', '{$tanggal}','{$keterangan}')";
        $result = mysqli_query($conn, $sql);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Tambah Iuran</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <form method="post" action="tambah_iuran.php" enctype="multipart/form-data">
            <div class="mb-3">
              <input
                type="hidden"
                class="form-control"
                name="warga_id"
                id="warga_id"
                value="<?php echo $id;?>"
              />
            </div>
            <div class="mb-3">
              <label class="form-label d-block">Jenis Iuran</label>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jenis_iuran"
                  value="1"
                />
                <label class="form-check-label" for="inlineRadio1"
                  >Uang Kas</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jenis_iuran"
                  value="2"
                />
                <label class="form-check-label" for="inlineRadio2"
                  >Uang Sampah</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="jenis_iuran"
                  value="3"
                />
                <label class="form-check-label" for="inlineRadio2"
                  >Sumbangan</label
                >
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Nominal</label>
              <input type="number" class="form-control" name="nominal" id="nominal" />
            </div>
            <div class="mb-3">
              <label class="form-label">Tanggal Pembayaran</label>
              <input
                type="date"
                class="form-control"
                name="tanggal"
                id="tanggal"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Keterangan</label>
              <input
                type="text"
                class="form-control"
                name="keterangan"
                id="keterangan"
              />
            </div>
            <div class="submit d-inline">
              <input
                type="submit"
                class="btn btn-success"
                name="submit"
                value="Simpan"
              />
            </div>
            <a href="index.php" type="button" class="btn btn-danger">Batal</a>
          </form>
        </div>
        <div class="col-4"></div>
      </div>
    </div>
  </body>
</html>
