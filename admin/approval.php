<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Approval Request
    </h1>
     <h4>
      Adalah proses membantu petugas loket yang mengalami (Lupa PIN, Pemulihan Akun, dan Buka Blokir).
    </h4>
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
                    <label>Tanggal Request</label>
                    <input 
                      autocomplete="off" 
                      type="text" 
                      value="<?php if(isset($_GET['tgl_req'])){echo $_GET['tgl_req'];}else{echo "";} ?>" 
                      name="tgl_req" 
                      class="form-control" 
                      placeholder="Tanggal Request" 
                      required="required"
                      id="tgl_req"
                      >
                  </div>

                </div>

                  <div class="col-md-3">
                     <div class="form-group">
                    <label>Filter</label>
                    <select name="Filter" class="form-control" required="required">
                          <?php
                            if (!$_GET['Filter']) {
                              echo '<option value="00"> All Request </option>
                                    <option value="Request"> New Request </option>
                                    <option value="Finish"> Approved Request </option>';
                            }else{
                              $filter = $_GET['Filter'];
                              if ($filter == 'Request') { //approved request
                                echo '<option value="Finish" selected> Approved Request </option>';
                                echo '<option value="Request"> New Request </option>';
                                echo '<option value="00"> All Request </option>';
                              }elseif ($filter == 'Finish') { //new request
                                echo '<option value="Request"> New Request </option>';
                                echo '<option value="Finish" selected> Approved Request </option>';
                                echo '<option value="00"> All Request </option>';
                              }else { //all request
                                echo '<option value="00" selected> All Request </option>';
                                echo '<option value="Finish"> Approved Request </option>';
                                echo '<option value="Request"> New Request </option>';
                              }
                            }
                          ?>
                    </select>
                    
                  </div>
                </div>

                <div class="col-md-3">

                </div>

                <div class="col-md-3">

                  <div class="form-group">
                    <br/>
                    <input type="submit" value="GET REQUEST" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Data Approval</h3>
          </div>
          <div class="box-body">

            <?php 
            if(isset($_GET['tgl_req'])){
              $tgl_trx = $_GET['tgl_req'];
              ?>


              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                    <th width="10%">TANGGAL</th>
                    <th>JENIS</th>
                    <th width="6%">User ID</th>
                    <th width="6%">NAMA</th>
                    <th width="10%">NOMOR HP</th>
                    <th width="10%">EMAIL</th>
                    <th width="10%">KODE VERIFIKASI</th>
                    <th>STATUS</th>
                    <th width="8%">USER APPROVED</th>
                    <th width="10%">WAKTU REQUEST</th>
                    <th width="10%">WAKTU APPROVED</th>
                    <th>OPSI</th>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;

                      $filter = $_GET['Filter'];
                      if ($filter === '00') {
                          $data = mysqli_query($koneksi,"SELECT * FROM approval as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id and date(tgl_req) ='$tgl_trx'");
                      }else{
                          $data = mysqli_query($koneksi,"SELECT * FROM approval as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id and status = '$filter' and date(tgl_req) ='$tgl_trx'");
                      }
                    
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $d['tgl_req']; ?></td>
                          <td><?php echo $d['jenis_approval']; ?></td>
                          <td><?php echo $d['pegawai_id']; ?></td>
                          <td><?php echo $d['pegawai_nama']; ?></td>
                          <td><?php echo $d['pegawai_no_hp']; ?></td>
                          <td><?php echo $d['pegawai_email']; ?></td>
                          <td><?php echo $d['kode_verifikasi']; ?></td>
                          <td><?php echo $d['status']; ?></td>
                          <td><?php echo $d['pegawai_pos']; ?></td>
                          <td><?php echo $d['tgl_req']; ?></td>
                          <td><?php echo $d['tgl_approve']; ?></td>
                          <td>    
                            <a class="btn btn-warning btn-sm" href="approvalbaca.php?id=<?php echo $d['pegawai_id'] ?>"><i class="fa fa-cog"></i></a>
                           

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
                Silahkan Filter Data Terlebih Dulu.
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