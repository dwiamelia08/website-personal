<!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-auto ms-auto" href="#">
                <img src="../assets/img/logo.png" alt="...">
            </a>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'dashboard') ? 'aktif' : '' ?>" href="dashboard.php">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                <?php if(isAdmin($nim)){ ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'buku') ? 'aktif' : '' ?>" href="buku.php">
                            <i class="bi bi-book"></i> Data Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'pengguna') ? 'aktif' : '' ?>" href="pengguna.php">
                            <i class="bi bi-people"></i> Data Pengguna
                        </a>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'bukus') ? 'aktif' : '' ?>" href="daftar_buku.php">
                            <i class="bi bi-book"></i> Buku
                        </a>
                    </li>
                <?php } ?>
                </ul>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'profil') ? 'aktif' : '' ?>" href="profil.php">
                            <i class="bi bi-person-square"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>