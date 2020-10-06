<?php 
    include '../koneksi.php';
	$id = $_POST['id'];
	$kodeverifikasi = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
	$tgl = date('Y-m-d H:i:s');
	
	mysqli_query($koneksi, "update loket set status = 'Aktif' where id = '$id'");
	
	$qupdate = "update approval set status = 'Finish', kode_verifikasi = '$kodeverifikasi', tgl_approve='$tgl' where pegawai_id = '$id'";
	$data = mysqli_query($koneksi, $qupdate);
	if($data){
	  header("location:approval.php");
	} 
   
?>