<?php
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty(isset($_POST['input_user_validate']))) {
    $select = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '
        <script>
        window.location = "../user";
        alert("Username '. $username .' sudah terdaftar");
        </script>
        ';
    } else {
        $query = mysqli_query($con, "INSERT INTO tb_user (nama, username, password, level, nohp, alamat) VALUES ('$name', '$username', '$password', '$level', '$nohp', '$alamat')");
        if ($query) {
            $massage = '
        <script>
        window.location = "../user";
        alert("Berhasil Menambahkan '. $username .'");
        </script>
        ';
        } else {
            $massage = '
        <script>
        window.location = "../user";
        alert("Gagal insert data");
        </script>
        ';
        }
    }
}
echo $massage;
