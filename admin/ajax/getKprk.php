<?php
include '../../koneksi.php';
$reg = $_POST['regionalCode'];

$query = mysqli_query($koneksi,"select * from ref_kantor where regional_kode='$reg'");
$result = array();

while ($d = mysqli_fetch_array($query)) {
	$result[] = array(
		'nopend' => $d['kodekantor'],
		'namaKantor' => $d['nama_kantor']
	);
}

echo json_encode($result);

?>