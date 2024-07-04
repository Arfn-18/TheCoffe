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
    $select = mysqli_query($con, "SELECT tb_list_order.*, tb_daftar_menu.nama_menu 
                                  FROM tb_list_order 
                                  LEFT JOIN tb_daftar_menu ON tb_list_order.menu = tb_daftar_menu.id
                                  WHERE tb_list_order.menu = '$menu' AND tb_list_order.kode_order = '$kode_order' AND tb_list_order.id_list_order != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $nama_menu = $row['nama_menu'];
        $message = '
        <script>
        window.location = "../?page=order_item&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
        alert("Menu : ' . $nama_menu . ' sudah terdaftar");
        </script>
        ';
    } else {
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
}
echo $message;
?>