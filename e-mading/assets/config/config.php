<?php

class db
{
    public function __construct(
        $server = "localhost",
        $uname = "root",
        $pass = "",
        $db = "emading"
    ) {
        $this->server = $server;
        $this->uname = $uname;
        $this->pass = $pass;
        $this->db = $db;
        $this->kon = mysqli_connect($this->server, $this->uname, $this->pass, $this->db);
        if (!$this->kon) {
            die("Tidak Terkoneksi");
        }
    }
    public function csrf_token()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION["token"] = $token;
    }
    public function akun()
    {
        if (isset($_POST["daftar"])) {
            if (empty($_POST["csrf_token"])) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $token = htmlspecialchars($_POST["csrf_token"]);
            if (strlen($token) == null) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            } else if ($token != $_SESSION["token"]) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $uname = htmlspecialchars($_POST["uname"]);
            if (strlen($uname) == null) {
                $_GET["pesanuname"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($uname) > 50) {
                $_GET["pesanuname"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $email = htmlspecialchars($_POST["email"]);
            if (strlen($email) == null) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($email) > 50) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Salah
                </div>
                ";
                return false;
            }
            $password = htmlspecialchars($_POST["password"]);
            if (strlen($password) == null) {
                $_GET["pesanpassword"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($password) > 50) {
                $_GET["pesanpassword"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $password2 = htmlspecialchars($_POST["password2"]);
            if (strlen($password2) == null) {
                $_GET["pesanpassword2"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Konfirmasi Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($password2) > 50) {
                $_GET["pesanpassword2"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Konfirmasi Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $cek = mysqli_query($this->kon, "select*from tbl_login where email='$email'");
            if (mysqli_num_rows($cek) == null) {
                if ($password == $password2) {
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    $qry = mysqli_query($this->kon, "insert into tbl_login values(null,'$uname','$email','$pass','2')");
                    if ($qry) {
                        $_GET["pesanberhasil"] = "
                <div class=\"alert alert-success rounded-pill py-2\" role=\"alert\">
                    Berhasil Mendaftarkan Akun
                </div>
                <meta http-equiv=\"refresh\" content=\"1; url=?page=masuk\">
                ";
                        return $qry;
                    }
                } else {
                    $_GET["pesanpassword2"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Password Konfirmasi Tidak Sesuai
                </div>
                ";
                    return false;
                }
            } else {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Telah Terdaftar
                </div>
                ";
                return false;
            }
        } else if (isset($_POST["login"])) {
            if (empty($_POST["csrf_token"])) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $token = htmlspecialchars($_POST["csrf_token"]);
            if (strlen($token) == null) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            } else if ($token != $_SESSION["token"]) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $email = htmlspecialchars($_POST["email"]);
            if (strlen($email) == null) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($email) > 50) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Salah
                </div>
                ";
                return false;
            }
            $password = htmlspecialchars($_POST["password"]);
            if (strlen($password) == null) {
                $_GET["pesanpassword"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($password) > 50) {
                $_GET["pesanpassword"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Passowrd Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $cek = mysqli_query($this->kon, "select*from tbl_login where email='$email'");
            if (mysqli_num_rows($cek) > 0) {
                while ($data = mysqli_fetch_assoc($cek)) {
                    if (password_verify($password, $data["password"])) {
                        if ($data["id"] == 1 || $data["level"] == 1) {
                            $_SESSION["admin"] = true;
                            $_SESSION["login"] = true;
                            $_SESSION["id"] = $data["id"];
                            $_SESSION["username"] = $data["username"];
                            $_SESSION["email"] = $data["email"];
                            $_SESSION["level"] = $data["level"];
                        } else if ($data["id"] > 1 || $data["level"] == 2) {
                            $_SESSION["login"] = true;
                            $_SESSION["id"] = $data["id"];
                            $_SESSION["username"] = $data["username"];
                            $_SESSION["email"] = $data["email"];
                            $_SESSION["level"] = $data["level"];
                        }
                        $_GET["pesanberhasil"] = "
                <div class=\"alert alert-success rounded-pill py-2\" role=\"alert\">
                    Berhasil Masuk
                </div>
                <meta http-equiv=\"refresh\" content=\"1; url=index.php\">
                ";
                    } else {
                        $_GET["pesanpassword"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Password Salah
                </div>
                ";
                        return false;
                    }
                }
            } else {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Belum Terdaftar
                </div>
                ";
                return false;
            }
        }
    }
    public function getPengguna()
    {
        $qry = mysqli_query($this->kon, "select*from tbl_login order by id desc");
        if ($qry) {
            return $qry;
        }
    }
    public function getPengguna1($id)
    {
        $qry = mysqli_query($this->kon, "select*from tbl_login where id='$id'");
        if ($qry) {
            return $qry;
        }
    }
    public function getPengguna2($id)
    {
        $qry = mysqli_query($this->kon, "select*from tbl_user where id_login='$id'");
        if ($qry) {
            return $qry;
        }
    }
    public function getBerita()
    {
        if (isset($_GET["query"])) {
            $cari = htmlspecialchars($_GET["query"]);
            $qry = mysqli_query($this->kon, "select*from tbl_blog where judul_berita like '%$cari%' or deskripsi like '%$cari%'");
            if ($qry) {
                return $qry;
            }
        } else {
            $qry = mysqli_query($this->kon, "select*from tbl_blog order by id_blog desc");
            if ($qry) {
                return $qry;
            }
        }
    }
    public function getBeritaId($id)
    {

        $qry = mysqli_query($this->kon, "select*from tbl_blog  where id_user='$id' order by id_blog desc");
        if ($qry) {
            return $qry;
        }
    }
    public function getBerita1()
    {
        $qry = mysqli_query($this->kon, "select*from tbl_blog order by id_blog desc limit 3");
        if ($qry) {
            return $qry;
        }
    }
    public function getBerita2()
    {
        $qry = mysqli_query($this->kon, "select*from tbl_blog order by id_blog desc limit 1");
        if ($qry) {
            return $qry;
        }
    }
    public function getBerita3($judul)
    {
        $qry = mysqli_query($this->kon, "select*from tbl_blog where judul_berita='$judul'");
        if ($qry) {
            return $qry;
        }
    }
    public function getMading()
    {
        if (isset($_GET["query"])) {
            $cari = htmlspecialchars($_GET["query"]);
            $qry = mysqli_query($this->kon, "select*from tbl_event where judul_event like '%$cari%' or desk_event like '%$cari%'");
            if ($qry) {
                return $qry;
            }
        } else {
            $qry = mysqli_query($this->kon, "select*from tbl_event order by id_event desc");
            if ($qry) {
                return $qry;
            }
        }
    }
    public function getMadingId($id)
    {

        $qry = mysqli_query($this->kon, "select*from tbl_event  where id_user='$id' order by id_event desc");
        if ($qry) {
            return $qry;
        }
    }
    public function getMading1()
    {
        $qry = mysqli_query($this->kon, "select*from tbl_event order by id_event desc limit 3");
        if ($qry) {
            return $qry;
        }
    }
    public function editProfil($id)
    {
        if (isset($_POST['edit'])) {
            if (empty($_POST["csrf_token"])) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $token = htmlspecialchars($_POST["csrf_token"]);
            if (strlen($token) == null) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            } else if ($token != $_SESSION["token"]) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $username = htmlspecialchars($_POST["username"]);
            if (strlen($username) == null) {
                $_GET["pesanusername"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($username) > 50) {
                $_GET["pesanusername"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $email = htmlspecialchars($_POST["email"]);
            if (strlen($email) == null) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($email) > 50) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Salah
                </div>
                ";
                return false;
            }
            $ormawa = htmlspecialchars($_POST["ormawa"]);
            if (strlen($ormawa) == null) {
                $_GET["pesanormawa"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Ormawa Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($ormawa) > 50) {
                $_GET["pesanormawa"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Ormawa Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $jurusan = htmlspecialchars($_POST["jurusan"]);
            if (strlen($jurusan) == null) {
                $_GET["pesanjurusan"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Jurusan Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($jurusan) > 50) {
                $_GET["pesanjurusan"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Jurusan Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $qry = mysqli_query($this->kon, "update tbl_user set ormawa='$ormawa',jurusan='$jurusan' where id_login='$id'");
            $qry2 = mysqli_query($this->kon, "update tbl_login set username='$username',email='$email' where id='$id'");
            if ($qry && $qry2) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-success rounded-pill py-2\" role=\"alert\">
                    Berhasil Mengedit
                </div>
                <meta http-equiv=\"refresh\" content=\"1; url=?page=profil\">
                ";
                return $qry;
            }
        }
    }
    public function insertProfil($id)
    {
        if (isset($_POST["edit"])) {
            if (empty($_POST["csrf_token"])) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $token = htmlspecialchars($_POST["csrf_token"]);
            if (strlen($token) == null) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            } else if ($token != $_SESSION["token"]) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    CSRF Token Tidak Terdeteksi
                </div>
                ";
                return false;
            }
            $username = htmlspecialchars($_POST["username"]);
            if (strlen($username) == null) {
                $_GET["pesanusername"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($username) > 50) {
                $_GET["pesanusername"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Username Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $email = htmlspecialchars($_POST["email"]);
            if (strlen($email) == null) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($email) > 50) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_GET["pesanemail"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Email Salah
                </div>
                ";
                return false;
            }
            $ormawa = htmlspecialchars($_POST["ormawa"]);
            if (strlen($ormawa) == null) {
                $_GET["pesanormawa"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Ormawa Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($ormawa) > 50) {
                $_GET["pesanormawa"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Ormawa Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $jurusan = htmlspecialchars($_POST["jurusan"]);
            if (strlen($jurusan) == null) {
                $_GET["pesanjurusan"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Jurusan Belum Diisi
                </div>
                ";
                return false;
            } else if (strlen($jurusan) > 50) {
                $_GET["pesanjurusan"] = "
                <div class=\"alert alert-danger rounded-pill py-2\" role=\"alert\">
                    Jurusan Tidak Boleh Lebih dari 50 Karakter
                </div>
                ";
                return false;
            }
            $qry = mysqli_query($this->kon, "insert into tbl_user values(null,'$id','$ormawa','$jurusan')");
            if ($qry) {
                $_GET["pesanberhasil"] = "
                <div class=\"alert alert-success rounded-pill py-2\" role=\"alert\">
                    Berhasil Mengedit
                </div>
                <meta http-equiv=\"refresh\" content=\"1; url=?page=profil\">
                ";
                return $qry;
            }
        }
    }
    public function editPengguna($id)
    {
        if (isset($_POST["edit$id"])) {
            $username = htmlspecialchars($_POST["username"]);
            if (strlen($username) == null) {
                return false;
            } else if (strlen($username) > 50) {
                return false;
            }
            $email = htmlspecialchars($_POST["email"]);
            if (strlen($email) == null) {
                return false;
            } else if (strlen($email) > 50) {
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            $level = htmlspecialchars($_POST["level"]);
            if (strlen($level) == null) {
                return false;
            } else if (strlen($level) > 50) {
                return false;
            }
            $qry = mysqli_query($this->kon, "update tbl_login set username='$username',email='$email',level='$level' where id='$id'");
            if ($qry) {
                echo "<script>alert('Berhasil Edit Data')</script>";
                echo "<script>location='index.php'</script>";
                return $qry;
            }
        }
    }
    public function deletePengguna($id)
    {
        if (isset($_POST["delete$id"])) {
            $qry = mysqli_query($this->kon, "delete from tbl_login where id='$id'");
            if ($qry) {
                echo "<script>alert('Berhasil Delete Data')</script>";
                echo "<script>location='index.php'</script>";
                return $qry;
            }
        }
    }
    public function tambahBerita($id)
    {
        if (isset($_POST["tambahberita"])) {
            function uploadFoto()
            {
                if (isset($_FILES['foto'])) {
                    $namaFile = $_FILES['foto']['name'];
                    $ukuranFile = $_FILES['foto']['size'];
                    $error = $_FILES['foto']['error'];
                    $tmpName = $_FILES['foto']['tmp_name'];
                    if ($error === 4) {
                        echo
                        "<script>alert('File/Foto Gagal Dimasukkan')</script>";
                        return false;
                    }

                    $ekstensiFileValid = ['jpg', 'jpeg', 'jfif', 'png', 'webp'];
                    $ekstensiFile = explode('.', $namaFile);
                    $ekstensiFile = strtolower(end($ekstensiFile));
                    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
                        echo
                        "<script>alert('File/Foto Tidak Sesuai Ekstensi : [jpg,jpeg,jfif,png,webp]')</script>";
                        return false;
                    }


                    if ($ukuranFile > 1000000) {
                        echo
                        "<script>alert('File/Foto Maximal 1MB')</script>";
                        return false;
                    }

                    $namaFileBaru = uniqid();
                    $namaFileBaru .= ".";
                    $namaFileBaru .= $ekstensiFile;

                    move_uploaded_file($tmpName, "../upload/" . $namaFileBaru);

                    return $namaFileBaru;
                } else {
                    return false;
                }
            }
            $foto = uploadFoto();
            if (strlen($foto) == null) {
                echo "<script>alert('Foto Belum Diupload')</script>";
                return false;
            } else if (strlen($foto) > 300) {
                echo "<script>alert('Maksimal 300 Karakter')</script>";
                return false;
            }
            $judul = htmlspecialchars($_POST["judul"]);
            if (strlen($judul) == null) {
                echo "<script>alert('Judul Harus Diisi')</script>";
                return false;
            } else if (strlen($judul) > 300) {
                echo "<script>alert('Judul Maksimal 300 Karakter')</script>";
                return false;
            }
            $deskripsi = htmlspecialchars($_POST["deskripsi"]);
            if (strlen($deskripsi) == null) {
                echo "<script>alert('Deskripsi Harus Diisi')</script>";
                return false;
            } else if (strlen($deskripsi) > 1000) {
                echo "<script>alert('Deskripsi Maximal 1000 Karakter')</script>";
                return false;
            }
            $tgl = date("Y-m-d H:i:s");
            $cek = mysqli_query($this->kon, "select*from tbl_blog where judul_berita='$judul'");
            if (mysqli_num_rows($cek) == 0) {
                $qry = mysqli_query($this->kon, "insert into tbl_blog values(null,'$id','$foto','$judul','$deskripsi','$tgl')");
                if ($qry) {
                    echo "<script>alert('Berhasil Tambah Data')</script>";
                    if (isset($_GET["page"])) {
                        echo "<script>location='?page=berita'</script>";
                    } else {
                        echo "<script>location='index.php'</script>";
                    }
                    return $qry;
                }
            } else {
                echo "<script>alert('Judul Tidak Boleh Sama')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=berita'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return false;
            }
        }
    }
    public function editBerita($id)
    {
        if (isset($_POST["editberita$id"])) {
            function uploadFoto()
            {
                if (isset($_FILES['foto'])) {
                    $namaFile = $_FILES['foto']['name'];
                    $ukuranFile = $_FILES['foto']['size'];
                    $error = $_FILES['foto']['error'];
                    $tmpName = $_FILES['foto']['tmp_name'];
                    if ($error === 4) {
                        echo
                        "<script>alert('File/Foto Gagal Dimasukkan')</script>";
                        return false;
                    }

                    $ekstensiFileValid = ['jpg', 'jpeg', 'jfif', 'png', 'webp'];
                    $ekstensiFile = explode('.', $namaFile);
                    $ekstensiFile = strtolower(end($ekstensiFile));
                    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
                        echo
                        "<script>alert('File/Foto Tidak Sesuai Ekstensi : [jpg,jpeg,jfif,png,webp]')</script>";
                        return false;
                    }


                    if ($ukuranFile > 1000000) {
                        echo
                        "<script>alert('File/Foto Maximal 1MB')</script>";
                        return false;
                    }

                    $namaFileBaru = uniqid();
                    $namaFileBaru .= ".";
                    $namaFileBaru .= $ekstensiFile;

                    move_uploaded_file($tmpName, "../upload/" . $namaFileBaru);

                    return $namaFileBaru;
                } else {
                    return false;
                }
            }
            $foto = uploadFoto();
            if (strlen($foto) == null) {
                echo "<script>alert('Foto Belum Diupload')</script>";
                return false;
            } else if (strlen($foto) > 300) {
                echo "<script>alert('Maksimal 300 Karakter')</script>";
                return false;
            }
            $judul = htmlspecialchars($_POST["judul"]);
            if (strlen($judul) == null) {
                echo "<script>alert('Judul Harus Diisi')</script>";
                return false;
            } else if (strlen($judul) > 300) {
                echo "<script>alert('Judul Maksimal 300 Karakter')</script>";
                return false;
            }
            $deskripsi = htmlspecialchars($_POST["deskripsi"]);
            if (strlen($deskripsi) == null) {
                echo "<script>alert('Deskripsi Harus Diisi')</script>";
                return false;
            } else if (strlen($deskripsi) > 1000) {
                echo "<script>alert('Deskripsi Maximal 1000 Karakter')</script>";
                return false;
            }
            $tgl = date("Y-m-d H:i:s");
            $cek = mysqli_query($this->kon, "select*from tbl_blog where judul_berita='$judul'");
            if (mysqli_num_rows($cek) == 0) {
                $qry = mysqli_query($this->kon, "update tbl_blog set foto_berita='$foto',judul_berita='$judul',deskripsi='$deskripsi',tgl_post='$tgl' where id_blog='$id'");
                if ($qry) {
                    echo "<script>alert('Berhasil Edit Data')</script>";
                    if (isset($_GET["page"])) {
                        echo "<script>location='?page=berita'</script>";
                    } else {
                        echo "<script>location='index.php'</script>";
                    }
                    return $qry;
                }
            } else {
                echo "<script>alert('Judul Tidak Boleh Sama')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=berita'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return false;
            }
        }
    }
    public function deleteBerita($id)
    {
        if (isset($_POST["deleteberita$id"])) {
            $qry = mysqli_query($this->kon, "delete from tbl_blog where id_blog='$id'");
            if ($qry) {
                echo "<script>alert('Berhasil Delete Data')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=berita'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return $qry;
            }
        }
    }
    public function tambahMading($id)
    {
        if (isset($_POST["tambahmading"])) {
            function uploadFoto()
            {
                if (isset($_FILES['foto'])) {
                    $namaFile = $_FILES['foto']['name'];
                    $ukuranFile = $_FILES['foto']['size'];
                    $error = $_FILES['foto']['error'];
                    $tmpName = $_FILES['foto']['tmp_name'];
                    if ($error === 4) {
                        echo
                        "<script>alert('File/Foto Gagal Dimasukkan')</script>";
                        return false;
                    }

                    $ekstensiFileValid = ['jpg', 'jpeg', 'jfif', 'png', 'webp'];
                    $ekstensiFile = explode('.', $namaFile);
                    $ekstensiFile = strtolower(end($ekstensiFile));
                    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
                        echo
                        "<script>alert('File/Foto Tidak Sesuai Ekstensi : [jpg,jpeg,jfif,png,webp]')</script>";
                        return false;
                    }


                    if ($ukuranFile > 1000000) {
                        echo
                        "<script>alert('File/Foto Maximal 1MB')</script>";
                        return false;
                    }

                    $namaFileBaru = uniqid();
                    $namaFileBaru .= ".";
                    $namaFileBaru .= $ekstensiFile;

                    move_uploaded_file($tmpName, "../upload/" . $namaFileBaru);

                    return $namaFileBaru;
                } else {
                    return false;
                }
            }
            $foto = uploadFoto();
            if (strlen($foto) == null) {
                echo "<script>alert('Foto Belum Diupload')</script>";
                return false;
            } else if (strlen($foto) > 300) {
                echo "<script>alert('Maksimal 300 Karakter')</script>";
                return false;
            }
            $judul = htmlspecialchars($_POST["judul"]);
            if (strlen($judul) == null) {
                echo "<script>alert('Judul Harus Diisi')</script>";
                return false;
            } else if (strlen($judul) > 300) {
                echo "<script>alert('Judul Maksimal 300 Karakter')</script>";
                return false;
            }
            $deskripsi = htmlspecialchars($_POST["deskripsi"]);
            if (strlen($deskripsi) == null) {
                echo "<script>alert('Deskripsi Harus Diisi')</script>";
                return false;
            } else if (strlen($deskripsi) > 1000) {
                echo "<script>alert('Deskripsi Maximal 1000 Karakter')</script>";
                return false;
            }
            $link = htmlspecialchars($_POST["link"]);
            if (strlen($link) == null) {
                echo "<script>alert('Link Harus Diisi')</script>";
                return false;
            } else if (strlen($link) > 1000) {
                echo "<script>alert('Link Maximal 1000 Karakter')</script>";
                return false;
            }
            $tgl = date("Y-m-d H:i:s");
            $qry = mysqli_query($this->kon, "insert into tbl_event values(null,'$id','$foto','$judul','$deskripsi','$link','$tgl')");
            if ($qry) {
                echo "<script>alert('Berhasil Tambah Data')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=mading'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return $qry;
            }
        }
    }
    public function editMading($id)
    {
        if (isset($_POST["editmading$id"])) {
            function uploadFoto()
            {
                if (isset($_FILES['foto'])) {
                    $namaFile = $_FILES['foto']['name'];
                    $ukuranFile = $_FILES['foto']['size'];
                    $error = $_FILES['foto']['error'];
                    $tmpName = $_FILES['foto']['tmp_name'];
                    if ($error === 4) {
                        echo
                        "<script>alert('File/Foto Gagal Dimasukkan')</script>";
                        return false;
                    }

                    $ekstensiFileValid = ['jpg', 'jpeg', 'jfif', 'png', 'webp'];
                    $ekstensiFile = explode('.', $namaFile);
                    $ekstensiFile = strtolower(end($ekstensiFile));
                    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
                        echo
                        "<script>alert('File/Foto Tidak Sesuai Ekstensi : [jpg,jpeg,jfif,png,webp]')</script>";
                        return false;
                    }


                    if ($ukuranFile > 1000000) {
                        echo
                        "<script>alert('File/Foto Maximal 1MB')</script>";
                        return false;
                    }

                    $namaFileBaru = uniqid();
                    $namaFileBaru .= ".";
                    $namaFileBaru .= $ekstensiFile;

                    move_uploaded_file($tmpName, "../upload/" . $namaFileBaru);

                    return $namaFileBaru;
                } else {
                    return false;
                }
            }
            $foto = uploadFoto();
            if (strlen($foto) == null) {
                echo "<script>alert('Foto Belum Diupload')</script>";
                return false;
            } else if (strlen($foto) > 300) {
                echo "<script>alert('Maksimal 300 Karakter')</script>";
                return false;
            }
            $judul = htmlspecialchars($_POST["judul"]);
            if (strlen($judul) == null) {
                echo "<script>alert('Judul Harus Diisi')</script>";
                return false;
            } else if (strlen($judul) > 300) {
                echo "<script>alert('Judul Maksimal 300 Karakter')</script>";
                return false;
            }
            $deskripsi = htmlspecialchars($_POST["deskripsi"]);
            if (strlen($deskripsi) == null) {
                echo "<script>alert('Deskripsi Harus Diisi')</script>";
                return false;
            } else if (strlen($deskripsi) > 1000) {
                echo "<script>alert('Deskripsi Maximal 1000 Karakter')</script>";
                return false;
            }
            $link = htmlspecialchars($_POST["link"]);
            if (strlen($link) == null) {
                echo "<script>alert('Link Harus Diisi')</script>";
                return false;
            } else if (strlen($link) > 1000) {
                echo "<script>alert('Link Maximal 1000 Karakter')</script>";
                return false;
            }
            $tgl = date("Y-m-d H:i:s");
            $qry = mysqli_query($this->kon, "update tbl_event set foto_event='$foto',judul_event='$judul',desk_event='$deskripsi',link_event='$link',tgl_post='$tgl' where id_event='$id'");
            if ($qry) {
                echo "<script>alert('Berhasil Edit Data')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=mading'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return $qry;
            }
        }
    }
    public function deleteMading($id)
    {
        if (isset($_POST["deletemading$id"])) {
            $qry = mysqli_query($this->kon, "delete from tbl_event where id_event='$id'");
            if ($qry) {
                echo "<script>alert('Berhasil Delete Data')</script>";
                if (isset($_GET["page"])) {
                    echo "<script>location='?page=mading'</script>";
                } else {
                    echo "<script>location='index.php'</script>";
                }
                return $qry;
            }
        }
    }
    public function langganan()
    {
        if (isset($_POST["langganan"])) {
            $email = $_POST["email"];
            if (strlen($email) == null) {
                return false;
            } else if (strlen($email) > 50) {
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            echo "<script>alert('Beralih Ke Whatsapp')</script>";
            echo "<script>location='https://wa.me/6281929825753?text=$email'</script>";
        }
    }
    public function updateAdmin()
    {
        if (isset($_SESSION["admin"])) {
            $qry = mysqli_query($this->kon, "update tbl_login set level='1'");
            if ($qry) {
                return $qry;
            }
        }
    }
    public function url($text)
    {
        $text = html_entity_decode($text);
        $text = "" . $text;
        $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=]*)/', '<a href="$1" target="_blank">$1</a>', $text);
        return $text;
    }
    public function exim($name)
    {
        $names = explode(" ", $name);
        $names = implode("-", $names);
        return $names;
    }
    public function eximBack($name)
    {
        $names = explode("-", $name);
        $names = implode(" ", $names);
        return $names;
    }
    public function cariPengguna()
    {
        if (isset($_GET["key"]) && !empty($_GET["key"])) {
            $cari = htmlspecialchars($_GET["key"]);
            $sql = "select*from tbl_login where username like '%$cari%'";
            $qry = mysqli_query($this->kon, $sql);
            if ($qry) {
                return $qry;
            }
        }
    }
}
