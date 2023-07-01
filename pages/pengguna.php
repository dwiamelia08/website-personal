<?php

  session_start();
  $page = 'pengguna';

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
    <title>Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function terpakai() {
            Swal.fire(
              'Gagal!',
              'Data digunakan untuk peminjaman<br>(Tidak dapat menghapus akun anda sendiri)',
              'info'
            )
        }

        function terpakaiGanti(isi, el) {
            Swal.fire(
              'Gagal!',
              'Data digunakan untuk peminjaman<br>(Tidak dapat menghapus akun anda sendiri)',
              'info'
            )
            el.value = isi
        }

        function ubahStatus(val, id) {
            window.location.href = "editStatus.php?status="+val.value+"&&id="+id;
        }
    </script>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body class="bg-gradasi">


<!-- Pengguna -->
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
                            <h1 class="h2 ls-tight">Data Pengguna</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="add_user.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
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
                    if(jmlDataTable('user') == 0){
        ?>
                    <div class="table-responsive">
                    <table class="table table-hover table-nowrap my-4">
                        <tbody>
                            <tr>
                                <td class="text-center fs-5 fw-bold" style="border: none;">Belum ada pengguna</td>
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
                                    <th scope="col">Gender</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $PenggunaList = getAllinTable('user');
                                foreach ($PenggunaList as $Pengguna) { 
                                ?>
                                    <tr>
                                        <td><?= $Pengguna['nim'] ?></td>
                                        <td><?= $Pengguna['nama'] ?></td>
                                        <td><?= $Pengguna['jenis_kelamin'] ?></td>
                                        <td><?= $Pengguna['telepon'] ?></td>
                                        <td><?= $Pengguna['alamat'] ?></td>
                                        <td>
                                            <?php $id = $Pengguna['nim']; ?>
                                            <select class="form-select"  <?php if(cekInTransaksi('user', $Pengguna['nim']) OR $Pengguna['nim'] == $nim){ ?>
                                                    onchange="terpakaiGanti('<?= $Pengguna['status'] ?>', this)"
                                                <?php }else{ ?>onchange="ubahStatus(this, '<?= $id ?>')" <?php } ?>>
                                                <option value="0" <?= ($Pengguna['status'] == '0') ? 'selected' : '' ?>>User</option>
                                                <option value="1" <?= ($Pengguna['status'] == '1') ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                        </td>
                                        <td class="text-center"><div class="mx-n1">
                                                <a href="
                                                <?php 
                                                    if(!cekInTransaksi('user', $Pengguna['nim']) && $Pengguna['nim'] !== $nim){
                                                ?>
                                                hapus.php?user=<?= $Pengguna['nim'] ?>
                                            <?php }else{ echo '#'; } ?>
                                                " class="btn d-inline-flex btn-sm btn-danger mx-1"
                                                <?php if(cekInTransaksi('user', $Pengguna['nim']) OR $Pengguna['nim'] == $nim){ ?>
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
                                <?php  } ?>
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
    <script type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>



<?php 


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



 ?>