<?php
include 'controller/connect.php';
$query = mysqli_query($con, "SELECT * FROM tb_daftar_menu");
while ($data = mysqli_fetch_array($query)) {
    $daftar_menu[] = $data;
}
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Menu
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center mb-1">
                    <h4 class="fw-bold">Daftar Menu</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"><i class="bi bi-plus-circle"></i> Add Menu</button>
                </div>
            </div>
            <!-- Modal Add Menu-->
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="controller/proses_user.php" method="POST">
                                <div class="row">
                                <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control " id="floatingInput" name="password" required>
                                            <label for="floatingPassword">Foto Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Foto Menu<.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="username@example.com" name="username" required>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Kategori Menu.
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="999" name="stok" required>
                                            <label for="floatingInput">Stok Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Stok Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="nohp" class="form-control" id="floatingInput" placeholder="50000" required>
                                            <label for="floatingInput">Harga Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Harga Menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form-control" id="" style="height: 100px;" required></textarea>
                                    <label for="floatingInput">Keterangan</label>
                                    <div class="invalid-feedback">
                                        Masukan Alamat.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_user_validate" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add User -->


            <!-- Modal View Menu-->
            <?php
            foreach ($daftar_menu as $row) {
            ?>
                <div class="modal fade" id="viewUser<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="nama-menu" disabled value="<?php echo $row['nama_menu']; ?>">
                                    <label for="floatingInput">Nama Menu</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="kategori_menu" disabled value="<?php echo $row['kategori_menu']; ?>">
                                    <label for="floatingInput">Kategori</label>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="username" disabled value="<?php echo $row['stok_menu']; ?>">
                                            <label for="floatingInput">Stok Menu</label>
                                        </div>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nohp" class="form-control" id="floatingPassword" placeholder="08xxxxxxx" disabled value="Rp.<?php echo $row['harga_menu'] ?>">
                                            <label for="floatingInput">Harga Menu</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="password" disabled value="<?php echo $row['password']; ?>">
                                    <label for="floatingPassword">Password</label>
                                </div> -->
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form-control" id="" style="height: 100px;" disabled><?php echo $row['keterangan_menu']; ?></textarea>
                                    <label for="floatingInput">Keterangan</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal View Menu -->

                <!-- Modal Edit Menu-->
                <div class="modal fade" id="EditUser<?php echo $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_edit_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama_menu" required value="<?php echo $row['nama_menu']; ?>">
                                                <label for="floatingInput">Nama Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nama Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="username@example.com" name="kategori_menu" required value="<?php echo $row['kategori_menu']; ?>">
                                                <label for="floatingInput">Kategori Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Kategori Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingInput" placeholder="********" name="password" value="123123" required value="<?php echo $row['password']; ?>">
                                                <label for="floatingPassword">Password</label>
                                                <div class="invalid-feedback">
                                                    Masukan Password.
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="stok_menu" value="<?php echo $row['stok_menu']; ?>">
                                            <label for="floatingInput">Stok Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Stok Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="number" name="harga_menu" class="form-control" id="floatingInput" placeholder="50000" required value="<?php echo $row['harga_menu']; ?>">
                                                <label for="floatingInput">Harga Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Harga Menu.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="keterangan_menu" class="form-control" id="floatingInput" style="height: 100px;" required><?php echo $row['keterangan_menu']; ?></textarea>
                                        <label for="floatingInput">Keterangan Menu</label>
                                        <div class="invalid-feedback">
                                            Masukan Keterangan Menu.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_user_validate" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit Menu -->

                <!-- Modal Delete Menu-->
                <div class="modal fade" id="DeleteUser<?php echo $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_delete_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="col-lg-12 mb-3">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_thecoffe']) {
                                            echo '<div class="alert alert-danger" role="alert">Anda tidak dapat menghapus user yang sedang login</div>';
                                        } else {
                                        ?>
                                            Apakah anda yakin ingin menghapus Menu <b><?php echo $row['username']; ?></b> ?
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="input_menu_validate" class="btn btn-danger" <?php echo ($row['username'] == $_SESSION['username_thecoffe']) ? 'disabled' : ''; ?>>Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Delete Menu -->

                <!-- Modal Reset Password Menu-->
                <div class="modal fade" id="resetPasswordUser<?php echo $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_reset_password.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="col-lg-12 mb-3">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_thecoffe']) {
                                            echo '<div class="alert alert-danger" role="alert">Anda tidak dapat mereset password User yang sedang login</div>';
                                        } else {
                                        ?>
                                            Apakah anda yakin ingin mereset password user <b><?php echo $row['username']; ?></b>?, <br>Password bawaan sistem: <b>123123</b>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="input_user_validate" class="btn btn-danger" <?php echo ($row['username'] == $_SESSION['username_thecoffe']) ? 'disabled' : ''; ?>>Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Reset Password Menu -->

                <!-- Modal Hapus Menu-->
                <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/delete_user.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_thecoffe']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat menghapus diri anda sendiri</div>";
                                        } else {
                                            echo "Apakah anda yakin ingin menghapus user <b>< $row[username]></b>";
                                        }
                                        ?>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_user_validate" class="btn btn-danger" <?php echo ($row['username'] == $_SESSION['username_thecoffe']) ? 'disabled' : ''; ?>>Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Hapus Menu -->

            <?php
            }
            if (empty($daftar_menu)) {
                echo "Tidak ada data";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Picture</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">kategori</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($daftar_menu as $row) {
                            ?>
                                <tr class="align-middle">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td>
                                        <div style="width: 76px;">
                                            <img src="src/img/<?php echo $row['foto_menu'] ?>.png" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td>Rp.<?php echo $row['harga_menu'] ?></td>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td><?php echo $row['stok_menu'] ?></td>
                                    <td><?php echo $row['keterangan_menu'] ?></td>
                                    <td>
                                    <div class="d-flex gap-1">
                                            <button class="btn btn-info btn-sm" title="Detail" data-bs-toggle="modal" data-bs-target="#viewUser<?php echo $row['id']; ?>"><i class="bi bi-exclamation-circle"></i></button>
                                            <div class="btn-group">
                                                <a href"#" class="btn btn-secondary btn-sm rounded" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewUser<?php echo $row['id']; ?>"><i class="bi bi-exclamation-circle text-success"></i> Detail</a></li> -->
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#EditUser<?php echo $row['id']; ?>"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#DeleteUser<?php echo $row['id']; ?>"><i class="bi bi-trash3 text-danger"></i> Delete</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordUser<?php echo $row['id']; ?>"><i class="bi bi-unlock text-info"></i> Reset Password</a></li>
                                                </ul>
                                            </div>
                                            <!-- <button class="btn btn-warning btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#EditUser<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#DeleteUser<?php echo $row['id']; ?>"><i class="bi bi-trash3"></i></button> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>