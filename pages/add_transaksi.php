<?php

  session_start();
  $page = 'dashboard';

  if (!isset($_SESSION['login'])) {
    // Jika session 'login' tidak ada, redirect ke login.php
    header('Location: login.php');
    exit;
  }else{
    require_once '../functions.php';
    $nim = $_SESSION['login'];
  }

  if(isset($_POST['simpan'])){
     if(simpanTransaksi($_POST)){
        header('Location: dashboard.php?pesan=berhasil');
        exit;
     }else{
        header('Location: dashboard.php?pesan=gagal');
        exit;
     };
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body class="bg-gradasi">


<!-- Buku -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">

    <?php include '../components/sidebar.php'; ?>

    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-5">
                            <!-- Title -->
                            <h1 class="h2 ls-tight">Tambah Transaksi</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="dashboard.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-arrow-right"></i>
                                    </span>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">

                <div class="card shadow border-0 mb-7">
                <form action="" method="post" class="px-5 py-5 mt-3 mb-5">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <div>
                        <select class="selectpicker" required="" data-show-subtext="true" data-live-search="true" name="nim" >
                            <option value="">- Pilih Pengguna -</option>
                        <?php $PenggunaList = getAllinTable('user');
                                foreach ($PenggunaList as $Pengguna) {  ?>
                                    <option value="<?= $Pengguna['nim'] ?>"><?= $Pengguna['nim'] ?></option>
                        <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="buku" class="form-label">Buku</label>
                        <div>
                        <select required="" class="selectpicker" data-show-subtext="true" data-live-search="true" name="buku">
                            <option value="">- Pilih Buku -</option>
                        <?php $PenggunaList = getAllinTable('buku');
                                foreach ($PenggunaList as $Pengguna) {  ?>
                                    <option value="<?= $Pengguna['id'] ?>"><?= $Pengguna['judul'] ?></option>
                        <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" name="tgl_pinjam" required placeholder="Masukkan Tanggal Pinjam">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tgl_kembali" value="null" placeholder="Masukkan Tanggal Kembali">
                        <div class="form-text">Kosongkan jika belum dikembalikan</div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" required="" name="status">
                            <option value="">- Pilih Status -</option>
                            <option value="0">Dipinjam</option>
                            <option value="1">Dikembalikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="denda" class="form-label">Denda</label>
                        <select class="form-select" required="" name="denda">
                            <option value="">- Pilih Denda -</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn d-inline-flex btn-sm btn-primary mx-1">Simpan</button>
                </form>
                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>

