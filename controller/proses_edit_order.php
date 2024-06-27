<?php
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";

if (!empty(isset($_POST['input_order_validate']))) {
    $select = mysqli_query($con, "SELECT * FROM tb_order WHERE pelanggan = '$pelanggan' AND meja = '$meja' AND id_order != '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '
        <script>
        window.location = "../order";
        alert("Nama Pelanggan : ' . $pelanggan . ' meja : ' . $meja . ' sudah terdaftar");
        </script>
        ';
    } else {
        $query = mysqli_query($con, "UPDATE tb_order SET id_order = '$kode_order', pelanggan = '$pelanggan', meja = '$meja' WHERE id_order = '$kode_order'");
        if ($query) {
            $massage = '<script>window.location = "../order"; alert("Data Order ' . $kode_order . ' Berhasil Diedit");</script>';
        } else {
            $massage = '
        <script>
        window.location = "../order";
        alert("Data Gagal Diedit");
        </scrip>
        ';
        }
    }
}
echo $massage;
