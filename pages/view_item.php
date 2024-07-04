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
}

$select_daftar_menu = mysqli_query($con, "SELECT id,nama_menu FROM tb_daftar_menu");
?>

<div class="konten col-lg rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman View Item | TheCoffe
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex gap-2 align-items-center mb-2">
                    <a href="report" class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-left"></i> Exit</a>
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

            <?php
            if (empty($result)) {
                echo '<div class="mb-3">Order ini belum memesan item apapun.</div>';
            } else {
                foreach ($result as $row) {
            ?>

                <?php
                }
                ?>
             
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
                                <td>
                                    <?php
                                        if($row['status']==1){
                                            echo "<span class='badge text-bg-warning'>Dimasak</span>";
                                        } elseif($row['status']==2){
                                            echo "<span class='badge text-bg-primary'>Siap disajikan</span>";
                                        }
                                    ?>
                                </td>
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