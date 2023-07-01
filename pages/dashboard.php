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

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body class="bg-gradasi">


<!-- Dashboard -->
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
                            <h1 class="h2 ls-tight">Dashboard</h1>
                        </div>
                        <!-- Actions -->
                        <?php if(isAdmin($nim)){ ?>
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="add_transaksi.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Tambah</span>
                                </a>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="daftar_buku.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-book"></i>
                                    </span>
                                    <span>Daftar Buku</span>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <?php if(isAdmin($nim)){ ?>
                <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Buku</span>
                                        <span class="h3 font-bold mb-0"><?= jmlDataTable('buku') ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Pengguna</span>
                                        <span class="h3 font-bold mb-0"><?= jmlDataTable('user') ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Dipinjam</span>
                                        <span class="h3 font-bold mb-0"><?= jmlDataTableMinjam('0') ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Dikembalikan</span>
                                        <span class="h3 font-bold mb-0"><?= jmlDataTableMinjam('1') ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                            <i class="bi bi-bookmark-check-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="card shadow border-0 mb-7">
                    <!-- <div class="card-header">
                        <h5 class="mb-0">Applications</h5>
                    </div> -->
        <?php if(isAdmin($nim)){

                if(jmlDataTable('transaksi') == 0){
        ?>
                    <div class="table-responsive">
                    <table class="table table-hover table-nowrap my-4">
                        <tbody>
                            <tr>
                                <td class="text-center fs-5 fw-bold" style="border: none;">Belum ada peminjaman</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
        <?php }else{ ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead style="background-color: #b3ccff;">
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Buku</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col" class="text-center">Denda</th>
                                    <th scope="col" class="text-center">Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $minjamList = getAllinTable('transaksi');
                                foreach ($minjamList as $minjam) { 
                                    $user = getDataFromId('user', $minjam['nim']);
                                    $buku = getDataFromId('buku', $minjam['id_buku']);
                                    ?>
                                    <tr>
                                        <td><?= $user['nim'] ?></td>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $buku['judul'] ?></td>
                                        <td><?= ($minjam['status'] == '0') ? 'Dipinjam' : 'Dikembalikan' ?></td>
                                        <td><?= tglIndo($minjam['tgl_pinjam']) ?></td>
                                        <td><?= ($minjam['tgl_kembali']) ? tglIndo($minjam['tgl_kembali']) : '-' ?></td>
                                        <td class="text-center"><?= ($minjam['denda'] == '0') ? '<i class="bi bi-x-circle-fill"></i>' : '<i class="bi bi-check-circle-fill"></i>' ?></td>
                                        <td class="text-center"><div class="mx-n1">
                                                <a href="edit_transaksi.php?id=<?= $minjam['id'] ?>" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                                    <span>
                                                        <i class="bi bi-pencil"></i>
                                                    </span>
                                                </a>
                                                <a href="hapus.php?transaksi=<?= $minjam['id'] ?>" class="btn d-inline-flex btn-sm btn-danger mx-1">
                                                    <span>
                                                        <i class="bi bi-trash"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
        <?php } ?>
    <?php }else{ 
                    if(jmlDataInUser($nim) == 0){
        ?>
                    <div class="table-responsive">
                    <table class="table table-hover table-nowrap my-4">
                        <tbody>
                            <tr>
                                <td class="text-center fs-5 fw-bold" style="border: none;">Belum ada buku yang anda pinjam</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
        <?php }else{ ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead style="background-color: #b3ccff;">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Buku</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col" class="text-center">Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $minjamList = getAllinUserWith($nim);
                                foreach ($minjamList as $minjam) { 
                                    $user = getDataFromId('user', $minjam['nim']);
                                    $buku = getDataFromId('buku', $minjam['id_buku']);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $buku['judul'] ?></td>
                                        <td><?= ($minjam['status'] == '0') ? 'Dipinjam' : 'Dikembalikan' ?></td>
                                        <td><?= tglIndo($minjam['tgl_pinjam']) ?></td>
                                        <td><?= ($minjam['tgl_kembali']) ? tglIndo($minjam['tgl_kembali']) : '-' ?></td>
                                        <td class="text-center"><?= ($minjam['denda'] == '0') ? '<i class="bi bi-x-circle-fill"></i>' : '<i class="bi bi-check-circle-fill"></i>' ?></td>
                                    </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
        <?php }  } ?>
                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>


<?php


    if (!empty($_GET['pesan'])) {
        if ($_GET['pesan'] == 'berhasil') {
             ?>
             <script type="text/javascript">
                 alertBerhasil('Data berhasil disimpan')
             </script>
            <?php 
        }else{
            ?>
            <script type="text/javascript">
                 alertGagal('Data gagal disimpan')
             </script>
            <?php 
        }
    }



    if (!empty($_GET['hapus'])) {
        if ($_GET['hapus'] == 'berhasil') {
             ?>
             <script type="text/javascript">
                 alertBerhasil('Data berhasil dihapus')
             </script>
            <?php 
        }else{
            ?>
            <script type="text/javascript">
                 alertGagal('Data gagal dihapus')
             </script>
            <?php 
        }
    }


?>