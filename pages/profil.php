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
    $gambar = $_FILES['gambar'];
    if(ubahUser($_POST, $gambar)){
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
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function ubahBio(){
            // Menyembunyikan elemen dengan id "ubah" dengan menambahkan kelas "d-none"
            document.getElementById("ubah").classList.add("d-none");
            document.getElementById("profil1").classList.add("d-none");
            document.getElementById("profil2").classList.remove("d-none");

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
                            <h1 class="h2 ls-tight">Profil</h1>
                        </div>
                        <div class="col-sm-6 col-12 text-sm-end mb-4">
                            <div class="mx-n1">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="ganti_sandi.php" class="btn d-inline-flex btn-sm btn-outline-primary">Ganti Sandi</a>
                                  <a href="cetak.php" class="btn d-inline-flex btn-sm btn-outline-primary">Cetak Kartu</a>
                                </div>
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
                 <form class="px-5 py-5 mt-3 mb-5" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $nim ?>">
                <div class="mb-3 d-none" id="profil2">
                    <div class="row justify-content-center">
                        <div class="col-6 text-center">
                            <img id="preview" src="<?php if($mahasiswa['img'] !== null) {
                                echo '../assets/img/profil/'.$mahasiswa['img'];
                            }else{
                                echo '../assets/img/def.jpg';
                            } ?>" alt="Gambar Profil" width="200">
                        </div>
                        <div class="col-6 text-center">
                            <input type="file" id="gambar" class="form-control mt-5" name="gambar">
                            <div class="mt-4"><i>Kosongi jika tidak ingin diubah!</i></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-center" id="profil1">
                            <img src="<?php if($mahasiswa['img'] !== null) {
                                echo '../assets/img/profil/'.$mahasiswa['img'];
                            }else{
                                echo '../assets/img/def.jpg';
                            } ?>" alt="Gambar Profil" width="200">
                  </div>
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
                
                <button onclick="ubahBio()" type="button" id="ubah" class="btn d-inline-flex btn-sm btn-primary mx-1 w-100" style="display: flex; justify-content: center;">
                  Ubah Biodata
                </button>

                <button type="submit" name="simpan" id="simpan" class="btn d-inline-flex btn-sm btn-success mx-1 w-100 d-none" style="display: flex; justify-content: center;">Simpan Biodata</button>
            </form>


                </div>
            </div>
        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
    <script type="text/javascript">
        // Ambil referensi elemen input file
        var inputGambar = document.getElementById('gambar');

        // Tambahkan event listener ketika gambar dipilih
        inputGambar.addEventListener('change', function(event) {
          var file = event.target.files[0]; // Ambil file yang dipilih

          // Validasi apakah file yang dipilih adalah gambar
          if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();

            // Event listener ketika file selesai dibaca
            reader.addEventListener('load', function(event) {
              var imgPreview = document.getElementById('preview');
              imgPreview.src = event.target.result; // Set nilai src gambar preview dengan data URL gambar yang telah dibaca
            });

            // Baca file sebagai URL data
            reader.readAsDataURL(file);
          }
        });

    </script>
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