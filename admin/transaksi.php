<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi
      <small>Data Transaksi</small>
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
            <h3 class="box-title">Filter Waktu</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo "";} ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo "";} ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
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
                    <input type="submit" value="GET REQUEST" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Data Transaksi</h3>
          </div>

            <div class="box-body">

                <?php 
            if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['KPRK']) && isset($_GET['regional'])){
              $tgl_dari = $_GET['tanggal_dari'];
              $tgl_sampai = $_GET['tanggal_sampai'];
              $KPRK = $_GET['KPRK'];
              $regionalKode = $_GET['regional'];
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
                  </table>
                  
                </div>
              </div>

              
              
            <div class="table-responsive">
              <div style="padding: 10px">
                  <div id="exTab1"> 
                    <ul  class="nav nav-pills">
                      <li class="active">
                        <a  href="#1a" data-toggle="tab">Detail Transaksi</a>
                      </li>
                      <li><a href="#2a" data-toggle="tab">Rekap Per User</a>
                      </li>
                      <li><a href="#3a" data-toggle="tab">Rekap Per Kantor</a>
                      </li>
                    </ul>

                    <div class="tab-content clearfix">
                      <div class="tab-pane active" id="1a">

                       <!--  <a href="laporan_detailpdf.php?tanggal_dari=<?php echo $tgl_dari ?>
                        &tanggal_sampai=<?php echo $tgl_sampai ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>"
                        target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a> -->

                        <a href="laporan_printdetail.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp PRINT</a>
                            <table class="table table-bordered table-striped" id="table-datatable">
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
                                  <th>Nippos</th>
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
                      <!---------------------------------------------------------------------------------------------------------->
                       <div class="tab-pane" id="2a">
                        <!-- <a href="laporan_userpdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
 -->
                        <a href="laporan_printuser.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp PRINT</a>

                        

                        <table class="table table-bordered table-striped" id="table-datatable">

                              <thead>
                                <tr>
                                  <th width="1%" rowspan="2">NO</th>
                                  <th>User ID</th>
                                  <th>Nama User</th>
                                  <th>Jml Trx</th>
                                  <th>Jumlah Tagihan</th>
                                  <th>Nominal Tagihan</th>
                                  <th>Nippos</th>
                                  <th>Total</th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                <?php 
                                include '../koneksi.php';
                                $no=1;
                               
								$query = "
								       SELECT a.*, b.*, c.*, d.* FROM transaksi as a, t_pegawailoket as b, ref_kantor as c, ref_regional as d 
									   where a.pegawai_id=b.pegawai_id and b.KPRK=c.kodekantor and c.regional_kode=d.regional_kode and 
									   date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'";
									   
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
                                    <td><?php echo $d['pegawai_nama']; ?></td>
                                    <td><?php echo $d['jmlTrx']; ?></td>
                                    <td>
                                      <?php echo "Rp. ".number_format($total_uang * $total_uangs)." ,-"; ?>
                                    </td>
                                    <td><?php 
                                        if($d['nominal_tagihan']){
                                          echo "Rp. ".number_format($d['nominal_tagihan'])." ,-";
                                        }
                                        ?>
                                          
                                        </td>
                                    <td><?php echo $d['pegawai_pos']; ?></td>
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
                      <!---------------------------------------------------------------------------------------------------------->
                      <div class="tab-pane" id="3a">
                        <!-- <a href="laporan_kantorpdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
 -->
                        <a href="laporan_printkantor.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>&kprk=<?php echo $KPRK ?>&regional=<?php echo $regionalKode ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp PRINT</a>
                        
                       
                          
                         <table class="table table-bordered table-striped" id="table-datatable">
                              <thead>
                                <tr>
                                  <th width="1%" rowspan="2">NO</th>
                                  <th>KPRK</th>
                                  <th>Nama KPRK</th>
                                  <th>Jml Trx</th>
                                  <th>Nominal Tagihan</th>
                                  <th>Nippos</th>
                                  <th>Total</th>
                                </tr>
                                
                              </thead>
                              <tbody>
                                <?php 
                                include '../koneksi.php';
                                $no=1;
                                
							    $query = "
								       SELECT a.*, b.*, c.* FROM transaksi as a, t_pegawailoket as b, ref_kantor as c 
									   where a.pegawai_id=b.pegawai_id and b.KPRK=c.kodekantor and date(transaksi_tanggal)>='$tgl_dari' 
									   and date(transaksi_tanggal)<='$tgl_sampai'";
									   
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
                                    <td><?php echo $d['KPRK']; ?></td>
                                    <td><?php echo $d['nama_kantor']; ?></td>
                                    <td><?php echo $d['jmlTrx']; ?></td>
                                    <td><?php 
                                        if($d['nominal_tagihan']){
                                          echo "Rp. ".number_format($d['nominal_tagihan'])." ,-";
                                        }
                                        ?>
                                          
                                        </td>
                                    <td><?php echo $d['pegawai_pos']; ?></td>
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
              <!-------------------------------------------->
                  </div>
                </div>
              </div>
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


          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
 $('#tgl_req').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  })

</script>

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