<?php
if (!isset($_SESSION)) {
    echo "<script>location='../.././'</script>";
}
session_unset();
session_destroy();
echo "<script>location='../.././'</script>";
