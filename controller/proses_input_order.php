<?php
session_start();
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";

if (!empty(isset($_POST['input_order_validate']))) {
    $select = mysqli_query($con, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '
        <script>
        window.location = "../order";
        alert("Kode Order : ' . $kode_order . ' sudah terdaftar");
        </script>
        ';
    } else {
        $query = mysqli_query($con, "INSERT INTO tb_order (id_order, pelanggan, meja, pelayan) VALUES ('$kode_order', '$pelanggan', '$meja', $_SESSION[id_thecoffe])");
        if ($query) {
            $massage = '
        <script>
        window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
        alert("Berhasil Menambahkan ' . $kode_order . ' : ' . $pelanggan . '");
        </script>
        ';
        } else {
            $massage = '
        <script>
        window.location = "../order";
        alert("Gagal insert data");
        </script>
        ';
        }
    }
}
echo $massage;
