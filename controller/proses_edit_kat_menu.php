<?php
include "connect.php";
$id_kat = (isset($_POST['id_kat'])) ? htmlentities($_POST['id_kat']) : "";
$jenis_menu = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
$kat_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu']) : "";

if (!empty(isset($_POST['input_kategori_validate']))) {
    $select = mysqli_query($con, "SELECT * FROM tb_kategori_menu WHERE kategori_menu = '$kat_menu' AND id_kat != '$id_kat'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>window.location = "../kategori"; alert("Kategori Menu ' . $kat_menu . ' sudah terdaftar");</script>
        ';
    } else {
        $query = mysqli_query($con, "UPDATE tb_kategori_menu SET kategori_menu = '$kat_menu', jenis_menu = '$jenis_menu' WHERE id_kat = '$id_kat'");
        if ($query) {
            $massage = '<script>window.location = "../kategori"; alert("Data Kategori Menu ' . $kat_menu . ' Berhasil Diedit");</script>';
        } else {
            $massage = '<script>window.location = "../user"; alert("Data Gagal Diedit");</scrip>
        ';
        }
    }
}
echo $massage;
