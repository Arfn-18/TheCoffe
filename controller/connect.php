<?php

$con = mysqli_connect("localhost", "root", "", "dbfollowup");
if(!$con){
    echo "Koneksi Gagal";
}