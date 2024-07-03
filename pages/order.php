<?php
include 'controller/connect.php';
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($con, "SELECT tb_order.*,tb_bayar.*,nama,level, SUM(harga_menu*jumlah) AS total_harga FROM tb_order 
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
        LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_order ORDER BY waktu_order DESC");
while ($data = mysqli_fetch_array($query)) {
    $result[] = $data;
}

// $select_kat_menu = mysqli_query($con, "SELECT id_kat,kategori_menu FROM tb_kategori_menu");
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Order | TheCoffe
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-between align-items-center mb-1">
                    <h4 class="fw-bold">Daftar List Order</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrder"><i class="bi bi-plus-circle"></i> Add Order</button>
                </div>
            </div>
            <!-- Modal Add Order-->
            <div class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="controller/proses_input_order.php" method="POST">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="kodeOrder" name="kode_order" value="<?= date('ymdHi') . rand(1, 9) ?>" readonly>
                                            <label for="kodeOrder">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Masukan Kode Order. </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="12" name="meja" required>
                                            <label for="floatingInput">Meja</label>
                                            <div class="invalid-feedback">
                                                Masukan Nomor Meja.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="pelanggan" class="form-control" id="floatingInput" placeholder="" required>
                                    <label for="floatingInput">Nama Pelanggan</label>
                                    <div class="invalid-feedback">
                                        Masukan Nama Pelanggan.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_order_validate" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add Order -->



            <?php
            if (empty($result)) {
                echo "Tidak ada data";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal Edit Order-->
                    <div class="modal fade" id="EditOrder<?= $row['id_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_edit_order.php" method="POST">
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kodeOrder" name="kode_order" value="<?= $row['id_order']; ?>" readonly>
                                                    <label for="kodeOrder">Kode Order</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Kode Order. </div>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="12" name="meja" value="<?= $row['meja']; ?>" required>
                                                    <label for="floatingInput">Meja</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Nomor Meja.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="pelanggan" class="form-control" id="floatingInput" placeholder="" value="<?= $row['pelanggan']; ?>" required>
                                            <label for="floatingInput">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Pelanggan.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="input_order_validate" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit Order -->

                    <!-- Modal Delete Order-->
                    <div class="modal fade" id="DeleteOrder<?= $row['id_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order <?= $row['pelanggan']. " | " .$row['id_order'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_delete_order.php" method="POST">
                                        <input type="hidden" name="kode_order" value="<?= $row['id_order']; ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $row['pelanggan']; ?>">
                                        <div class="col-lg-12 mb-3">
                                            <div class="alert alert-light" role="alert">Apakah anda yakin ingin menghapus Orderan atas Nama <b><?= $row['pelanggan']; ?></b> ?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="input_order_validate" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Delete Order -->

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
                                    <td>
                                        <a href="./?page=order_item&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="text-light text-decoration-none">
                                            <?= $row['id_order'] ?>
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="./?page=order_item&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="text-light text-decoration-none">
                                            <?= $row['pelanggan'] ?>
                                        </a>
                                    </td>
                                    <td><?= $row['meja'] ?></td>
                                    <td>Rp.<?= $row['total_harga'] !== null ? number_format($row['total_harga'], 0, ',', '.') : '0' ?></td>
                                    <td class="text-nowrap">
                                        <?php if ($row['level'] == 1) echo  "Admin" . " | " . $row['nama'];
                                        elseif ($row['level'] == 2) echo "Pelayan" . " | " . $row['nama'];
                                        elseif ($row['level'] == 3) echo "Kasir" . " | " . $row['nama'];
                                        elseif ($row['level'] == 4) echo "Dapur" . " | " . $row['nama'];
                                        else echo "User"; ?>
                                    </td>
                                    <td><?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>dibayar</span>" : "" ; ?></span></td>
                                    <td><?= $row['waktu_order'] ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="./?page=order_item&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="btn btn-info btn-sm" title="Detail"><i class="bi bi-exclamation-circle"></i></a>
                                            <div class="btn-group">
                                                <a href"#" class="btn btn-secondary btn-sm rounded" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item <?php echo (!empty($row['id_bayar'])) ? 'disabled' : ''; ?>" href="#" data-bs-toggle="modal" data-bs-target="#EditOrder<?= $row['id_order']; ?>"><i class="bi bi-pencil-square <?php echo (!empty($row['id_bayar'])) ? ' text-secondary' : 'text-warning'; ?>"></i> Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item <?php echo (!empty($row['id_bayar'])) ? 'disabled' : ''; ?>" href="#" data-bs-toggle="modal" data-bs-target="#DeleteOrder<?= $row['id_order']; ?>"><i class="bi bi-trash3 <?php echo (!empty($row['id_bayar'])) ? ' text-secondary' : 'text-danger'; ?>"></i> Delete</a></li>
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