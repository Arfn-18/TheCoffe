<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty(isset($_POST['edit_item_validate']))) {
        // Insert the new order item
        $query = mysqli_query($con, "update tb_list_order SET menu='$menu', jumlah='$jumlah', catatan='$catatan' WHERE id_list_order='$id'");
        if ($query) {
            // Query again to get the inserted menu details
            $message = '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Berhasil mengubah item di order ' . $kode_order . '");
            </script>
            ';
        } else {
            $message = '
            <script>
            window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
            alert("Gagal insert data");
            </script>
            ';
        }
}
echo $message;
?>