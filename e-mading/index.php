<?php
session_start();
require_once 'assets/config/config.php';
$db = new db();
$db->akun();
$db->langganan();
$db->updateAdmin();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="mading,mading online,e-mading">
    <meta name="description" content="Elektronik Mading Hadir Untukmu Sekarang Juga, Buruan Coba">

    <!-- title -->
    <title>E-Mading | Elektronik Mading</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/public/vendor/css/bootstrapes.css">
    <link rel="stylesheet" href="assets/public/vendor/css/icon.css">

    <!-- aos js -->
    <link rel="stylesheet" href="assets/public/vendor/css/aos.css">

    <!-- custom css -->
    <link rel="stylesheet" href="assets/public/css/customys.css">

    <!-- flickity css -->
    <link rel="stylesheet" href="assets/public/vendor/css/fontawesome.css">

    <!-- icon -->
    <link rel="shortcut icon" href="assets/public/icon/android-chrome-192x192.png">
    <link rel="shortcut icon" href="assets/public/icon/android-chrome-512x512.png">
    <link rel="apple-touch-icon" href="assets/public/icon/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/public/icon/favicon.ico">
    <link rel="icon" href="assets/public/icon/favicon-16x16.png">
    <link rel="icon" href="assets/public/icon/favicon-32x32.png">

    <!-- tanpa resubmit -->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body class="bg-light">
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold fs-3 text-primary" href="index.php">
                <img src="assets/public/img/logo.png" width="150">
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pb-2 pb-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mx-lg-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-bold <?= @$_GET["page"] ? '' : 'active'; ?> me-3" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= @$_GET["page"] === "berita" ? 'active' : ''; ?> me-3" href="?page=berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= @$_GET["page"] === "mading" ? 'active' : ''; ?> me-3" href="?page=mading">Mading</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php
                    if (isset($_SESSION["login"])) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION["username"] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end mt-lg-3 border-0 shadow">
                                <li><a class="dropdown-item" href="assets/admin/index.php?page=profil">Profil</a></li>
                                <li><a class="dropdown-item" href="assets/admin/index.php">Dasbor</a></li>
                                <li><a class="dropdown-item" href="?page=keluar">Keluar</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <?php
                if (!isset($_SESSION["login"])) {
                ?>
                    <a href="?page=masuk" class="btn btn-primary border-2 px-4 rounded-pill me-2">Masuk</a>
                <?php
                } ?>
            </div>
        </div>
    </nav>
    <?php
    $page = @$_GET["page"];
    switch ($page) {
        case 'berita':
            include 'layouts/berita.php';
            break;
        case 'mading':
            include 'layouts/mading.php';
            break;
        case 'masuk':
            include 'layouts/masuk.php';
            break;
        case 'daftar':
            include 'layouts/daftar.php';
            break;
        case 'keluar':
            include 'layouts/keluar.php';
            break;

        default:
            include 'layouts/beranda.php';
            break;
    }
    ?>
    <!-- footer -->
    <footer class="bg-white mt-auto py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1300">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- logo -->
                            <a href="index.php" class="text-decoration-none display-5 fw-bold">
                                <img src="assets/public/img/logo.png" class="my-3" width="150">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="fw-semibold border-start border-5 border-primary ps-2 my-3">Halaman</h3>
                            <ul class="list mb-lg-3">
                                <li><a href="index.php" class="text-decoration-none text-secondary"><i class="bi bi-link-45deg me-2"></i>Beranda</a></li>
                                <li><a href="?page=berita" class="text-decoration-none text-secondary"><i class="bi bi-link-45deg me-2"></i>Berita</a></li>
                                <li><a href="?page=mading" class="text-decoration-none text-secondary"><i class="bi bi-link-45deg me-2"></i>Mading</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1300">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="fw-semibold border-start border-5 border-primary ps-2 my-3">Kontak</h3>
                            <ul class="list mb-lg-3">
                                <li><a href="https://www.instagram.com/mamalikhsani/" class="text-decoration-none text-secondary"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
                                <li><a href="https://wa.me/6281929825753" class="text-decoration-none text-secondary"><i class="bi bi-whatsapp me-2"></i>Whatsapp</a></li>
                                <li><a href="https://www.facebook.com/profile.php?id=100008388078246" class="text-decoration-none text-secondary"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="fw-semibold border-start border-5 border-primary ps-2 my-3">Langganan</h3>
                            <p class="text-secondary">Langganan <a href="index.php" class="text-decoration-none">E-Mading</a>.</p>
                            <!-- langganan -->
                            <form action="" method="post" class="d-flex rounded-pill border-2">
                                <input required type="email" name="email" class="form-control border-primary shadow-none rounded-0 rounded-end rounded-pill ps-3" placeholder="Email">
                                <button type="submit" name="langganan" class="btn btn-primary rounded-0 rounded-start rounded-pill py-0 pe-3"><i class="bi bi-send-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer class="bg-primary py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-white">
                    <p class="text-center mb-0">Copyright &copy; 2022 By E-Mading.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- bootstrap js -->
    <script src="assets/public/vendor/js/bootstrap.js"></script>

    <!-- aos js -->
    <script src="assets/public/vendor/js/aos.js"></script>

    <!-- custom js -->
    <script src="assets/public/js/custom.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
    <script src='//fw-cdn.com/2113977/2827094.js' chat='true'>
    </script>
</body>

</html>