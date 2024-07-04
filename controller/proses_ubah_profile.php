<?php
session_start();
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

$massage = ""; // Initialize the $massage variable

if (!empty(isset($_POST['ubah_profile_validate']))) {
    $query = mysqli_query($con, "UPDATE tb_user SET nama = '$nama', nohp = '$nohp', alamat = '$alamat' WHERE id = '$id'");
    if ($query) {
        $massage = '<script>alert("Profile Berhasil Diubah"); window.history.back();</script>';
    } else {
        $massage = '<script>alert("Profile Gagal Diubah"); window.history.back();</script>';
    }
}
echo $massage;
?>
