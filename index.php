<?php
session_start();

if (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
    $page = 'pages/dashboard.php';
    include 'main.php';

} else if (isset($_GET['page']) && $_GET['page'] == 'menu') {
    if ($_SESSION['level_thecoffe']==1 || $_SESSION['level_thecoffe']==2 || $_SESSION['level_thecoffe']==3){
    $page = 'pages/daftar_menu.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'kategori') {
    if ($_SESSION['level_thecoffe']==1){
    $page = 'pages/kategori_menu.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'order') {
    if ($_SESSION['level_thecoffe']==1 || $_SESSION['level_thecoffe']==2 || $_SESSION['level_thecoffe']==3){
    $page = 'pages/order.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'order_item') {
    if ($_SESSION['level_thecoffe']==1 || $_SESSION['level_thecoffe']==2 || $_SESSION['level_thecoffe']==3){
    $page = 'pages/order_item.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'dapur') {
    if ($_SESSION['level_thecoffe']==1 || $_SESSION['level_thecoffe']==4){
    $page = 'pages/dapur.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'user') {
    if ($_SESSION['level_thecoffe']==1){
    $page = 'pages/user.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'report') {
    if ($_SESSION['level_thecoffe']==1){
    $page = 'pages/report.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }

} else if (isset($_GET['page']) && $_GET['page'] == 'viewitem') {
    if ($_SESSION['level_thecoffe']==1){
    $page = 'pages/view_item.php';
    include 'main.php';
    }else{
        $page = 'pages/dashboard.php';
        include 'main.php';
    }
    
} else if (isset($_GET['page']) && $_GET['page'] == 'login') {
    include 'pages/login.php';
} else if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    include 'controller/proses_logout.php';
} else {
    $page = 'pages/dashboard.php';
    include 'main.php';
}
?>