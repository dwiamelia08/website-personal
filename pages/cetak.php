<?php

  session_start();
  $page = 'profil';

  if (!isset($_SESSION['login'])) {
    // Jika session 'login' tidak ada, redirect ke login.php
    header('Location: login.php');
    exit;
  }else{
    require_once '../functions.php';
    $nim = $_SESSION['login'];
  }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body>

  <main class="py-6 bg-surface-secondary">
    <div class="container-fluid">
        <div class="card shadow border-0 mb-7">
            <?php 
            $mahasiswa = getDataFromId('user', $nim);
            ?>
            <form class="px-5 py-5 mt-3 mb-5" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $nim ?>">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <img id="preview" src="<?php if($mahasiswa['img'] !== null) {
                                echo '../assets/img/profil/'.$mahasiswa['img'];
                            }else{
                                echo '../assets/img/def.jpg';
                            } ?>" alt="Gambar Profil" width="200">
                            <input type="file" id="gambar" class="form-control mt-5" name="gambar">
                            <div class="mt-4"><i>Kosongi jika tidak ingin diubah!</i></div>
                        </div>
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" value="<?= $mahasiswa['nim'] ?>" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $mahasiswa['nama'] ?>" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" name="jenis_kelamin" required disabled>
                                    <option value="Laki-laki" <?php if ($mahasiswa['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if ($mahasiswa['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" name="telepon" value="<?= $mahasiswa['telepon'] ?>" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $mahasiswa['alamat'] ?>" required disabled>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" required disabled>
                                    <option value="0" <?php if ($mahasiswa['status'] == '0') echo 'selected'; ?>>User</option>
                                    <option value="1" <?php if ($mahasiswa['status'] == '1') echo 'selected'; ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
    <script type="text/javascript">
        window.print();
    </script>
  </body>
</html>