<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty(isset($_POST['input_user_validate']))) {
    $query = mysqli_query($con, "DELETE FROM tb_user WHERE id='$id' ");
    if ($query) {
        $massage = '
        <script>
        window.location = "../user";
        alert("Berhasil hapus data");
        </script>
        ';
    } else {
        $massage = '
        <script>
        window.location = "../user";
        alert("Gagal hapus data");
        </script>
        ';
    }
}
echo $massage;
?>
