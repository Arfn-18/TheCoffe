
<?php
if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
    $page = 'pages/dashboard.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'menu') {
    $page = 'pages/daftar_menu.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'kategori') {
    $page = 'pages/kategori_menu.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'order') {
    $page = 'pages/order.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'order_item') {
    $page = 'pages/order_item.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'user') {
    $page = 'pages/user.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'report') {
    $page = 'pages/report.php';
    include 'main.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'login') {
    include 'pages/login.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    include 'controller/proses_logout.php';
} else {
    $page = 'pages/dashboard.php';
    include 'main.php';
}
?>