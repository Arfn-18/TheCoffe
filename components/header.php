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
                        <?php echo ($row['nama']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ubahPasword<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Change Password -->

<div class="modal fade" id="ubahPasword<?php echo $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="controller/proses_ubah_password.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" id="floatingInput" placeholder="username@example.com" name="username" required value="<?php echo $_SESSION['username_thecoffe']; ?>">
                        <label for="floatingInput">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingpassword" placeholder="********" name="passwordlama" required>
                        <label for="floatingPassword">Password Lama</label>
                        <div class="invalid-feedback">
                            Masukan Password Lama.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" name="passwordbaru" class="form-control" id="floatingPassword" placeholder="********" required>
                                <label for="floatingpassword">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukan Password Baru.
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" name="repasswordbaru" class="form-control" id="floatingPassword" placeholder="********" required>
                                <label for="floatingpassword">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukan Ulang Password Baru.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="ubah_password_validate" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Modal Changw Password -->
