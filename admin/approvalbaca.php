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
            <a href="approval.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a>
          </div>
          <div class="box-body">
            <form action="approval_update.php" method="post" enctype="multipart/form-data">
              <?php 
              $id = $_GET['id'];              
              $data = mysqli_query($koneksi, "SELECT * FROM approval as a, t_pegawailoket as b where a.pegawai_id=b.pegawai_id and a.pegawai_id=$id");
              while($d = mysqli_fetch_array($data)){
                ?>

                 <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" class="form-control" name="Tanggal" value="<?php echo $d['tgl_req'] ?>" required readonly="required">
                </div>

                 <div class="form-group">
                  <label>Jenis</label>
                  <input type="text" class="form-control" name="jenis" value="<?php echo $d['jenis_approval'] ?>" required readonly="required">
                </div>


                <div class="form-group">
                  <label>User Id</label>
                  <input type="text" class="form-control" name="id" value="<?php echo $d['pegawai_id'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="username" value="<?php echo $d['pegawai_nama'] ?>" required readonly="required">
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
                  <label>Kode Verifikasi</label>
                  <input type="text" class="form-control" name="kode Verifikasi" value="<?php echo $d['kode_verifikasi'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <input type="text" class="form-control" name="status" value="<?php echo $d['status'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>User Approved</label>
                  <input type="text" class="form-control" name="user Approved" value="<?php echo $d['pegawai_nama'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Waktu Request</label>
                  <input type="text" class="form-control" name="no HP" value="<?php echo $d['tgl_req'] ?>" required readonly="required">
                </div>

                <div class="form-group">
                  <label>Waktu Approved</label>
                  <input type="text" class="form-control" name="Email" value="<?php echo $d['tgl_approve'] ?>" required readonly="required">
                </div>
                <button type="submit" class="btn btn-success" style="text-align:center">Approved</button>
                 <div class="modal-footer">
                </div>
				<input type="hidden" name="id" value="<?= $id ?>">
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