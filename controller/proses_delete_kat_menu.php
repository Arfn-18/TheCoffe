
<?php
include "connect.php";
$id_kat = (isset($_POST['id_kat'])) ? htmlentities($_POST['id_kat']) : "";
$kat_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu']) : "";

if (!empty(isset($_POST['input_kategori_validate']))) {
    $select = mysqli_query($con, "SELECT kategori FROM tb_daftar_menu WHERE kategori = '$id_kat'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '
        <script>
        window.location = "../kategori";
        alert("Kategori Menu ' . $kat_menu . ' sudah digunakan di Daftar Menu");
        </script>
        ';
    } else {

        $query = mysqli_query($con, "DELETE FROM tb_kategori_menu WHERE id_kat = '$id_kat'");
        if ($query) {
            $massage = '<script>window.location = "../kategori"; alert("Data Kategori Menu ' . $kat_menu . ' Berhasil Dihapus");</script>';
        } else {
            $massage = '
            <script>
            window.location = "../kategori";
            alert("Data Gagal Dihapus");
            </scrip>
            ';
        }
    }
}
echo $massage;
?>