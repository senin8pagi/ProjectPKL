<?php 
include '../koneksi.php';
$jenis  = $_POST['namaJenis'];
$id = $_POST['kategori'];

mysqli_query($koneksi, "insert into jenis values (NULL,'$jenis','$id')");
header("location:jenis.php");