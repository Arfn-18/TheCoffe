<?php
include "controller/connect.php";
$query = mysqli_query($con, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}

$query_chart = mysqli_query($con, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS terjual FROM tb_daftar_menu
    LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
    GROUP BY tb_daftar_menu.id
    ORDER BY tb_daftar_menu.id ASC");

// $result_chart = array();
while ($record_chart = mysqli_fetch_array($query_chart)) {
    $result_chart[] = $record_chart;
}

$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_quote = array_map(function ($menu) {
    return '"' . $menu . '"';
}, $array_menu);
$string_menu = implode(',', $array_menu_quote);

$array_jumlah_pesanan = array_column($result_chart, 'terjual');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <!-- End Carousel -->

    <!-- Judul -->
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
    <!-- Judul -->

    <!-- Chart -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?= $string_menu ?>],
                        datasets: [{
                            label: 'Jumlah Porsi Terjual',
                            data: [<?= $string_jumlah_pesanan ?>],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(0, 0, 255, 0.65)',
                                'rgba(255, 255, 0, 0.65)',
                                'rgba(0, 128, 0, 0.65)',
                                'rgba(128, 0, 128, 0.65)',
                                'rgba(255, 165, 0, 0.65)',
                                'rgba(255, 0, 0, 0.65)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- End Chart -->
</div>