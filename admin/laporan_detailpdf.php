<?php
// memanggil library FPDF
require('../library/fpdf181/fpdf.php');


include '../koneksi.php'; 
$tgl_dari   = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];
$kprk       = $_GET['kprk'];
$regional   = $_GET['regional'];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',14);
// mencetak string 
$pdf->Cell(280,7,'SISTEM INFORMASI MLOKET ORANGER',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(280,7,'LAPORAN TRANSAKSI',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(35,6,'DARI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_dari)) ,0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(35,6,'SAMPAI TANGGAL',0,0);
$pdf->Cell(5,6,':',0,0);
$pdf->Cell(35,6, date('d-m-Y', strtotime($tgl_sampai)) ,0,0);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(35,6,'DESKRIPSI : DETAIL TRANSAKSI',0,0);
$pdf->Cell(5,6,'',0,0);


$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',9);

$pdf->Cell(10,14,'NO',1,0,'C');
$pdf->Cell(20,14,'User ID',1,0,'C');
$pdf->Cell(17,14,'No.KPRK',1,0,'C');
$pdf->Cell(20,14, 'Produk' ,1,0,'C');
$pdf->Cell(35,14,'Bill Number',1,0,'C');
$pdf->Cell(35,14,'No.transaksi',1,0,'C');
$pdf->Cell(22,14,'Jlm Lembar',1,0,'C');
$pdf->Cell(30,14,'Nominal Tagihan',1,0,'C');
$pdf->Cell(20,14,'Admin',1,0,'C');
$pdf->Cell(24,14,'Payment Code',1,0,'C');
$pdf->Cell(30,14,'Waktu Transaksi',1,0,'C');


$pdf->Cell(10,14,'',0,1);


$pdf->SetFont('Arial','',8,5);


$no=1;
  
$query = "
	SELECT a.*, b.* FROM transaksi as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id 
		   and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'
	";
	if ($kprk != '00' && $kprk!='') {                                 
	  $query .= "and b.KPRK = '$kprk'";
	};
	
	if ($regional !='') {                                 
	  $query .= "and a.ref_regional  = '$regional'";
	};
	
$data = mysqli_query($koneksi,$query);
														
								
while($d = mysqli_fetch_array($data)){

if($d['nominal_tagihan']){
      $total_uang  = $d['nominal_tagihan'];
      }
  
  $pdf->Cell(10,7,$no++,1,0,'C');
  $pdf->Cell(20,7, $d['pegawai_id'] ,1,0,'C');
  $pdf->Cell(17,7, $d['KPRK'] ,1,0,'C');
  $pdf->Cell(20,7, $d['transaksi_jenis'] ,1,0,'C');
  $pdf->Cell(35,7, $d['billnumber'] ,1,0,'C');
  $pdf->Cell(35,7, $d['no_transaksi'] ,1,0,'C');
  $pdf->Cell(22,7, $d['jmlLembar'] ,1,0,'C');

if($d['nominal_tagihan']){
  $money = "Rp. ".number_format($d['nominal_tagihan'])." ,-";
}

  $pdf->Cell(30,7,$money,1,0,'C');
  $pdf->Cell(20,7, $d['pegawai_pos'] ,1,0,'C');
  $pdf->Cell(24,7, $d['payment_code'] ,1,0,'C');
  $pdf->Cell(30,7,date('d-m-Y', strtotime($d['transaksi_tanggal'])),1,1,'C');

}
$pdf->Cell(10,6,'',0,1);


$pdf->Output();
?>
