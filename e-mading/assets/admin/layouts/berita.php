<h1 class="display-6">Berita</h1>
<p class="text-secondary">Berita E-Mading</p>
<div class="card p-3 border-0 rounded-4 shadow my-2">
    <div class="table-responsive">
        <a href="#" class="btn btn-primary mb-2 float-end me-2" data-bs-toggle="modal" data-bs-target="#exampleModalTambahBerita"><i class="bi bi-plus-lg me-2"></i>Tambah</a>
        <div class="modal fade" id="exampleModalTambahBerita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="tambahberita" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h6 class="fs-3">Berita Saya</h6>
        <table class="table table-bordered pt-2" id="myTable">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $result = $db->getBeritaId($_SESSION["id"]);
                while ($d = mysqli_fetch_assoc($result)) {
                    $db->editBerita($d["id_blog"]);
                    $db->deleteBerita($d["id_blog"]);
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><img src="../upload/<?= $d["foto_berita"] ?>" width="100"></td>
                        <td>
                            <p class="texting" style="width: 100px !important;cursor:help;" title="<?= $d["judul_berita"] ?>"><?= $d["judul_berita"] ?></p>
                        </td>
                        <td>
                            <p class="texting" style="width: 100px !important;cursor:help;" title="<?= $d["deskripsi"] ?>"><?= $d["deskripsi"] ?></p>
                        </td>
                        <td><?= $d["tgl_post"] ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm my-1 float-start me-2" data-bs-toggle="modal" data-bs-target="#exampleModalBerita<?= $d['id_blog'] ?>">Edit</a>
                            <form action="" method="post" class="float-start">
                                <button type="submit" name="deleteberita<?= $d['id_blog'] ?>" class="btn btn-danger btn-sm my-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModalBerita<?= $d['id_blog'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input required type="file" name="foto" class="form-control rounded-pill shadow-none border mb-3">
                                        <input required type="text" value="<?= $d['judul_berita'] ?>" name="judul" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Judul">
                                        <textarea required type="text" rows="10" name="deskripsi" class="form-control rounded-5 shadow-none border mb-3 px-3" placeholder="Deskripsi"><?= $d['deskripsi'] ?></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="editberita<?= $d['id_blog'] ?>" class="btn btn-warning">Edit</button>
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