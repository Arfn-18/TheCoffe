<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan_menu'])) ? htmlentities($_POST['keterangan_menu']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga_menu = (isset($_POST['harga_menu'])) ? htmlentities($_POST['harga_menu']) : "";
$stok_menu = (isset($_POST['stok_menu'])) ? htmlentities($_POST['stok_menu']) : "";
// $alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../src/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty(isset($_POST['input_menu_validate']))) {
    //cek gambar atau bukan
    $cek = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($cek === false) {
        $message = "File bukan gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "File sudah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES["foto"]["size"] > 500000) { //500kb
                $message = "File terlalu besar";
                $statusUpload = 0;
            } else {
                if ($image_type != "jpg" && $image_type != "png" && $image_type != "jpeg" && $image_type != "gif") {
                    $message = "File yang diperbolehkan JPG, PNG, JPEG, GIF";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>window.location = "../menu"; alert("' . $message . ', Gagal upload gambar");</script>';
    } else {
        $select = mysqli_query($con, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu' AND id != '$id'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>window.location = "../menu"; alert("Nama Menu yang dimasukan sudah terdaftar");</script>';
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $query = mysqli_query($con, "UPDATE tb_daftar_menu SET foto_menu = '" . $kode_rand . $_FILES["foto"]["name"] . "', nama_menu = '$nama_menu', keterangan_menu = '$keterangan', kategori = '$kat_menu', harga_menu = '$harga_menu', stok_menu = '$stok_menu' WHERE id = '$id'");
                if ($query) {
                    $message = '<script>window.location = "../menu"; alert("Berhasil Update Menu");</script>';
                } else {
                    $message = '<script>window.location = "../menu"; alert("Gagal Update Menu");</script>';
                }
            } else {
                $message = '<script>window.location = "../menu"; alert("Gagal upload gambar");</script>';
            }
        }
    }
}
echo $message;