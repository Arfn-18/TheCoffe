<?php
include 'controller/connect.php';
$query = mysqli_query($con, "SELECT * FROM tb_kategori_menu");
while ($data = mysqli_fetch_array($query)) {
    $kategori[] = $data;
}
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Kategori Menu | TheCoffe
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center mb-1">
                    <h4 class="fw-bold">Kategori Menu</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategori"><i class="bi bi-plus-circle"></i> Add Kategori</button>
                </div>
            </div>

            <!-- Modal Add Kategori-->
            <div class="modal fade" id="addKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="controller/proses_input_kat_menu.php" method="POST">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Nasi" name="kategori_menu" required>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Kategori Menu.
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="jenis_menu" aria-label="Default select example" required>
                                                <option selected hidden value="">Pilih Jenis Menu</option>
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                            </select>
                                            <label for="floatingInput">Level User</label>
                                            <div class="invalid-feedback">
                                                Masukan Jenis Menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_kategori_validate" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add Kategori -->

            <?php
            foreach ($kategori as $row) {
            ?>
                <!-- Modal Edit Kategori-->
                <div class="modal fade" id="EditKategori<?= $row['id_kat']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_edit_kat_menu.php" method="POST">
                                    <input type="hidden" name="id_kat" value="<?= $row['id_kat']; ?>">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Nasi" name="kategori_menu" required value="<?= $row['kategori_menu']; ?>">
                                                <label for="floatingInput">Kategori Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Kategori Menu.
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="jenis_menu" aria-label="Default select example" required>
                                                    <?php
                                                    $data_jenis = array("Makanan", "Minuman");
                                                    foreach ($data_jenis as $key => $value) {
                                                        if ($row['jenis_menu'] == $key + 1) {
                                                            echo "<option value=" . ($key + 1) . " selected>$value</option>";
                                                        } else {
                                                            echo "<option value=" . ($key + 1) . ">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Jenis Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukan Jenis User.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_kategori_validate" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Edit Kategori -->

                <!-- Modal Delete Kategori-->
                <div class="modal fade" id="DeleteKategori<?= $row['id_kat']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Kategori</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="controller/proses_delete_kat_menu.php" method="POST">
                                    <input type="hidden" name="id_kat" value="<?= $row['id_kat']; ?>">
                                    <input type="hidden" name="kategori_menu" value="<?= $row['kategori_menu']; ?>">
                                    <div class="col-lg-12 mb-3">
                                        <div class="alert alert-light" role="alert">Apakah anda yakin ingin menghapus Kategori <b><?= $row['kategori_menu']; ?></b> ?</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="input_kategori_validate" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Delete Kategori -->

            <?php
            }
            if (empty($kategori)) {
                echo "Tidak ada data";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori Menu</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kategori as $row) {
                            ?>
                                <tr class="align-middle">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td><?= ($row['jenis_menu'] == 1) ? 'Makanan' : 'Minuman' ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-warning btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#EditKategori<?php echo $row['id_kat']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#DeleteKategori<?php echo $row['id_kat']; ?>"><i class="bi bi-trash3"></i></button>
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