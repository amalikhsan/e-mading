<?php

require_once 'assets/config/config.php';

$db = new db();

$result = $db->cariPengguna();

if (isset($_GET["key"]) && !empty($_GET["key"])) {

    while ($d = mysqli_fetch_assoc($result)) {

        echo "<div class=\"alert alert-success rounded-pill py-2 w-100 text-center\" role=\"alert\">

                    " . $d["email"] . "

                </div>";
    }
} else {

    echo "<div class=\"alert alert-danger rounded-pill py-2 w-100 text-center\" role=\"alert\">

                    Email Tidak DItemukan

                </div>";
}
