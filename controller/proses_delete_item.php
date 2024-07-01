
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";

if (!empty(isset($_POST['delete_item_validate']))) {
        $query = mysqli_query($con, "DELETE FROM tb_list_order WHERE id_list_order = '$id'");
        if ($query) {
            $massage = '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Data Berhasil Dihapus");
            </script>
            ';
        } else {
            $massage = '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Data Gagal Dihapus");
            </scrip>
            ';
        }
}
echo $massage;
?>