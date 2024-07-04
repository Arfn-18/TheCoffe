<?php
include 'controller/connect.php';
// echo $_GET['order'];

$query = mysqli_query($con, "SELECT * FROM tb_list_order 
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        ORDER BY waktu_order ASC
        ");

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
            Halaman Dapur | TheCoffe
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex gap-2 align-items-center mb-2">
                    <a href="order" class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-left"></i> Exit</a>
                    <h4 class="fw-bold mt-1">Checkout</h4>
                </div>
            </div>

            <?php
            if (empty($result)) {
                echo '<div class="mb-3">Order ini belum memesan item apapun.</div>';
            } else {
                foreach ($result as $row) {
            ?>
                    
            <!-- Modal Terima Dapur-->
            <div class="modal fade" id="terima<?= $row['id_list_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form class="needs-validation" novalidate action="controller/proses_terima_item.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <select disabled class="form-select" name="menu" aria-label="Default select example" required>
                                        <option value="" hidden selected>Terima Pesanan Makanan</option>
                                        <?php
                                        foreach ($select_daftar_menu as $valueDaf) {
                                            if($row['menu'] == $valueDaf['id']){
                                                echo '<option selected value="' . $valueDaf['id'] . '">' . $valueDaf['nama_menu'] . '</option>';
                                            }else{
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
                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="" name="jumlah" required value="<?= $row['jumlah'] ?>">
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
                            <button type="submit" name="terima_item_validate" class="btn btn-primary">Terima</button>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Terima Dapur -->
             
            <!-- Modal Siap Saji-->
            <div class="modal fade" id="siapsaji<?= $row['id_list_order']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form class="needs-validation" novalidate action="controller/proses_siapsaji_item.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <select disabled class="form-select" name="menu" aria-label="Default select example" required>
                                        <option value="" hidden selected>Siap Saji</option>
                                        <?php
                                        foreach ($select_daftar_menu as $valueDaf) {
                                            if($row['menu'] == $valueDaf['id']){
                                                echo '<option selected value="' . $valueDaf['id'] . '">' . $valueDaf['nama_menu'] . '</option>';
                                            }else{
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
                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="" name="jumlah" required value="<?= $row['jumlah'] ?>">
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
                            <button type="submit" name="siapsaji_item_validate" class="btn btn-primary">Siap Saji</button>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Siap Saji -->

            <?php
            }
            ?>
             
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                            if($row['status']!=2){
                        ?>
                        <tr class="align-middle">
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $row['kode_order'] ?></td>
                            <td><?= $row['waktu_order'] ?></td>
                            <td class="text-nowrap"><?= $row['nama_menu'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td>
                                <?php
                                    if($row['status']==1){
                                        echo "<span class='badge text-bg-warning'>Dimasak</span>";
                                    } elseif($row['status']==2){
                                        echo "<span class='badge text-bg-primary'>Siap disajikan</span>";
                                    }
                                ?>
                            </td>
                            <td><?= $row['catatan'] ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm disabled" : "btn btn-primary btn-sm" ; ?>" title="Detail" data-bs-toggle="modal" data-bs-target="#terima<?= $row['id_list_order']; ?>">Terima</i></button>
                                    <button class="text-nowrap <?php echo (empty($row['status']) || $row['status']!=1) ? "btn btn-secondary btn-sm disabled" : "btn btn-success btn-sm" ; ?>" title="Detail" data-bs-toggle="modal" data-bs-target="#siapsaji<?= $row['id_list_order']; ?>">Siap Saji</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                            } 
                        }
                        ?>
                    </tbody>
                    <tfoot>
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