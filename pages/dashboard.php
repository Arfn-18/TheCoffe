<?php
include "controller/connect.php";
$query = mysqli_query($con, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}
?>
<div class="konten col-lg rounded mb-5">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slider = 0;
            $slidebutton = true;
            foreach ($result as $tombol) {
                ($slidebutton) ? $aktif =  "active" : $aktif = "";
                $slidebutton = false;

            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slider ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slider + 1 ?>"></button>
            <?php
                $slider++;
            }
            ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $slide = true;
            foreach ($result as $data) {
                ($slide) ?  $aktif = "active" :  $aktif = "";
                $slide = false;



            ?>
                <div class="carousel-item <?php echo $aktif; ?>">
                    <img src="src/img/<?php echo $data['foto_menu'] ?>" class="img-fluid" style="height: 250px; width: 1000px; object-fit: cover" alt="..." />
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama_menu'] ?></h5>
                        <p><?php echo $data['keterangan_menu'] ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel -->

    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">TheCoffe - Aplikasi Pengelolaan Pesanan Makanan dan Minuman</h5>
            <p class="card-text">
                TheCoffee adalah aplikasi yang dikembangkan oleh mahasiswa untuk mendukung operasional kedai kopi dalam tugas mata kuliah Rekayasa Perangkat Lunak (RPL). Aplikasi ini bertujuan untuk mengoptimalkan alur kerja antara pelayan, kasir,
                dan dapur, sehingga layanan menjadi lebih efisien dan terintegrasi.
            </p>
            <a href="order" class="btn btn-primary">Buat Order</a>
        </div>
    </div>
</div>