<?php
include 'controller/connect.php';
$query = mysqli_query($con, "SELECT * FROM tb_user");
while ($data = mysqli_fetch_array($query)) {
    $user[] = $data;
}
?>

<div class="konten col-lg rounded">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman User
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold">Daftar User</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"><i class="bi bi-person-add"></i> Add User</button>
                </div>
            </div>
            <!-- Modal Add User-->
            <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="controller/proses_user.php" method="POST">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="username@example.com" name="username" required>
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Masukan Username Email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingInput" placeholder="********" name="password" value="123123" required>
                                            <label for="floatingPassword">Password</label>
                                            <div class="invalid-feedback">
                                                Masukan Password.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="level" aria-label="Default select example" required>
                                                <option selected disabled hidden>Pilih Level</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Pelayan</option>
                                                <option value="3">Kasir</option>
                                                <option value="4">Dapur</option>
                                            </select>
                                            <label for="floatingInput">Level User</label>
                                            <div class="invalid-feedback">
                                                Masukan Level User.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="nohp" class="form-control" id="floatingPassword" placeholder="08xxxxxxx" required>
                                            <label for="floatingInput">No Hp</label>
                                            <div class="invalid-feedback">
                                                Masukan Nomor Hp.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form-control" id="" style="height: 100px;" required></textarea>
                                    <label for="floatingInput">Alamat</label>
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

            <!-- Modal View User-->
            <?php
            foreach ($user as $row) {
            ?>
                <div class="modal fade" id="viewUser<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="nama" disabled value="<?php echo $row['nama']; ?>">
                                    <label for="floatingInput">Nama</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="username" disabled value="<?php echo $row['username']; ?>">
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="password" value="123123" disabled value="<?php echo $row['password']; ?>">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="level" aria-label="Default select example" disabled>
                                        <?php
                                        $data_level = array("Admin", "Pelayan", "Kasir", "Dapur");
                                        foreach ($data_level as $key => $value) {
                                            if ($row['level'] == $key + 1) {
                                                echo "<option value='$key' selected>$value</option>";
                                            } else {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingInput">Level User</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" name="nohp" class="form-control" id="floatingPassword" disabled value="<?php echo $row['nohp']; ?>">
                                    <label for="floatingInput">No Hp</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form-control" id="" style="height: 100px;" disabled><?php echo $row['alamat']; ?></textarea>
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal View User -->

                <!-- Modal Edit User-->
            <?php
            }
            foreach ($user as $row) {
            ?>
                <div class="modal fade" id="EditUser<?php echo $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_edit_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required value="<?php echo $row['nama']; ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nama.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="username@example.com" name="username" required value="<?php echo $row['username']; ?>">
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Masukan Username Email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingInput" placeholder="********" name="password" value="123123" required value="<?php echo $row['password']; ?>">
                                                <label for="floatingPassword">Password</label>
                                                <div class="invalid-feedback">
                                                    Masukan Password.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="level" aria-label="Default select example" required>
                                                    <?php
                                                    $data_level = array("Admin", "Pelayan", "Kasir", "Dapur");
                                                    foreach ($data_level as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option value=" . ($key + 1) . " selected>$value</option>";
                                                        } else {
                                                            echo "<option value=" . ($key + 1) . ">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Level User</label>
                                                <div class="invalid-feedback">
                                                    Masukan Level User.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="number" name="nohp" class="form-control" id="floatingPassword" placeholder="08xxxxxxx" required value="<?php echo $row['nohp']; ?>">
                                                <label for="floatingInput">No Hp</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nomor Hp.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="alamat" class="form-control" id="" style="height: 100px;" required><?php echo $row['alamat']; ?></textarea>
                                        <label for="floatingInput">Alamat</label>
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
                <!-- End Modal Edit User -->

                <!-- Modal Delete User-->
            <?php
            }
            foreach ($user as $row) {
            ?>
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
                                            Apakah anda yakin ingin menghapus user <b><?php echo $row['username']; ?></b> ?
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="input_user_validate" class="btn btn-danger" <?php echo ($row['username'] == $_SESSION['username_thecoffe']) ? 'disabled' : '' ; ?>>Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Delete User -->


            <?php
            }
            if (empty($user)) {
                echo "Tidak ada data";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php if ($row['level'] == 1) echo "Admin";
                                        elseif ($row['level'] == 2) echo "Pelayan";
                                        elseif ($row['level'] == 3) echo "Kasir";
                                        elseif ($row['level'] == 4) echo "Dapur";
                                        else echo "User"; ?></td>
                                    <td><?php echo $row['nohp'] ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-info btn-sm" title="Detail" data-bs-toggle="modal" data-bs-target="#viewUser<?php echo $row['id']; ?>"><i class="bi bi-exclamation-circle"></i></i></button>
                                            <button class="btn btn-warning btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#EditUser<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#DeleteUser<?php echo $row['id']; ?>"><i class="bi bi-trash3"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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