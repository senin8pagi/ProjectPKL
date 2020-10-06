<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Jenis
      <small>Data jenis</small>
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
            <h3 class="box-title">Jenis Transaksi Keuangan</h3>
            <div class="btn-group pull-right">            

              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Jenis
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal -->
            <form action="jenis_act.php" method="post">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Kategori</label>
                        <!-- <select name="kategori" class="form-control" required="required" onChange='onChangeKategori(this.value)'> -->
                          <select name="kategori" class="form-control" required="required">
                          <option value="">- Pilih -</option>
                          <?php 
                          $kategori = mysqli_query($koneksi,"SELECT * FROM kategori ORDER BY kategori ASC");
                          while($k = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                            <?php 
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Nama Jenis</label>
                        <input type="text" id="namaJenis" name="namaJenis" required="required" class="form-control" placeholder="Nama Jenis ..">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM jenis ");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['jenis_nama']; ?></td>
                      <td>    
                        <?php 
                        if($d['jenis_id']){
                          ?> 
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_jenis_<?php echo $d['jenis_id'] ?>">
                            <i class="fa fa-cog"></i>
                          </button>

                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_jenis_<?php echo $d['jenis_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                          <?php 
                        }
                        ?>

                        <form action="jenis_update.php" method="post">
                          <div class="modal fade" id="edit_jenis_<?php echo $d['jenis_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Jenis</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <div class="form-group" style="width:100%">
                                    <label>Nama Jenis</label>
                                    <input type="hidden" id="jenisIdEdit" name="jenisIdEdit" required="required" class="form-control" placeholder="Nama Jenis .." value="<?php echo $d['jenis_id']; ?>">
                                    <input type="text" id="jenisNameEdit" name="jenisNameEdit" required="required" class="form-control" placeholder="Nama Jenis .." value="<?php echo $d['jenis_nama']; ?>" style="width:100%">
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                        <!-- modal hapus -->
                        <div class="modal fade" id="hapus_jenis_<?php echo $d['jenis_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                <p>Yakin ingin menghapus data ini ?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <a href="jenis_hapus.php?id=<?php echo $d['jenis_id'] ?>" class="btn btn-primary">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </td>
                    </tr>
                    <?php 
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

<script type="text/javascript">
function onChangeKategori(id) {
  $.ajax({
    'url': 'http://localhost/posindonesia/admin/getSubKategori.php',
    'type': 'POST',
    'dataType': 'json',
    'data': {
      id: id
    },
    success: function(res){
      let resId = res.jenis_id;
      let nama = res.jenis_nama;
      $("#namaJenis").val(nama);
      console.log(nama);
    }
  })
}
</script>