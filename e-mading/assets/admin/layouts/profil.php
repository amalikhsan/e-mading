<?php
$result = $db->getPengguna1($_SESSION["id"]);
$d = mysqli_fetch_assoc($result);
$result2 = $db->getPengguna2($d["id"]);
if (mysqli_num_rows($result2) > 0) {
    $d2 = mysqli_fetch_assoc($result2);
    $db->editProfil($d2["id_login"]);
} else {
    $db->insertProfil($_SESSION["id"]);
}
$db->csrf_token();
?>
<h1 class="display-6">Profil</h1>
<p class="text-secondary">Profil E-Mading</p>
<div class="row">
    <div class="col-lg-6">
        <div class="card p-3 border-0 rounded-4 shadow my-3">
            <h6 class="fs-3 text-center">Detail</h6>
            <h6 class="mb-1">Username :</h6>
            <p class="text-secondary mb-3"><?= $d["username"] ?></p>
            <h6 class="mb-1">Email :</h6>
            <p class="text-secondary mb-3"><?= $d["email"] ?></p>
            <h6 class="mb-1">Ormawa :</h6>
            <p class="text-secondary mb-3"><?= @$d2["ormawa"] ?></p>
            <h6 class="mb-1">Jurusan :</h6>
            <p class="text-secondary mb-3"><?= @$d2["jurusan"] ?></p>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-3 border-0 rounded-4 shadow my-3">
            <h6 class="fs-3 text-center">Edit</h6>
            <form action="" method="post">
                <?= @$_GET["pesanberhasil"] ?>
                <input type="hidden" name="csrf_token" hidden value="<?= $_SESSION["token"] ?>">
                <input type="text" name="username" placeholder="Username" value="<?= $d["username"] ?>" class="form-control rounded-pill px-3 shadow-none border mb-3">
                <?= @$_GET["pesanusername"] ?>
                <input type="email" name="email" placeholder="Email" value="<?= $d["email"] ?>" class="form-control rounded-pill px-3 shadow-none border mb-3">
                <?= @$_GET["pesanemail"] ?>
                <input type="text" name="ormawa" placeholder="Ormawa" value="<?= @$d2["ormawa"] ?>" class="form-control rounded-pill px-3 shadow-none border mb-3">
                <?= @$_GET["pesanormawa"] ?>
                <input type="text" name="jurusan" placeholder="Jurusan" value="<?= @$d2["jurusan"] ?>" class="form-control rounded-pill px-3 shadow-none border mb-3">
                <?= @$_GET["pesanjurusan"] ?>
                <button tyoe="submit" name="edit" class="btn btn-primary rounded-pill w-100">Edit Profil</button>
            </form>
        </div>
    </div>
</div>