<?php
session_start();
include "connect.php";

$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : "";
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : "";
$total_pembayaran = isset($_POST['total_pembayaran']) ? htmlentities($_POST['total_pembayaran']) : "";
$uang = isset($_POST['uang']) ? htmlentities($_POST['uang']) : "";
$kembalian = $uang - $total_pembayaran;

if (isset($_POST['bayar_validate'])) {
    if ($kembalian < 0) {
        echo '
        <script>
        window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
        alert("Nominal uang tidak mencukupi");
        </script>
        ';
    } else {
        // Insert the new order item
        $query = mysqli_query($con, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) VALUES ('$kode_order', '$uang', '$total_pembayaran')");
        if ($query) {
            echo '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Pembayaran AN ' . $pelanggan . ' berhasil \nUang Kembalian Sebesar Rp. ' . $kembalian . '");
            </script>
            ';
        } else {
            echo '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Pembayaran Gagal");
            </script>
            ';
        }
    } 
}
?>
