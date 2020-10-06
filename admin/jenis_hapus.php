<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update transaksi set transaksi_jenis='1' where transaksi_jenis='$id'");

mysqli_query($koneksi, "delete from jenis where jenis_id='$id'");
header("location:jenis.php");