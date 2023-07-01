<?php

  session_start();
  $page = 'bukus';

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
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function terpinjam() {
            Swal.fire(
              'Gagal!',
              'Buku sudah dipinjam dan belum dikembalikan',
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
                                <a href="dashboard.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    Koleksi Buku ( <?= jmlDataInUser($nim) ?> )
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
                        <div class="row g-6 mb-6">
                                <?php 
                                $bukuList = getAllinTable('buku');
                                foreach ($bukuList as $buku) { 
                                ?>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow border-0" style="min-height: 200px;">
                                        <div class="card-body" style="background-color:<?= generateSoftColorHex() ?>;">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="h3 font-semibold d-block mb-2 text-white"><?= $buku['judul'] ?></span>
                                                    <small class="text-white"><?= $buku['penerbit'].' ('.$buku['tahun'].')' ?></small>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="text-white">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                     <a href="
                                                     <?php
                                                     if(cekBukuInTransaksi($nim, $buku['id']) > 0){
                                                        echo '#';
                                                         }else{ ?>
                                                     pinjam.php?id=<?= $buku['id'] ?>
                                                    <?php } ?>" name="simpan" class="btn btn-sm btn-primary d-inline-flex mt-3"
                                                    <?php
                                                     if(cekBukuInTransaksi($nim, $buku['id']) > 0){ ?>
                                                    onclick="terpinjam()"
                                                    <?php } ?>
                                                    >Pinjam</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
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