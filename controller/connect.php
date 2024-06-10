<?php

$con = mysqli_connect("localhost", "root", "", "dbthecoffe");
if(!$con){
    echo "Koneksi Gagal";
}