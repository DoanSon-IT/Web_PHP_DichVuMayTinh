<?php
include "./model/dcFrontend.php";
if (isset($_GET['maDonHang'])) {
    $maDonHang = $_GET['maDonHang'];
    deleteOrder($maDonHang);
    header("Location: ./donhang.php");
    exit;
} else {
    echo "Invalid request!";
}
?>
