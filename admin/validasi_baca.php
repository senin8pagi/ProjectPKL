` <?php 
include 'header.php';
include '../koneksi.php';
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengguna
      <small>Detail Data Petugas Loket</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Detail Data Petugas Loket</h3>
            <a href="validasi.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a>
          </div>
          <div class="box-body">
            <form action="validasi_update.php" method="post" >
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "SELECT * FROM validasi as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id and a.pegawai_id=$id");
              while($d = mysqli_fetch_array($data)){
                ?>

                <div class="form-group">
                  <label>User Id</label>
                  <input type="text" class="form-control" name="id" value="<?php echo $d['pegawai_id'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="username" value="<?php echo $d['pegawai_nama'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>KPRK</label>
                  <input type="text" class="form-control" name="KPRK" value="<?php echo $d['KPRK'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>No Rek Giro</label>
                  <input type="text" class="form-control" name="no Rek Giro" value="<?php echo $d['no_rek_giro'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>No Hp / Seluler</label>
                  <input type="text" class="form-control" name="no HP" value="<?php echo $d['pegawai_no_hp'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="Email" value="<?php echo $d['pegawai_email'] ?>" required readonly="required">
                </div>
                
                <div class="form-group">
                  <label>Status</label>
                  <input type="text" class="form-control" name="Status" value="<?php echo $d['pegawai_level'] ?>" required readonly="required">
                </div>
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="btnapproval" class="btn btn-success" style="text-align:center">Approval</button>
                <button type="submit" name="btnblokir" class="btn btn-danger" style="text-align:center">Blokir</button>
                <button type="submit" name="btnnorek" class="btn btn-primary" style="text-align:center">Get Rekening</button>


                 <div class="modal-footer">
                </div>
                <?php
              }

              ?>
              
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>


<?php include 'footer.php'; ?>

