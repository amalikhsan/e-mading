<?php
if (!isset($_GET["detail"])) {
?>
    <section class="bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto my-3 text-center" data-aos="fade-down" data-aos-duration="1300">
                    <h1 class="text-primary mb-3 display-3 fw-bold"><i>Berita</i></h1>
                    <form action="" method="get" class="d-flex rounded-pill shadow p-2">
                        <input type="text" name="query" class="form-control border-0 shadow-none rounded-0 rounded-end rounded-pill ps-3" placeholder="Cari Berita..." autocomplete="off" autofocus required>
                        <button type="submit" name="page" class="btn btn-primary rounded-circle" value="berita"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- berita -->
    <section class="py-5">
        <div class="container">
            <h3 class="fw-semibold border-start border-5 border-primary ps-2 mb-3">Berita</h3>
            <div class="row">
                <!-- loop data -->
                <?php
                $result = $db->getBerita();
                while ($d = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="col-12 mb-3" data-aos="fade-right" data-aos-duration="1000" style="cursor:pointer;" onclick="location='?page=berita&detail=<?= $db->exim($d['judul_berita']) ?>'">
                        <div class="card border-0 bg-transparent">
                            <div class="row g-0">
                                <div class="col-3">
                                    <img src="assets/upload/<?= $d["foto_berita"] ?>" class="img-fluid berita-img-lg rounded-4 w-100">
                                </div>
                                <div class="col-9">
                                    <div class="card-body p-0 ps-3">
                                        <p class="card-text texting size mb-0"><?= $d["judul_berita"] ?></p>
                                        <p class="card-text texting d-none d-lg-block"><?= $d["deskripsi"] ?></p>
                                        <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- end loop -->
            </div>
        </div>
    </section>
<?php
} else {
?>
    <!-- 1 data -->
    <?php
    $get = $db->eximBack($_GET["detail"]);
    $result = $db->getBerita3($get);
    while ($d = mysqli_fetch_assoc($result)) {
    ?>
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-down" data-aos-duration="1300">
                        <div class="card border-0 shadow rounded-4">
                            <div class="card-header bg-white border-0 rounded-4">
                                <a href="https://wa.me/?text=https://<?= $_SERVER["HTTP_HOST"] ?>/?page=berita%26detail=<?= $db->exim($d["judul_berita"]) ?>" class="float-end">Share<i class="bi bi-share ms-2"></i></a>
                                <a href="?page=berita"><i class="bi bi-chevron-double-left me-2"></i>Kembali</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-8">
                                        <img src="assets/upload/<?= $d["foto_berita"] ?>" class="rounded-4 w-100 my-3">
                                        <h1 class="fw-bold"><?= $d["judul_berita"] ?></h1>
                                        <p><?= $db->url(nl2br($d["deskripsi"])) ?></p>
                                        <p class="text-secondary"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></p>
                                    </div>
                                    <div class="col-xl-4">
                                        <h3 class="fw-semibold border-start border-5 border-primary ps-2 my-3 my-lg-0 mb-lg-3">Berita</h3>
                                        <div class="row">
                                            <!-- loop data -->
                                            <?php
                                            $result = $db->getBerita();
                                            while ($d = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <div class="col-12 mb-3" data-aos="fade-right" data-aos-duration="1000" style="cursor:pointer;" onclick="location='?page=berita&detail=<?= $db->exim($d['judul_berita']) ?>'">
                                                    <div class="card border-0">
                                                        <div class="row g-0">
                                                            <div class="col-4">
                                                                <img src="assets/upload/<?= $d["foto_berita"] ?>" class="img-fluid berita-img rounded-4 w-100">
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="card-body p-0 ps-3">
                                                                    <p class="card-text texting size-md mb-0"><?= $d["judul_berita"] ?></p>
                                                                    <p class="card-text texting d-none d-lg-block"><?= $d["deskripsi"] ?></p>
                                                                    <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <!-- end loop -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
?>