<?php
include "connect.php";
$query = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_thecoffe]'");
$row = mysqli_fetch_array($query);
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$password = md5("123123");

if (!empty(isset($_POST['input_user_validate']))) {
    $query = mysqli_query($con, "UPDATE tb_user SET password = '$password' WHERE id='$id' ");
    if ($query) {
        $massage = '
        <script>
        window.location = "../user";
        alert("Berhasil Mereset Pasword");
        </script>
        ';
    } else {
        $massage = '
        <script>
        window.location = "../user";
        alert("Reset Password Gagal");
        </script>
        ';
    }
}
echo $massage;
?>
