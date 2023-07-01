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


  if(isset($_POST['simpan'])){
    if(ubahPass($_POST)){
         header('Location: profil.php?pesan=berhasil');
        exit;
     }else{
        header('Location: profil.php?pesan=gagal');
        exit;
     };
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function ubahBio(){
            // Menyembunyikan elemen dengan id "ubah" dengan menambahkan kelas "d-none"
            document.getElementById("ubah").classList.add("d-none");

            // Menampilkan elemen dengan id "simpan" dengan menghilangkan kelas "d-none"
            document.getElementById("simpan").classList.remove("d-none");

            // Mengaktifkan semua elemen input dengan mengatur properti disabled menjadi false
            var inputElements = document.getElementsByTagName("input");
            for(var i=0; i<inputElements.length; i++){
                if (inputElements[i].id !== "nim") {
                    inputElements[i].disabled = false;
                }
            }

            var selectElements = document.getElementsByTagName("select");
            for(var i=0; i<selectElements.length; i++){
                selectElements[i].disabled = false;
            }
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
                            <h1 class="h2 ls-tight">Ganti Password</h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <a href="profil.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
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
                <?php 
                    $mahasiswa = getDataFromId('user', $nim);
                 ?>
                 <form class="px-5 py-5 mt-3 mb-5" action="" method="post">
                    <input type="hidden" name="id" value="<?= $nim ?>">
                <div class="mb-3">
                    <label for="lama" class="form-label">Password Lama</label>
                    <input type="text" class="form-control" name="lama" required placeholder="Masukkan Password Lama">
                </div>
                <div class="mb-3">
                    <label for="baru" class="form-label">Password Baru</label>
                    <input type="text" class="form-control" name="baru" required placeholder="Masukkan Password Baru">
                </div>

                <button type="submit" name="simpan" id="simpan" class="btn d-inline-flex btn-sm btn-success mx-1 w-100" style="display: flex; justify-content: center;">Simpan Biodata</button>
            </form>


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

?>