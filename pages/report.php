<?php
include 'controller/connect.php';
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($con, "SELECT tb_order.*,tb_bayar.*,nama,level, SUM(harga_menu*jumlah) AS total_harga FROM tb_order 
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
        LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_order ORDER BY waktu_order DESC");
while ($data = mysqli_fetch_array($query)) {
    $result[] = $data;
}

// $select_kat_menu = mysqli_query($con, "SELECT id_kat,kategori_menu FROM tb_kategori_menu");
?>

<div class="konten col-lg-9 rounded mb-5">
    <div class="card">
        <div class="card-header fw-bold">
            Halaman Report | TheCoffe
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "Tidak ada data";
            } else {
                foreach ($result as $row) {
            ?>

                <?php
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Waktu Bayar</th>
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
                                        <a href="./?page=order_item&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="text-dark text-decoration-none">
                                            <?= $row['id_order'] ?>
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="./?page=order_item&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="text-dark text-decoration-none">
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
                                    <td><?= $row['waktu_order'] ?></td>
                                    <td><?= $row['waktu_bayar'] ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="./?page=viewitem&order=<?= $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>" class="btn btn-info btn-sm" title="Detail"><i class="bi bi-exclamation-circle"></i></a>
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