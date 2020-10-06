<?php 


include '../koneksi.php';

$id = $_POST['id'];

$sql 	= "SELECT * FROM `jenis` WHERE jenis_id = '$id'";
$query 	= mysqli_query($koneksi, $sql);
$result = mysqli_fetch_array($query);
echo json_encode($result);

?>