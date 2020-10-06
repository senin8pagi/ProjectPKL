<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Pengawasan Manifest</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Filter Data</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input 
                      autocomplete="off" 
                      type="text" 
                      value="<?php if(isset($_GET['transaksi_tanggal'])){echo $_GET['transaksi_tanggal'];}else{echo "";} ?>" 
                      name="transaksi_tanggal" 
                      class="form-control" 
                      placeholder="transaksi tanggal" 
                      required="required"
                      id="transaksi_tanggal"
                      >
                  </div>

                </div>

                <div class="col-md-3">
                  <div class="form-group">

                  <label>Regional</label>
                  <select class="form-control" name="regional" id="regional" onChange="getKprk(this.value)">
                    <option value="">-- Pilih Regional --</option>
                    <?php 
                      $ref_regional = mysqli_query($koneksi,"SELECT * FROM ref_regional ORDER BY regional_nama ASC");
                      while($k = mysqli_fetch_array($ref_regional)){
                        ?>
                        <option value="<?php echo $k['regional_kode']; ?>"><?php echo $k['regional_nama']; ?></option>
                        <?php 
                      }
                      ?>
                  </select>
                </div>
              </div>
                              
                <div class="col-md-3">
                  <div class="form-group">

                  <label>KPRK</label>
                  <select class="form-control" name="KPRK" id="kodekantor">
                    <option value="">-- Pilih KPRK --</option>
                    <option value="00">-- Semua KPRK --</option>
                    <?php 
                      $ref_kantor = mysqli_query($koneksi,"SELECT * FROM ref_kantor ORDER BY kodekantor ASC");
                      while($k = mysqli_fetch_array($ref_kantor)){
                        ?>
                        <option value="<?php if(isset($_GET['kodekantor'])) echo $_GET['kodekantor']; echo $k['kodekantor']; ?>"><?php echo $k['kodekantor']; ?></option>
                        <?php 
                      }
                      ?>
                  </select>
                </div>
              </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <br/>
                    <input type="submit" value="CEK DAFTAR MANIFEST" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Laporan Data Manifest</h3>
          </div>
          <div class="box-body">

            <?php 
            if(isset($_GET['transaksi_tanggal']) && isset($_GET['KPRK']) && isset($_GET['regional'])){
            $tgl_trx = $_GET['transaksi_tanggal'];
            $KPRK = $_GET['KPRK'];
            $regionalKode = $_GET['regional'];
            ?>


              <!-- <a href="laporan_manifestpdf.php?transaksi_tanggal=<?php echo $tgl_trx ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a> -->

              <a href="laporan_printmanifest.php?transaksi_tanggal=<?php echo $tgl_trx ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp PRINT</a>
              
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                    <th width="1%" rowspan="2">NO</th>
                    <th>User ID</th>
                    <th>No. KPRK</th>
                    <th>ID PRODUK</th>
                    <th>Jumlah Transaksi</th>
                    <th>Jumlah Uang</th>
                    <th>Tanggal</th>
                    <th>Nomor Backsheeet</th>
                    <th>Barcode</th>
                    <th>No. Resi</th>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $query = "SELECT a.*, b.* FROM transaksi as a,t_pegawailoket as b where a.pegawai_id=b.pegawai_id  and date(transaksi_tanggal) ='$tgl_trx'";

                    if ($KPRK != '00' && $KPRK!='') {                                 
                      $query .= "and b.KPRK = '$KPRK'";
                    };
                    
                    if ($regionalKode !='') {                                 
                      $query .= "and a.ref_regional  = '$regionalKode'";
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
                        <td><?php echo $d['KPRK']; ?></td>
                        <td><?php echo $d['jenis_id']; ?></td>
                        <td><?php echo $d['jmlTrx']; ?></td>
                        <td>
                        <?php echo "Rp. ".number_format($total_uang * $total_uangs)." ,-"; ?>
                        </td>
                        <td><?php echo $d['transaksi_tanggal']; ?></td>
                        <td><?php echo $d['billnumber']; ?></td>
                        <td><?php echo $d['no_transaksi']; ?></td>
                        <td><?php echo $d['no_resi']; ?></td>
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

         
      </section>
  </section>

</div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
 $('#transaksi_tanggal').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  })

 function getKprk(idRegional) {
   $.ajax({
    url : 'http://localhost/oranger/admin/ajax/getKprk.php',
    type: 'POST',
    data: {
      regionalCode: idRegional
    },
    dataType: 'json',
    success: function(response){
      $("#kodekantor").empty();
      $('#kodekantor')
           .append($("<option></option>")
          .attr("value","00")
          .text('Semua KPRK')); 
      $.each(response, function(key, value) {           
       $('#kodekantor')
           .append($("<option></option>")
          .attr("value",value.nopend)
          .text(value.nopend +' - '+ value.namaKantor)); 
      });

    }
   })
 }

</script>