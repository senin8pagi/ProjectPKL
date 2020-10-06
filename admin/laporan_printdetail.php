 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Transaksi</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

 </head>
 <body>

 	<center>
 		<h4>LAPORAN TRANSAKSI</h4>
 		<h4>SISTEM INFORMASI MLOKET(ORANGER)</h4>
 	</center>


 	<?php 
 	include '../koneksi.php';
 	if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kprk']) && isset($_GET['regional'])){
 		$tgl_dari = $_GET['tanggal_dari'];
 		$tgl_sampai = $_GET['tanggal_sampai'];
		$kprk = $_GET['kprk'];
		$regional = $_GET['regional'];
 		?>

 		<div class="row">
 			<div class="col-lg-6">
 				<table class="table table-bordered">
 					<tr>
 						<th width="30%">DARI TANGGAL</th>
 						<th width="1%">:</th>
                      	<td><?php echo $tgl_dari; ?></td>
 					</tr>
 					<tr>
 						<th>SAMPAI TANGGAL</th>
 						<th>:</th>
                      	<td><?php echo $tgl_sampai; ?></td>
 					</tr>
 					<tr>
 						<th>DESKRIPSI</th>
 						<th>:</th>
 						<th>DETAIL TRANSAKSI</th>
 					</tr>
 				</table>

 			</div>
 		</div>

 		<div class="table-responsive">
 			<table class="table table-bordered table-striped">
 				<thead>
 					<tr>
	                  <th width="1%" rowspan="2">NO</th>
	                  <th>User ID</th>
	                  <th>No.KPRK</th>
	                  <th>PRODUK</th>
	                  <th>Bill Number</th>
	                  <th>NO.Transaksi</th>
	                  <th>Jlm Lembar</th>
	                  <th>Nominal Tagihan</th>
	                  <th>Admin</th>
	                  <th>Payment Code</th>
	                  <th>Waktu Transasksi</th>
	                </tr>
 				</thead>
 				<tbody>
 					 <?php 
		                include '../koneksi.php';
		                $no=1;
		                $query = "
								SELECT a.*, b.* FROM transaksi as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id 
									   and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'
								";
						if ($kprk != '00' && $kprk!='') {                                 
						  $query .= " and b.KPRK = '$kprk'";
						};
						
						if ($regional !='') {                                 
						  $query .= " and a.ref_regional  = '$regional'";
						};
						
                        						
						$data = mysqli_query($koneksi,$query);

		                while($d = mysqli_fetch_array($data)){
		                  if($d['nominal_tagihan']){
		                      $total_uang  = $d['nominal_tagihan'];
		                      }
		                  
		                  ?>
		                  <tr>
		                    <td class="text-center"><?php echo $no++; ?></td>
		                    <td><?php echo $d['pegawai_id']; ?></td>
		                    <td><?php echo $d['KPRK']; ?></td>
		                    <td><?php echo $d['transaksi_jenis']; ?></td>
		                    <td><?php echo $d['billnumber']; ?></td>
		                    <td><?php echo $d['no_transaksi']; ?></td>
		                    <td><?php echo $d['jmlLembar']; ?></td>
		                    <td>
		                      <?php 
		                        if($d['nominal_tagihan']){
		                          echo "Rp. ".number_format($d['nominal_tagihan'])." ,-";
		                        }
		                        ?>
		                        </td>
		                     <td><?php echo $d['pegawai_pos']; ?></td>
		                    <td><?php echo $d['payment_code']; ?></td>
		                    <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
		                  </tr>
		                  <?php 
		                }
	                ?>
 				</tbody>
 			</table>



 		</div>

 		<?php 
 	}else{
 		?>

 		<div class="alert alert-info text-center">
 			Silahkan Filter Laporan Terlebih Dulu.
 		</div>

 		<?php
 	}
 	?>


 	<script>

 		window.print();
 		
 	</script>

 </body>
 </html>
