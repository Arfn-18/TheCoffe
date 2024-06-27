<?php
include 'controller/connect.php';
// echo $_GET['order'];

$query = mysqli_query($con, "SELECT *, SUM(harga_menu*jumlah) AS total_harga FROM tb_list_order 
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        GROUP BY id_list_order
        HAVING tb_list_order.order = $_GET[order]");

$kode_order = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($data = mysqli_fetch_array($query)) {
    $result[] = $data;
    // $kode_order = $data['id_order'];
    // $meja = $data['meja'];
    // $pelanggan = $data['pelanggan'];
    // $total_harga = $data['total_harga'];
}

$select_daftar_menu = mysqli_query($con, "SELECT id,nama_menu FROM tb_daftar_menu");
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Order Item | TheCoffe
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex gap-2 align-items-center mb-2">
                    <a href="order" class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-left"></i> Exit</a>
                    <h4 class="fw-bold mt-1">Checkout</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="kodeOrder" value="<?= $kode_order; ?> " disabled>
                        <label for="kodeOrder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="meja" value="<?= $meja; ?>" disabled>
                        <label for="meja">Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nemaPelanggan" value="<?= $pelanggan; ?>" disabled>
                        <label for="nemaPelanggan">Nama Pelanggan</label>
                    </div>
                </div>
            </div>


            <!-- Modal Add Item-->
            <div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="controller/proses_input_item.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="kat_menu" aria-label="Default select example" required>
                                                <option value="" hidden selected>Pilih Daftar Menu</option>
                                                <?php
                                                foreach ($select_daftar_menu as $valueDaf) {
                                                    echo '<option value="' . $valueDaf['id'] . '">' . $valueDaf['nama_menu'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="" name="jumlah" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="catatan" class="form-control" id="" style="height: 100px;"></textarea>
                                    <label for="floatingInput">Catatan</label>
                                    <div class="invalid-feedback">
                                        Masukan Keterangan.
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
            <!-- End Modal Add Item -->


            <!-- Modal View Menu-->
            <?php
            if (empty($result)) {
                echo '<div class="mb-3">Tidak ada data</div>';
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
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $no = 1;
                            $total_pembayaran = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr class="align-middle">
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $row['nama_menu'] ?></td>
                                    <td>Rp.<?= number_format($row['harga_menu'], 0, ',', '.') ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td>Rp.<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
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
                                $total_pembayaran += $row['total_harga'];
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="align-middle ">
                                <td colspan="4" class="fw-bold">
                                    Total Pembayaran
                                </td>
                                <td class="fw-bold">Rp.<?= number_format($total_pembayaran, 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php
            }
            ?>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem"><i class="bi bi-plus-circle"></i> Menu</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
            </div>
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