<?php 
include '../koneksi.php';
$kategori  = $_POST['kategori'];


//function generateId(){
//	include '../koneksi.php';
//	//select last id = 20
//	//id + 1
//	$sql 	= "SELECT kategori_id FROM `kategori` ORDER BY kategori_id DESC LIMIT 1";
//	$query 	= mysqli_query($koneksi, $sql);
//	$result = mysqli_fetch_array($query);
//	$lastId = $result['kategori_id'] + 1;
//	$padLeft = str_pad($lastId, 4, "0", STR_PAD_LEFT);
//	//
//	$id 	= "C".$padLeft."";
//	return $id;
//}
//

//$id 		= generateId();


mysqli_query($koneksi, "insert into kategori values (NULL,'$kategori')");
header("location:kategori.php");