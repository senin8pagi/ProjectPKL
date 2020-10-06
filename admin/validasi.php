<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      VALIDASI REQUEST
    </h1>
    <h4>
      Adalah proses memvalidasi petugas loket yang sudah melakukan Registrasi.
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
            <h3 class="box-title">Filter Data Validasi Request</h3>
            <div class="btn-group pull-right">
            <form action="validasi.php" method="post">
                  <div class="form-group">
                    <label>Filter</label>
                    <select name="filter" class="form-control" required="required">
                          <?php
                            if (!$_POST['filter']) {
                              echo '<option value=""> Semua User </option>
                                    <option value="Tidak Aktif"> User Baru </option>';
                              echo '<option value="Aktif"> Approval User </option>
                                <option value="NULL"> Belum Ada Rekening </option>
                                <option value="Blokir"> Blokir User </option>';
                            }else{
                              $filter = $_POST['filter'];
                              if ($filter == 'Aktif') {
                                echo '<option value="Aktif" selected> Approval User </option>';
                                echo '<option value="Tidak Aktif"> User Baru </option>';
                                echo '<option value=""> Semua User </option>';
                                echo '<option value="NULL">Belum ada Rekening </option>';
                                echo '<option value="Blokir"> Blokir User </option>';
                              }elseif ($filter == 'NULL') {
                                echo '<option value="NULL" selected>Belum ada Rekening </option>';
                                echo '<option value="Aktif"> Approval User </option>';
                                echo '<option value="Tidak Aktif"> User Baru </option>';
                                echo '<option value=""> Semua User </option>';
                                echo '<option value="Blokir"> Blokir User </option>';
                              }elseif ($filter == 'Tidak Aktif') {
                                echo '<option value="NULL">Belum ada Rekening </option>';
                                echo '<option value="Aktif"> Approval User </option>';
                                echo '<option value="Tidak Aktif" selected> User Baru </option>';
                                echo '<option value=""> Semua User </option>';
                                echo '<option value="Blokir"> Blokir User </option>';
                              }elseif ($filter == 'Blokir') {
                                echo '<option value="Blokir" selected> Blokir User </option>';
                                echo '<option value="Aktif"> Approval User </option>';
                                echo '<option value="Tidak Aktif"> User Baru </option>';
                                echo '<option value=""> Semua User </option>';
                                echo '<option value="NULL">Belum ada Rekening </option>';
                              }else {
                                echo '<option value="" selected> Semua User </option>';
                                echo '<option value="Aktif"> Approval User </option>';
                                echo '<option value="Tidak Aktif"> User Baru </option>';
                                echo '<option value="NULL">Belum ada Rekening </option>';
                                echo '<option value="Blokir"> Blokir User </option>';
                              }
                            }
                          ?>
                      
                    </select>
                    </div>
            <div class="col-sm-4" >
            <button id="search" name="search" type="submit" class="btn btn-primary">Cari</button>
          </form>
            </div>
                  </div>
            

          </div>
          <div class="box-body">

            <!-- Modal -->
          
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>NAMA</th>
                    <th>KPRK</th>
                    <th>NOMOR REKENING GIRO</th>
                    <th>NOMOR HP</th>
                    <th>EMAIL</th>
                    <th>STATUS</th>
                    <th>OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  if (empty($_POST['filter'])) {
                      $data = mysqli_query($koneksi,"SELECT a.*, b.* FROM validasi as a, t_pegawailoket as b WHERE a.pegawai_id=b.pegawai_id");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $d['pegawai_id']; ?></td>
                          <td><?php echo $d['pegawai_nama']; ?></td>
                          <td><?php echo $d['KPRK']; ?></td>
                          <td><?php echo $d['no_rek_giro']; ?></td>
                          <td><?php echo $d['pegawai_no_hp']; ?></td>
                          <td><?php echo $d['pegawai_email']; ?></td>
                          <td><?php echo $d['pegawai_level']; ?></td>
                          <td>    
                            <a class="btn btn-warning btn-sm" href="validasi_baca.php?id=<?php echo $d['pegawai_id'] ?>"><i class="fa fa-cog"></i></a>
                           

                          </td>
                        </tr>
                        <?php 
                      }
                  }else{
                      $filter = $_POST['filter'];
                      $data = mysqli_query($koneksi,"SELECT * FROM validasi WHERE pegawai_level = '$filter'");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                          <td><?php echo $d['pegawai_id']; ?></td>
                          <td><?php echo $d['pegawai_nama']; ?></td>
                          <td><?php echo $d['KPRK']; ?></td>
                          <td><?php echo $d['no_rek_giro']; ?></td>
                          <td><?php echo $d['pegawai_no_hp']; ?></td>
                          <td><?php echo $d['pegawai_email']; ?></td>
                          <td><?php echo $d['pegawai_level']; ?></td>
                          <td>    
                            <a class="btn btn-warning btn-sm" href="validasi_baca.php?id=<?php echo $d['pegawai_id'] ?>"><i class="fa fa-cog"></i></a>
                           

                          </td>
                        </tr>
                        <?php 
                      }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>