<?php

  session_start();
  $page = 'buku';

  if (!isset($_SESSION['login'])) {
    // Jika session 'login' tidak ada, redirect ke login.php
    header('Location: login.php');
    exit;
  }else{
    require_once '../functions.php';
    $nim = $_SESSION['login'];
    if (!isAdmin($nim)) {
        header('Location: dashboard.php');
        exit;
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function terpakai() {
            Swal.fire(
              'Gagal!',
              'Data digunakan untuk peminjaman',
              'info'
            )
        }
    </script>
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
                            <h1 class="h2 ls-tight">Data Buku</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="add_buku.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="bi bi-plus"></i>
                                    </span>
                                    <span>Tambah</span>
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
        <?php 
                    if(jmlDataTable('buku') == 0){
        ?>
                    <div class="table-responsive">
                    <table class="table table-hover table-nowrap my-4">
                        <tbody>
                            <tr>
                                <td class="text-center fs-5 fw-bold" style="border: none;">Belum ada buku</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
        <?php }else{ ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead style="background-color: #b3ccff;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Penerbit</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col" class="text-center">Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $bukuList = getAllinTable('buku');
                                foreach ($bukuList as $buku) { 
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $buku['judul'] ?></td>
                                        <td><?= $buku['penerbit'] ?></td>
                                        <td><?= $buku['tahun'] ?></td>
                                        <td><?= tglIndo($buku['tgl_masuk']) ?></td>
                                        <td class="text-center"><div class="mx-n1">
                                                <a href="edit_buku.php?id=<?= $buku['id'] ?>" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                                    <span>
                                                        <i class="bi bi-pencil"></i>
                                                    </span>
                                                </a>
                                                <a href="
                                                <?php 
                                                    if(!cekInTransaksi('buku', $buku['id'])){
                                                ?>
                                                hapus.php?buku=<?= $buku['id'] ?>
                                            <?php }else{
                                                echo '#';
                                            } ?>
                                                " class="btn d-inline-flex btn-sm btn-danger mx-1"

                                                <?php if(cekInTransaksi('buku', $buku['id'])){ ?>
                                                    onclick="terpakai()"
                                                <?php } ?>
                                                >
                                                    <span>
                                                        <i class="bi bi-trash"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
        <?php } ?>
                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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