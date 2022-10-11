<section class="bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto my-3 text-center" data-aos="fade-down" data-aos-duration="1300">
                <h1 class="text-primary mb-3 display-3 fw-bold"><i>Mading</i></h1>
                <form action="" method="get" class="d-flex rounded-pill shadow p-2">
                    <input type="text" name="query" class="form-control border-0 shadow-none rounded-0 rounded-end rounded-pill ps-3" placeholder="Cari Mading..." autocomplete="off" autofocus required>
                    <button type="submit" name="page" class="btn btn-primary rounded-circle" value="mading"><i class="bi bi-search"></i></button>
                </form>
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
                    <!-- loop data -->
                    <?php
                    $result = $db->getMading();
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
                                        <p class="card-text"><small class="text-muted"><i class="bi bi-person-fill me-2"></i><?= $data["username"] ?></small></p>
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
                                                    <p class="card-text"><?= nl2br($d["desk_event"]) ?></p>
                                                    <?php
                                                    $results = $db->getPengguna1($d["id_user"]);
                                                    while ($data = mysqli_fetch_assoc($results)) {
                                                    ?>
                                                        <p class="card-text"><small class="text-muted"><i class="bi bi-person-fill me-2"></i><?= $data["username"] ?></small></p>
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
        </div>
    </div>
</section>