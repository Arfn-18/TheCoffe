<?php
include 'controller/connect.php';
// echo $_GET['order'];

$query = mysqli_query($con, "SELECT *, SUM(harga_menu*jumlah) AS total_harga FROM tb_list_order 
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_list_order
        HAVING tb_list_order.kode_order = $_GET[order]");

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
                            <form class="needs-validation" novalidate action="controller/proses_input_item.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" aria-label="Default select example" required>
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
                                                Masukan Jumlah Porsi.
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
                                    <button type="submit" name="input_item_validate" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add Item -->

            <?php
            if (empty($result)) {
                echo '<div class="mb-3">Order ini belum memesan item apapun.</div>';
            } else {
                foreach ($result as $row) {
            ?>

                    <!-- Modal Edit Menu-->
                    <div class="modal fade" id="editItem<?= $row['id_list_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_edit_item.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" aria-label="Default select example" required>
                                                        <option value="" hidden selected>Pilih Daftar Menu</option>
                                                        <?php
                                                        foreach ($select_daftar_menu as $valueDaf) {
                                                            if ($row['menu'] == $valueDaf['id']) {
                                                                echo '<option selected value="' . $valueDaf['id'] . '">' . $valueDaf['nama_menu'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $valueDaf['id'] . '">' . $valueDaf['nama_menu'] . '</option>';
                                                            }
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
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="" name="jumlah" required value="<?= $row['jumlah'] ?>">
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Jumlah Porsi.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea name="catatan" class="form-control" id="" style="height: 100px;"><?= $row['catatan'] ?></textarea>
                                            <label for="floatingInput">Catatan</label>
                                            <div class="invalid-feedback">
                                                Masukan Keterangan.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_item_validate" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit Menu -->

                    <!-- Modal Delete Menu-->
                    <div class="modal fade" id="deleteItem<?= $row['id_list_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="controller/proses_delete_item.php" method="POST">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']; ?>">
                                        <div class="col-lg-12 mb-3">
                                            <div class="alert alert-light" role="alert">Apakah anda yakin ingin menghapus <b><?= $row['nama_menu']; ?></b> dari list order?</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_item_validate" class="btn btn-danger">Delete</button>
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

                <!-- Modal Bayar -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Menu</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Total Harga</th>
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
                                                    <td class="text-nowrap"><?= $row['nama_menu'] ?></td>
                                                    <td>Rp.<?= number_format($row['harga_menu'], 0, ',', '.') ?></td>
                                                    <td><?= $row['jumlah'] ?></td>
                                                    <td><?= $row['catatan'] ?></td>
                                                    <td><?= $row['status'] ?></td>
                                                    <td>Rp.<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                                </tr>
                                            <?php
                                                $total_pembayaran += $row['total_harga'];
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="align-middle ">
                                                <td colspan="6" class="fw-bold">
                                                    Total Pembayaran
                                                </td>
                                                <td class="fw-bold">Rp.<?= number_format($total_pembayaran, 0, ',', '.') ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <span class="text-danger fs-5 fw-semibold">Apakah anda yakin ingin melakukan pembayaran</span>
                                <form class="needs-validation" novalidate action="controller/proses_bayar.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode_order ?>">
                                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <input type="hidden" name="total_pembayaran" value="<?php echo $total_pembayaran ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Nominal Uang" name="uang" required>
                                                <label for="floatingInput">Nominal Uang</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nominal Uang.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="bayar_validate" class="btn btn-primary">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Bayar -->

                <div class="table-responsive">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
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
                                    <td class="text-nowrap"><?= $row['nama_menu'] ?></td>
                                    <td>Rp.<?= number_format($row['harga_menu'], 0, ',', '.') ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><?= $row['catatan'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>Dimasak</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-primary'>Siap disajikan</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>Rp.<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm disabled" : "btn btn-warning btn-sm"; ?>" title="Edit" data-bs-toggle="modal" data-bs-target="#editItem<?= $row['id_list_order']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm disabled" : "btn btn-danger btn-sm"; ?>" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteItem<?= $row['id_list_order']; ?>"><i class="bi bi-trash3"></i></button>
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
                                <td colspan="6" class="fw-bold">
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
                <button type="button" class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#addItem"><i class="bi bi-plus-circle"></i> Menu</button>
                <button type="button" class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                <button onclick="printStruk()" class="btn btn-info">Cetak Struk</button>
            </div>
        </div>
    </div>
</div>

<div id="strukContent" class="d-none">
    <style>
        #struk {
            font-family: "Arial", sans-serif;
            font-size: 12px;
            max-width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 80mm;
        }

        #struk h2 {
            text-align: center;
            color: #333;
        }

        #struk p {
            margin: 5px;
        }

        #struk table {
            font-size: 12px;
            border-collapse: collapse;
            margin-top: 10px;
            width: 100%;
        }

        #struk th,
        #struk td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #struk .totale {
            font-weight: bold;
        }
    </style>
    <div id="struk">
        <h2>Struk Pembayaran TheCoffe</h2>
        <p>Kode Order : <?= $kode_order ?></p>
        <p>Meja : <?= $meja ?></p>
        <p>Pelanggan : <?= $pelanggan ?></p>
        <p>Waktu Order : <?= date('d/m/Y H:i:s', strtotime($row['waktu_order'])) ?></p>

        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as  $row) { ?>
                    <tr>
                        <td><?= $row['nama_menu'] ?></td>
                        <td><?= number_format($row['harga_menu'], 0, ',', '.') ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                    </tr>
                <?php
                    $total_pembayaran;
                } ?>
                <tr class="totale">
                    <td colspan="3">Total Harga</td>
                    <td><?= number_format($total_pembayaran, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function printStruk() {
        var strukContent = document.getElementById("strukContent").innerHTML;

        var printFrame = document.createElement('iframe');
        printFrame.style.display = 'none';
        document.body.appendChild(printFrame);
        printFrame.contentDocument.write(strukContent)
        printFrame.contentWindow.print();
        document.body.removeChild(printFrame);
    }
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