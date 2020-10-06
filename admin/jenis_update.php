<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$jenis  = $_POST['jenis'];

mysqli_query($koneksi, "update jenis set jenis='$jenis' where jenis_id='$id'");
header("location:jenis.php");