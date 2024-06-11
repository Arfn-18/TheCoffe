<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty(isset($_POST['input_user_validate']))) {
    $query = mysqli_query($con, "UPDATE tb_user SET nama = '$name', username = '$username', password = '$password', level = '$level', nohp = '$nohp', alamat = '$alamat' WHERE id = '$id'");
    if ($query) {
    $massage = '<script>window.location = "../user"; alert("Data Berhasil Diedit");</script>';
    } else {
        $massage = '
        <script>
        window.location = "../user";
        alert("Data Gagal Diedit");
        </scrip>
        ';
    }
}
echo $massage;
?>