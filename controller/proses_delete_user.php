
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";

if (!empty(isset($_POST['input_user_validate']))) {
    $query = mysqli_query($con, "DELETE FROM tb_user WHERE id = '$id'");
    if ($query) {
    $massage = '<script>window.location = "../user"; alert("Data ' . $nama . ' Berhasil Dihapus");</script>';
    } else {
        $massage = '
        <script>
        window.location = "../user";
        alert("Data Gagal Dihapus");
        </scrip>
        ';
    }
}
echo $massage;
?>