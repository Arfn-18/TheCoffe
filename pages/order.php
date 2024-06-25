<?php
include 'controller/connect.php';
$query = mysqli_query($con, "SELECT tb_order.*,nama, SUM(harga_menu*jumlah) AS total_harga FROM tb_order 
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
        LEFT JOIN tb_list_order ON tb_list_order.order = tb_order.id_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        GROUP BY id_order");
while ($data = mysqli_fetch_array($query)) {
    $result[] = $data;
}

// $select_kat_menu = mysqli_query($con, "SELECT id_kat,kategori_menu FROM tb_kategori_menu");
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Menu | TheCoffe
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
                            <form class="needs-validation" novalidate action="controller/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="uploadFoto">Foto Menu</label>
                                            <input type="file" class="form-control py-3 ps-4" id="uploadFoto" name="foto" required>
                                            <div class="invalid-feedback">
                                                Masukan Foto Menu<. </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama_menu" required>
                                                <label for="floatingInput">Nama Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nama Menu.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="keterangan" class="form-control" id="" style="height: 100px;"></textarea>
                                        <label for="floatingInput">Keterangan</label>
                                        <div class="invalid-feedback">
                                            Masukan Keterangan.
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="kat_menu" aria-label="Default select example" required>
                                                    <option value="" hidden selected>Pilih Kategori Menu</option>
                                                    <?php
                                                    foreach ($select_kat_menu as $valueKat) {
                                                        echo '<option value="' . $valueKat['id_kat'] . '">' . $valueKat['kategori_menu'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Kategori Makanan atau Minuman</label>
                                                <div class="invalid-feedback">
                                                    Pilih Kategori Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" name="harga_menu" class="form-control" id="floatingInput" placeholder="50000" required>
                                                <label for="floatingInput">Harga Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Harga Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="999" name="stok_menu" required>
                                                <label for="floatingInput">Stok Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Stok Menu.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_menu_validate" class="btn btn-primary">Save changes</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add Menu -->


            <!-- Modal View Menu-->
            <?php
            if (empty($result)) {
                echo "Tidak ada data";
            } else {
                foreach ($result as $row) {
            ?>
                    <div class="modal fade" id="viewUser<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col pb-3">
                                            <div style="width: 340px;" class="mx-auto">
                                                <img src="src/img/<?= $row['foto_menu'] ?>" class="img-fluid rounded" alt="...">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" disabled value="<?= $row['nama_menu']; ?>">
                                                <label for="floatingInput">Nama Menu</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" disabled value="<?= $row['kategori_menu']; ?>">
                                                <label for="floatingInput">Kategori</label>
                                            </div>
                                            <div class="row">
                                                <div class="col col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="floatingInput" disabled value="<?= $row['stok_menu']; ?>">
                                                        <label for="floatingInput">Stok Menu</label>
                                                    </div>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="floatingPassword" disabled value="Rp.<?= $row['harga_menu'] ?>">
                                                        <label for="floatingInput">Harga Menu</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="" style="height: 100px;" disabled><?= $row['keterangan_menu']; ?></textarea>
                                                <label for="floatingInput">Keterangan</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal View Menu -->

                    <!-- Modal Edit Menu-->
                    <div class="modal fade" id="EditUser<?= $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_edit_menu.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="uploadFoto">Foto Menu</label>
                                                    <input type="file" class="form-control py-3 ps-4" id="uploadFoto" name="foto" required>
                                                    <div class="invalid-feedback">
                                                        Masukan Foto Menu<. </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="floatingInput" value="<?= $row['nama_menu']; ?>" name="nama_menu" required>
                                                        <label for="floatingInput">Nama Menu</label>
                                                        <div class="invalid-feedback">
                                                            Masukan Nama Menu.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <textarea name="keterangan_menu" class="form-control" id="floatingInput" style="height: 100px;"><?= $row['keterangan_menu']; ?></textarea>
                                                <label for="floatingInput">Keterangan</label>
                                                <div class="invalid-feedback">
                                                    Masukan Keterangan.
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" name="kat_menu" aria-label="Default select example" required>
                                                            <option value="" hidden selected>Pilih Kategori Menu</option>
                                                            <?php
                                                            foreach ($select_kat_menu as $valueKat) {
                                                                if ($row['id_kat'] == $valueKat['id_kat']) {
                                                                    echo '<option value="' . $valueKat['id_kat'] . '" selected>' . $valueKat['kategori_menu'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $valueKat['id_kat'] . '">' . $valueKat['kategori_menu'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="floatingInput">Kategori Makanan atau Minuman</label>
                                                        <div class="invalid-feedback">
                                                            Pilih Kategori Menu.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" name="harga_menu" class="form-control" id="floatingInput" value="<?= $row['harga_menu']; ?>" required>
                                                        <label for="floatingInput">Harga Menu</label>
                                                        <div class="invalid-feedback">
                                                            Masukan Harga Menu.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="floatingInput" value="<?= $row['stok_menu']; ?>" name="stok_menu" required>
                                                        <label for="floatingInput">Stok Menu</label>
                                                        <div class="invalid-feedback">
                                                            Masukan Stok Menu.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="input_menu_validate" class="btn btn-primary">Save changes</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit Menu -->

                    <!-- Modal Delete Menu-->
                    <div class="modal fade" id="DeleteUser<?= $row['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_delete_menu.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="foto" value="<?php echo $row['foto_menu']; ?>">
                                        <input type="hidden" name="nama_menu" value="<?php echo $row['nama_menu']; ?>">
                                        <div class="col-lg-12 mb-3">
                                            <div class="alert alert-light" role="alert">Apakah anda yakin ingin menghapus menu <b><?= $row['nama_menu']; ?></b> ?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="input_menu_validate" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Delete Menu -->

                <?php
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr class="align-middle">
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['kode_order'] ?></td>
                                    <td><?= $row['pelanggan'] ?></td>
                                    <td><?= $row['meja'] ?></td>
                                    <td><?= $row['total_harga'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><span class="alert alert-success rounded-pill py-0 pb-1 px-3 text-white font-bold"><?= $row['status'] ?></span></td>
                                    <td><?= $row['waktu_order'] ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-info btn-sm" title="Detail" data-bs-toggle="modal" data-bs-target="#viewUser<?= $row['id_order']; ?>"><i class="bi bi-exclamation-circle"></i></button>
                                            <div class="btn-group">
                                                <a href"#" class="btn btn-secondary btn-sm rounded" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#EditUser<?= $row['id']; ?>"><i class="bi bi-pencil-square text-warning"></i> Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#DeleteUser<?= $row['id']; ?>"><i class="bi bi-trash3 text-danger"></i> Delete</a></li>
                                                </ul>
                                            </div>
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