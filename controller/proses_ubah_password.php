
<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "";
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : "";

if (!empty(isset($_POST['ubah_password_validate']))) {
    $query = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_thecoffe]' AND password = '$passwordlama'");
    $return = mysqli_fetch_array($query);
    if ($return) {
        if ($passwordbaru == $repasswordbaru) {
            $query = mysqli_query($con, "UPDATE tb_user SET password = '$passwordbaru' WHERE id = '$id'");
            if ($query) {
                $massage = '<script>alert("Password Berhasil Diubah"); window.history.back();</script>';
            } else {
                $massage = '
                <script>
                window.history.back();
                alert("Password Gagal Diubah");
                </script>
                ';
            }
        } else {
            $massage = '
            <script>
            window.history.back();
            alert("Password Baru Tidak Sesuai");
            </script>
            ';
        }
    } else {
        $massage = '
            <script>
            window.history.back();
            alert("Pasword Lama Tidak Sesuai");
            </script>
            ';
    }
} else{
    header('location:../dashboard');
}
echo $massage;
?>