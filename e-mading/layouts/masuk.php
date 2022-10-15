<!-- masuk -->
<?php
$db->csrf_token();
?>
<section>
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-lg-4 m-auto text-center" data-aos="fade-down" data-aos-duration="1300">
                <div class="card border-0 shadow rounded-4">
                    <div class="col-10 mx-auto">
                        <div class="card-body text-center m-0 p-0">
                            <h1 class="display-5 fw-bold text-primary my-4">
                                <i>Masuk</i>
                                <img src="assets/public/img/logo.png" width="100">
                            </h1>
                            <form action="" method="post" class="pb-3">
                                <?= @$_GET["pesanberhasil"] ?>
                                <input type="hidden" name="csrf_token" hidden value="<?= $_SESSION["token"] ?>">
                                <input type="email" name="email" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Email">
                                <?= @$_GET["pesanemail"] ?>
                                <input type="password" name="password" class="form-control rounded-pill shadow-none border mb-3 px-3" placeholder="Password">
                                <?= @$_GET["pesanpassword"] ?>
                                <button type="submit" name="login" class="btn btn-primary rounded-pill w-100">Masuk</button>
                            </form>
                            <a href="#" class="text-start" data-bs-toggle="modal" data-bs-target="#exampleModalLupaEmail">Lupa Email?</a>
                            <p class="text-secondary my-4">Belum Punya Akun? <a href="?page=daftar">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalLupaEmail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Masukkan Username</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="text" id="key" class="form-control rounded-pill shadow-none border" placeholder="Username">
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="block">
            </div>
        </div>
    </div>
</div>