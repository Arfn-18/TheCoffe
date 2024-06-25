<?php
include "connect.php";
$id_kat = (isset($_POST['id_kat'])) ? htmlentities($_POST['id_kat']) : "";
$jenis_menu = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
$kat_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu']) : "";

if (!empty(isset($_POST['input_kategori_validate']))) {
    $select = mysqli_query($con, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$kat_menu'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>window.location = "../kategori"; alert("Kategori Menu '. $kat_menu . ' sudah terdaftar");</script>
        ';
    } else {
        $query = mysqli_query($con, "INSERT INTO tb_kategori_menu (jenis_menu, kategori_menu) VALUES ('$jenis_menu', '$kat_menu')");
        if ($query) {
            $massage = '<script>window.location = "../kategori"; alert("Berhasil Menambahkan '. $kat_menu .'");</script>
        ';
        } else {
            $massage = '<script>window.location = "../kategori"; alert("Gagal insert data");</script>
        ';
        }
    }
}
echo $massage;
