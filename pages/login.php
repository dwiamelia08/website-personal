<?php

  session_start();

  if (isset($_SESSION['login'])) {
    // Jika session 'login' ada, redirect ke dashboard.php
    header('Location: dashboard.php');
    exit;
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body class="bg-gradasi">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-10">
          <div class="card mt-5">
            <div class="card-body">
              <h3 class="card-title text-center mb-5 mt-3">Login terlebih dahulu!</h3>
              <form class="px-3" action="" method="post">
                <div class="mb-3">
                  <label for="nim" class="form-label">NIM</label>
                  <input type="nim" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM" required="">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password"  required="">
                </div>
                <div class="text-center my-4">
                  <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/main.js"></script>
  </body>
</html>


<?php

  require_once '../functions.php';
  if (isset($_POST['login'])) {
      $nim = $_POST['nim'];
      $password = $_POST['password'];
      if(isUser($nim, $password)){
          session_start();
          $_SESSION['login'] = $nim;
          header('Location: dashboard.php');
          exit;
      }else{
        ?>
        <script type="text/javascript">
          alertGagal("Periksa NIM dan Password!")
        </script>
<?php
      }
  }

?>