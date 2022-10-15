<?php
session_start();
require_once '../config/config.php';
$db = new db();
if (!isset($_SESSION["login"])) {
    echo "<script>location='../.././'</script>";
}
$db->tambahBerita($_SESSION["id"]);
$db->tambahMading($_SESSION["id"]);
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
    <link rel="stylesheet" href="../../assets/public/vendor/css/bootstrapes.css">
    <link rel="stylesheet" href="../../assets/public/vendor/css/icon.css">

    <!-- aos js -->
    <link rel="stylesheet" href="../../assets/public/vendor/css/aos.css">

    <!-- custom css -->
    <link rel="stylesheet" href="../../assets/public/css/customys.css">

    <!-- flickity css -->
    <link rel="stylesheet" href="../../assets/public/vendor/css/fontawesome.css">

    <!-- icon -->
    <link rel="shortcut icon" href="../../assets/public/icon/android-chrome-192x192.png">
    <link rel="shortcut icon" href="../../assets/public/icon/android-chrome-512x512.png">
    <link rel="apple-touch-icon" href="../../assets/public/icon/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../assets/public/icon/favicon.ico">
    <link rel="icon" href="../../assets/public/icon/favicon-16x16.png">
    <link rel="icon" href="../../assets/public/icon/favicon-32x32.png">

    <!-- datatables -->
    <script src="../../assets/public/vendor/js/jquery.js"></script>
    <link rel="stylesheet" href="../../assets/public/vendor/css/datatable.css">
    <link rel="stylesheet" href="../../assets/public/vendor/css/button.css">
    <script src="../../assets/public/vendor/js/datatables.js"></script>

    <!-- tanpa resubmit -->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body class="bg-light">
    <div class="row mx-0">
        <!-- header -->
        <nav class="col-12 navbar navbar-expand-lg bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-semibold fs-3 text-primary me-auto" href="index.php">
                    <img src="../../assets/public/img/logo.png" width="150">
                </a>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= ucfirst($_SESSION["username"]) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-lg-3 border-0 shadow">
                            <li><a class="dropdown-item" href="?page=profil">Profil</a></li>
                            <li><a class="dropdown-item" href="../../index.php">Website</a></li>
                            <li><a class="dropdown-item" href="?page=keluar">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- dua bagian -->
        <div class="col-lg-2 card bg-white border-0 rounded-0 p-0 min-vh-100 shadow-sm d-lg-block d-none">
            <div class="list-group list-group-flush rounded-0">
                <a href="index.php" class="list-group-item border-0 list-group-item-action mb-2  <?= @$_GET["page"] ? '' : 'active'; ?>"><i class="bi bi-house-door me-3"></i>Dasbor</a>
                <?php
                if (isset($_SESSION["admin"])) {
                ?>
                    <a href="?page=pengguna" class="list-group-item border-0 list-group-item-action mb-2 <?= @$_GET["page"] === "pengguna" ? 'active' : ''; ?>"><i class="bi bi-people me-3"></i>Pengguna</a>
                <?php
                }
                ?>
                <a href="?page=berita" class="list-group-item border-0 list-group-item-action mb-2 <?= @$_GET["page"] === "berita" ? 'active' : ''; ?>"><i class="bi bi-envelope-paper me-3"></i>Berita</a>
                <a href="?page=mading" class="list-group-item border-0 list-group-item-action mb-2 <?= @$_GET["page"] === "mading" ? 'active' : ''; ?>"><i class="bi bi-archive me-3"></i>Mading</a>
                <a href="?page=profil" class="list-group-item border-0 list-group-item-action mb-2 <?= @$_GET["page"] === "profil" ? 'active' : ''; ?>"><i class="bi bi-person me-3"></i>Profil</a>
            </div>
        </div>
        <div class="col-lg-10 card bg-transparent border-0 rounded-0 p-3 p-lg-5 min-vh-100">
            <?php
            $page = @$_GET["page"];
            switch ($page) {
                case 'berita':
                    include 'layouts/berita.php';
                    break;
                case 'mading':
                    include 'layouts/mading.php';
                    break;
                case 'pengguna':
                    include 'layouts/pengguna.php';
                    break;
                case 'profil':
                    include 'layouts/profil.php';
                    break;
                case 'keluar':
                    include 'layouts/keluar.php';
                    break;

                default:
                    include 'layouts/dasbor.php';
                    break;
            }
            ?>
            <hr>
            <p class="text-center text-secondary my-2">Copyright &copy; 2022 By E-Mading.</p>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src="../../assets/public/vendor/js/bootstrap.js"></script>

    <!-- aos js -->
    <script src="../../assets/public/vendor/js/aos.js"></script>

    <!-- custom js -->
    <script src="../../assets/public/js/custom.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'copyHtml5',
                }, {
                    extend: 'csvHtml5'
                }, {
                    extend: 'pdfHtml5'
                }]
            });
            $('#myTable1').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'copyHtml5',
                }, {
                    extend: 'csvHtml5'
                }, {
                    extend: 'pdfHtml5'
                }]
            });
            $('#myTable2').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'copyHtml5',
                }, {
                    extend: 'csvHtml5'
                }, {
                    extend: 'pdfHtml5'
                }]
            });
        });
    </script>
    <script>
        const input = document.querySelector("#input");
        var uploaded = "";

        input.addEventListener('change', function() {
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                uploaded = reader.result;
                document.querySelector("#box").src = `${uploaded}`;
            })
            reader.readAsDataURL(this.files[0]);
        })
    </script>
    <script src="../../assets/public/vendor/js/buttons.js"></script>
    <script src="../../assets/public/vendor/js/pdf.js"></script>
    <script src="../../assets/public/vendor/js/pdfin.js"></script>
    <script src="../../assets/public/vendor/js/htmlbutton.js"></script>
</body>

</html>