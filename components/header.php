<?php
include "controller/connect.php";
$query = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_thecoffe]'");
$row = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand bg-primary sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="dashboard"><i class="bi bi-cup-hot-fill"></i> TheCoffe</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo($row['nama']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>