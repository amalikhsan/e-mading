<?php
if (!isset($_SESSION["admin"])) {
    echo "<script>location='index.php'</script>";
}
?>
<h1 class="display-6">Pengguna</h1>
<p class="text-secondary">Pengguna E-Mading</p>
<div class="card p-3 border-0 rounded-4 shadow my-2">
    <div class="table-responsive">
        <h6 class="fs-3">Pengguna</h6>
        <table class="table table-bordered pt-2" id="myTable1">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $result = $db->getPengguna();
                while ($d = mysqli_fetch_assoc($result)) {
                    $db->editPengguna($d["id"]);
                    $db->deletePengguna($d["id"]);
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $d["username"] ?></td>
                        <td><?= $d["email"] ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm my-1 float-start me-2" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $d['id'] ?>">Edit</a>
                            <form action="" method="post" class="float-start">
                                <button type="submit" name="delete<?= $d['id'] ?>" class="btn btn-danger btn-sm my-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="exampleModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <input required type="text" name="username" value="<?= $d["username"] ?>" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Username">
                                        <input required type="email" name="email" value="<?= $d["email"] ?>" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Email">
                                        <select required name="level" class="form-select rounded-pill shadow-none border mb-3 px-3">
                                            <option value="1" <?= $d["level"] == "1" ? "selected" : ""; ?>>Admin</option>
                                            <option value="2" <?= $d["level"] == "2" ? "selected" : ""; ?>>User</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="edit<?= $d['id'] ?>" class="btn btn-warning">Edit</button>
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