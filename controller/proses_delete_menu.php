
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";

if (!empty(isset($_POST['input_menu_validate']))) {
    $query = mysqli_query($con, "DELETE FROM tb_daftar_menu WHERE id = '$id'");
    if ($query) {
        unlink("../src/img/" . $foto);
    $massage = '<script>window.location = "../menu"; alert("Menu ' . $nama_menu . ' Berhasil Dihapus");</script>';
    } else {
        $massage = '
        <script>
        window.location = "../menu";
        alert("Menu Gagal Dihapus");
        </scrip>
        ';
    }
}
echo $massage;
?>