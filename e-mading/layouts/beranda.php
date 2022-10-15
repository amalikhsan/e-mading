<!-- carousel -->
<section data-aos="fade-down" data-aos-duration="1000">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container my-5">
                    <img src="assets/public/img/slidess.png" class="img-responsive rounded-4 w-100 shadow">
                </div>
            </div>
            <div class="carousel-item">
                <div class="container my-5">
                    <img src="assets/public/img/slidess1.png" class="img-responsive rounded-4 w-100 shadow">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev me-5 pe-4 pe-sm-0" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="btn btn-primary rounded-circle shadow p-sm-1 p-md-2 p-lg-3 p-0" aria-hidden="true">
                <i class="gg-chevron-double-left"></i>
            </span>
        </button>
        <button class="carousel-control-next ms-5 ps-4 ps-sm-0" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="btn btn-primary rounded-circle shadow p-sm-1 p-md-2 p-lg-3 p-0" aria-hidden="true">
                <i class="gg-chevron-double-right"></i>
            </span>
        </button>
    </div>
</section>
<!-- berita -->
<section class="bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="fw-semibold border-start border-5 border-primary ps-2 mb-3">Berita</h3>
                        <div class="row">
                            <!-- loop 3 data -->
                            <?php
                            $result = $db->getBerita1();
                            while ($d = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="col-12 mb-3" data-aos="zoom-in" data-aos-duration="1000" style="cursor:pointer;" onclick="location='?page=berita&detail=<?= $db->exim($d['judul_berita']) ?>'">
                                    <div class="card border-0">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img src="assets/upload/<?= $d["foto_berita"] ?>" class="img-fluid berita-img rounded-4 w-100">
                                            </div>
                                            <div class="col-9">
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
                    <div class="col-lg-6">
                        <h3 class="fw-semibold border-start border-5 border-primary ps-2 mb-3">Terbaru</h3>
                        <div class="row">
                            <!-- 1 new data -->
                            <?php
                            $result = $db->getBerita2();
                            while ($d = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="col-12 mb-3" data-aos="zoom-in" data-aos-duration="1300" style="cursor:pointer;" onclick="location='?page=berita&detail=<?= $db->exim($d['judul_berita']) ?>'">
                                    <div class="card text-white border-0 bg-transparent">
                                        <img src="assets/upload/<?= $d["foto_berita"] ?>" class="card-img rounded-4 w-100" style="max-height:330px;">
                                        <div class="bg-linear rounded-4"></div>
                                        <div class="card-img-overlay">
                                            <p class="card-title texting size mb-0"><?= $d["judul_berita"] ?></p>
                                            <p class="card-text texting"><?= $d["deskripsi"] ?></p>
                                            <p class="card-text"><small class="text-light"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- end data -->
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <a href="?page=berita" class="btn btn-primary rounded-pill px-3 my-4">Selengkapnya<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Mading -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="fw-semibold border-start border-5 border-primary ps-2 mb-3">Mading</h3>
                <div class="row">
                    <!-- loop 3 data -->
                    <?php
                    $result = $db->getMading1();
                    while ($d = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="col-12 col-lg-4 mb-3" data-aos="zoom-in" data-aos-duration="1300">
                            <div class="card rounded-4 border-0 shadow">
                                <img src="assets/upload/<?= $d["foto_event"] ?>" class="rounded-4" style="height:400px;">
                                <div class="card-body">
                                    <h5 class="card-title texting"><?= $d["judul_event"] ?></h5>
                                    <p class="card-text texting"><?= $d["desk_event"] ?></p>
                                    <?php
                                    $results = $db->getPengguna1($d["id_user"]);
                                    while ($data = mysqli_fetch_assoc($results)) {
                                    ?>
                                        <p class="card-text"><small class="text-muted"><i class="bi bi-person-fill me-2"></i><?= ucfirst($data["username"]) ?></small></p>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $results2 = $db->getPengguna2($d["id_user"]);
                                    while ($data2 = mysqli_fetch_assoc($results2)) {
                                    ?>
                                        <p class="card-text"><small class="text-muted"><i class="bi bi-people-fill me-2"></i><?= ucfirst($data2["ormawa"]) ?></small></p>
                                    <?php
                                    }
                                    ?>
                                    <p class="card-text mb-4"><small class="text-muted"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></small></p>
                                    <a class="btn btn-primary rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $d["id_event"] ?>"><i class="bi bi-box-arrow-in-up-left me-2"></i>Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal<?= $d["id_event"] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5"><?= $d["judul_event"] ?></h1>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3 mb-lg-0">
                                                    <img src="assets/upload/<?= $d["foto_event"] ?>" class="rounded-4 w-100">
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="card-title"><?= $d["judul_event"] ?></h5>
                                                    <p class="card-text"><?= $d["desk_event"] ?></p>
                                                    <?php
                                                    $results = $db->getPengguna1($d["id_user"]);
                                                    while ($data = mysqli_fetch_assoc($results)) {
                                                    ?>
                                                        <p class="card-text"><small class="text-muted"><i class="bi bi-person-fill me-2"></i><?= ucfirst($data["username"]) ?></small></p>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $results2 = $db->getPengguna2($d["id_user"]);
                                                    while ($data2 = mysqli_fetch_assoc($results2)) {
                                                    ?>
                                                        <p class="card-text"><small class="text-muted"><i class="bi bi-people-fill me-2"></i><?= ucfirst($data2["ormawa"]) ?></small></p>
                                                    <?php
                                                    }
                                                    ?>
                                                    <p class="card-text"><small class="text-muted"><i class="bi bi-calendar-event-fill me-2"></i><?= $d["tgl_post"] ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary rounded-pill px-3" data-bs-dismiss="modal">Kembali</button>
                                        <a href="<?= $d["link_event"] ?>" class="btn btn-primary rounded-pill px-3">Kunjungi</a>
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
            <div class="col-12 text-center">
                <a href="?page=mading" class="btn btn-primary rounded-pill px-3 my-4">Selengkapnya<i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>