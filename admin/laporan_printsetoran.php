 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Setoran</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 </head>
 <body>

 	<center>
 		<h4>LAPORAN SETORAN</h4>
 		<h4>SISTEM INFORMASI MLOKET(ORANGER)</h4>
 	</center>


 	<?php 
  if(isset($_GET['transaksi_tanggal']) && isset($_GET['kprk']) && isset($_GET['regional'])){
  $tgl_trx = $_GET['transaksi_tanggal'];
  $kprk       = $_GET['kprk'];
  $regional   = $_GET['regional'];
  ?>

 		<div class="row">
 			<div class="col-lg-6">
 				<table class="table table-bordered">
 					<tr>
 						<th width="30%">DARI TANGGAL</th>
 						<th width="1%">:</th>
                      	<td><?php echo $tgl_trx; ?></td>
 					</tr>
 					<tr>
 						<th>DESKRIPSI</th>
 						<th>:</th>
 						<th>PENGAWASAN SETORAN</th>
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
          <th>NAMA</th>
          <th>No. KPRK</th>
          <th>Nomor Manifest</th>
          <th>Jumlah Transaksi</th>
          <th>Jumlah Uang</th>
        </tr>
        </thead>
 				<tbody>
 					<?php 
            include '../koneksi.php';
            $no=1;
            $query = "SELECT a.*, b.* FROM transaksi as a,t_pegawailoket as b where a.pegawai_id=b.pegawai_id  and date(transaksi_tanggal) ='$tgl_trx'";

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
              ?>
              <tr>
                <?php
                if($d['jmlTrx']){
                  $total_uangs  = $d['jmlTrx'];
                }
                ?> 
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo $d['pegawai_id']; ?></td>
                <td><?php echo $d['pegawai_nama']; ?></td>
                <td><?php echo $d['KPRK']; ?></td>
                <td><?php echo $d['billnumber']; ?></td>
                <td><?php echo $d['jmlTrx']; ?></td>
                <td>
                <?php echo "Rp. ".number_format($total_uang * $total_uangs)." ,-"; ?>
                </td>
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
