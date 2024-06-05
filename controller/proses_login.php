<?php
session_start();
include "connect.php";

$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

if (!empty(isset($_POST['username']))) {
    $query = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $return = mysqli_fetch_array($query);
    if ($return) {
        $_SESSION['username_followup'] = $username;
        header('location:../dashboard');
    } else {
?>
        <script>
            alert("Username dan Password tidak sesuai");
            window.location = "../login";
        </script>
<?php
    }
}
?>