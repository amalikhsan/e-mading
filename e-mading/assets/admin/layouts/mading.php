<h1 class="display-6">Mading</h1>
<p class="text-secondary">Mading E-Mading</p>
<div class="card p-3 border-0 rounded-4 shadow my-2">
    <div class="table-responsive">
        <a href="#" class="btn btn-primary mb-2 float-end me-2" data-bs-toggle="modal" data-bs-target="#exampleModalTambahMading"><i class="bi bi-plus-lg me-2"></i>Tambah</a>
        <div class="modal fade" id="exampleModalTambahMading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-lg-4 text-center mx-auto">
                                <h5 class="mb-2">Tampilan Foto</h5>
                                <p class="mb-0">Pilih Foto Terlebih Dahulu</p>
                                <img id="box" class="mb-3 w-100">
                            </div>
                            <input required id="input" type="file" name="foto" class="form-control rounded-pill shadow-none border mb-3">
                            <input required type="text" name="judul" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Judul">
                            <textarea required type="text" rows="10" name="deskripsi" class="form-control rounded-5 shadow-none border mb-3 px-3" placeholder="Deskripsi"></textarea>
                            <input required type="text" name="link" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Link">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="tambahmading" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h6 class="fs-3">Mading Saya</h6>
        <table class="table table-bordered pt-2" id="myTable2">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Link</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody><?php
                    $i = 1;
                    $result = $db->getMadingId($_SESSION["id"]);
                    while ($d = mysqli_fetch_assoc($result)) {
                        $db->editMading($d["id_event"]);
                        $db->deleteMading($d["id_event"]);
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><img src="../upload/<?= $d["foto_event"] ?>" width="100"></td>
                        <td>
                            <p class="texting" style="width: 100px !important;cursor:help;" title="<?= $d["judul_event"] ?>"><?= $d["judul_event"] ?></p>
                        </td>
                        <td>
                            <p class="texting" style="width: 100px !important;cursor:help;" title="<?= $d["desk_event"] ?>"><?= $d["desk_event"] ?></p>
                        </td>
                        <td>
                            <a href="<?= $d["link_event"] ?>" class="texting" style="width: 100px !important;cursor:help;" title="<?= $d["link_event"] ?>"><?= $d["link_event"] ?></a>
                        </td>
                        <td><?= $d["tgl_post"] ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm my-1 float-start me-2" data-bs-toggle="modal" data-bs-target="#exampleModalMading<?= $d['id_event'] ?>">Edit</a>
                            <form action="" method="post" class="float-start">
                                <button type="submit" name="deletemading<?= $d['id_event'] ?>" class="btn btn-danger btn-sm my-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModalMading<?= $d['id_event'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input required type="file" name="foto" class="form-control rounded-pill shadow-none border mb-3">
                                        <input required type="text" value="<?= $d['judul_event'] ?>" name="judul" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Judul">
                                        <textarea required type="text" rows="10" name="deskripsi" class="form-control rounded-5 shadow-none border mb-3 px-3" placeholder="Deskripsi"><?= $d['desk_event'] ?></textarea>
                                        <input required type="text" value="<?= $d['link_event'] ?>" name="link" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Link">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="editmading<?= $d['id_event'] ?>" class="btn btn-warning">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>