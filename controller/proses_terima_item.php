<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty(isset($_POST['terima_item_validate']))) {
    // Insert the new order item
    $query = mysqli_query($con, "update tb_list_order SET catatan='$catatan', status='1' WHERE id_list_order='$id'");
    if ($query) {
        // Query again to get the inserted menu details
        $menu_query = mysqli_query($con, "SELECT tb_daftar_menu.nama_menu FROM tb_list_order 
                                          LEFT JOIN tb_daftar_menu ON tb_list_order.menu = tb_daftar_menu.id 
                                          WHERE tb_list_order.id_list_order='$id'");
        $menu_data = mysqli_fetch_array($menu_query);
        $menu = $menu_data['nama_menu'];
        // Query again to get the inserted menu details
        $message = '
        <script>
        window.location = "../dapur";
        alert("Dapur telah menerima pesanan, dan mulai memasak ' . $menu . '");
        </script>
        ';
    } else {
        $message = '
        <script>
        window.location = "../dapur";
        alert("Dapur gagal menerima pesanan");
        </script>
        ';
    }
}
echo $message;
?>