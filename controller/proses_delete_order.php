
<?php
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";

if (!empty(isset($_POST['input_order_validate']))) {
    $select = mysqli_query($con, "SELECT kode_order FROM tb_list_order WHERE kode_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>window.location = "../order"; alert("Data ' . $pelanggan . ' Gagal Dihapus, Karena terdapat list order");</script>';
    } else {
        $query = mysqli_query($con, "DELETE FROM tb_order WHERE id_order = '$kode_order'");
        if ($query) {
            $massage = '<script>window.location = "../order"; alert("Data ' . $pelanggan . ' Berhasil Dihapus");</script>';
        } else {
            $massage = '
            <script>
            window.location = "../order";
            alert("Data Gagal Dihapus");
            </scrip>
            ';
        }
    }
}
echo $massage;
?>