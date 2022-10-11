<?php
if (!isset($_SESSION)) {
    echo "<script>location='index.php'</script>";
}
session_unset();
session_destroy();
echo "<script>location='index.php'</script>";
