<?php
    error_reporting(E_ALL);
    include_once 'koneksi.php';
    if (isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $no_rumah = $_POST['no_rumah'];

        $sql = 'UPDATE warga SET ';
        $sql .= "nik = '{$nik}', nama = '{$nama}', ";
        $sql .= "jenis_kelamin = '{$jenis_kelamin}', no_hp = '{$no_hp}', alamat
        = '{$alamat}', no_rumah
        = '{$no_rumah}'";
        $sql .= "WHERE id = '{$id}'";
        $result = mysqli_query($conn, $sql);
        header('location: index.php');
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM warga WHERE id = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Error: Data tidak tersedia');
    $data = mysqli_fetch_array($result);

    function is_select($var, $val) {
        if ($var == $val) return 'selected="selected"';
        return false;
    }
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Data Warga</title>
  </head>

  <body>
    <div class="container">
      <div class="my-4 fs-2">Ubah Data Warga</div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <form method="post" action="ubah.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">NIK</label>
              <input
                type="text"
                id="nik"
                class="form-control"
                name="nik"
                value="<?php echo $data['nik'];?>"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input
                type="text"
                class="form-control"
                name="nama"
                id="nama"
                value="<?php echo $data['nama'];?>"
              />
            </div>
            <div class="mb-3">
              <label class="form-label d-block">Jenis Kelamin</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                name="jenis_kelamin" value="L"
                />
                <label class="form-check-label" for="inlineRadio1"
                  >Laki-Laki</label
                >
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                name="jenis_kelamin" value="P"
                />
                <label class="form-check-label" for="inlineRadio2"
                  >Perempuan</label
                >
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Handphone</label>
              <input
                type="text"
                class="form-control"
                name="no_hp"
                id="no_hp"
                value="<?php echo $data['no_hp'];?>"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input
                type="text"
                class="form-control"
                name="alamat"
                id="alamat"
                value="<?php echo $data['alamat'];?>"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Nomor Rumah</label>
              <input
                type="text"
                class="form-control"
                name="no_rumah"
                id="no_rumah"
                value="<?php echo $data['no_rumah'];?>"
              />
            </div>
            <div class="submit d-inline">
              <input
                type="hidden"
                name="id"
                value="<?php echo $data['id'];?>"
              />
              <input
                type="submit"
                class="btn btn-success"
                name="submit"
                value="Simpan"
              />
            </div>
            <a href="index.php" type="button" class="btn btn-danger d-inline">Batal</a>
          </form>
        </div>
        <div class="col-4"></div>
      </div>
    </div>
  </body>
</html>