<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">

    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <?php 
            $PulsaHP = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as a FROM transaksi WHERE transaksi_jenis='Pulsa HP'");
            $p = mysqli_fetch_assoc($PulsaHP);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. ".number_format($p['a'])." ,-" ?></h4>
            <p>Total Seluruh Transaksi Jenis Pulsa HP</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
 
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <?php 
            $PaketData = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi WHERE transaksi_jenis='Paket Data'");
            $p = mysqli_fetch_assoc($PaketData);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. ".number_format($p['b'])." ,-" ?></h4>
            <p>Total Seluruh Transaksi PaketData</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php 
            $LuarNegeri = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi WHERE transaksi_jenis='Luar Negeri'");
            $p = mysqli_fetch_assoc($LuarNegeri);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. ".number_format($p['b'])." ,-" ?></h4>
            <p>Total Seluruh Transaksi Luar Negeri</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-orange">
          <div class="inner">
            <?php 
            $DalamNegeri = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi WHERE transaksi_jenis='Dalam Negeri'");
            $p = mysqli_fetch_assoc($DalamNegeri);
            ?>
            <h4 style="font-weight: bolder"><?php echo "Rp. ".number_format($p['b'])." ,-" ?></h4>
            <p>Total Seluruh Transaksi Dalam Negeri</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

























    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <!-- Left col -->
     <section class="col-lg-8">

        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs pull-right">
            <li><a href="#tab2" data-toggle="tab">Kurir</a></li>
            <li><a href="#tab1" data-toggle="tab">Pos Pay</a></li>
            <li class="pull-left header">Grafik</li>
          </ul>

          <div class="tab-content" style="padding: 20px">

            <div class="chart tab-pane active" id="tab1">

              
              <h4 class="text-center">Grafik Data Jenis Transaksi Pospay</h4>

              <div id="date1" style="text-align: center; font-size: 20px;"></div>
                      <script type='text/javascript'>
                        <!--
                          var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                          var myDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                          var date1 = new Date();
                          var day = date1.getDate();
                          var month = date1.getMonth();
                          var thisDay = date1.getDay(),
                          thisDay = myDays[thisDay];
                         
                          document.getElementById('date1').innerHTML=months[month];
                          // document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                          //-->
                        </script>
              <canvas id="grafik1" style="position: relative; height: 300px;"></canvas>

              <br/>
              <br/>
              <br/>

              <h4 class="text-center">Grafik Data Jenis Transaksi Pospay Per <b>Bulan</b></h4>
              <canvas id="grafik2" style="position: relative; height: 300px;"></canvas>

              <br/>
              <br/>
              <br/>

              <h4 class="text-center">Grafik Data Jenis Transaksi Pospay Per <b>Tahun</b></h4>
              <canvas id="grafik3" style="position: relative; height: 300px;"></canvas>

            </div>
            <div class="chart tab-pane active" id="tab2">


              <h4 class="text-center">Grafik Data Jenis Transaksi Kurir</h4>

              <div id="date2" style="text-align: center; font-size: 20px;"></div>
                      <script type='text/javascript'>
                        <!--
                          var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                          var myDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                          var date2 = new Date();
                          var day = date2.getDate();
                          var month = date2.getMonth();
                          var thisDay = date2.getDay(),
                          thisDay = myDays[thisDay];
                         
                          document.getElementById('date2').innerHTML=months[month];
                          // document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                          //-->
                        </script>
              <canvas id="grafik4" style="position: relative; height: 300px;"></canvas>


              <br/>
              <br/>
              <br/>

              <h4 class="text-center">Grafik Data Jenis Transaksi Kurir Per <b>Bulan</b></h4>
              <canvas id="grafik5" style="position: relative; height: 300px;"></canvas>

              <br/>
              <br/>
              <br/>

              <h4 class="text-center">Grafik Data Jenis Transaksi Kurir Per <b>Tahun</b></h4>
              <canvas id="grafik6" style="position: relative; height: 300px;"></canvas>
            </div>
            <!-- ------------------ -->
            
          </div>
        </div>

      </section>
      <!-- /.Left col -->


      <section class="col-lg-4">


        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Kalender</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
          </div>
          <!-- /.box-body -->
        </div>
      </section>

      <section class="col-lg-4">
      	<div class="x_panel">
              <div class="x_title">
                <h3>Today</h3>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="temperature">
                      <!-- Menampilkan Hari, Bulan dan Tahun -->
                      <div id="date" style="text-align: center; font-size: 20px;"></div>
                      <script type='text/javascript'>
                        <!--
                          var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                          var myDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                          var date = new Date();
                          var day = date.getDate();
                          var month = date.getMonth();
                          var thisDay = date.getDay(),
                          thisDay = myDays[thisDay];
                          var yy = date.getYear();
                          var year = (yy < 1000) ? yy + 1900 : yy;
                         
                          document.getElementById('date').innerHTML=thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
                          // document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                          //-->
                        </script>

                        <!-- Menampilkan Jam (Aktif) -->
                        <div id="clock" class="clock" style="text-align: center; font-size: 40px;"></div>
                        <script type="text/javascript">
                          <!--
                            function showTime() {
                              var a_p = "";
                              var today = new Date();
                              var curr_hour = today.getHours();
                              var curr_minute = today.getMinutes();
                              var curr_second = today.getSeconds();
                              if (curr_hour < 12) {
                                a_p = "AM";
                              } else {
                                a_p = "PM";
                              }
                              if (curr_hour == 0) {
                                curr_hour = 12;
                              }
                              if (curr_hour > 12) {
                                curr_hour = curr_hour - 12;
                              }
                              curr_hour = checkTime(curr_hour);
                              curr_minute = checkTime(curr_minute);
                              curr_second = checkTime(curr_second);
                              document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
                            }

                            function checkTime(i) {
                              if (i < 10) {
                                i = "0" + i;
                              }
                              return i;
                            }
                            setInterval(showTime, 500);
                            //-->
                          </script>
                    </div>
                  </div>
                </div>
                <br>

                <div class="clearfix"></div>
              </div>
            </div>

            <!-- <div class="block">
                    <div class="block_content">
                      <h3 class="title">
                        <a href="https://www.posindonesia.co.id/id/content/11" target="_blank">O-Ranger</a> 
                      </h3>
                      <h4>
                      <p>
                       O-ranger merupakan mitra Pos Indonesia yang bertugas untuk memasarkan produk Pos Indonesia dan melakukan layanan penjemputan barang (pick up service) di masing-masing area.
                      </p>
                      </h4>
                    </div>
                  </div> -->

      	
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->










  </section>

</div>

















<?php include 'footer.php'; ?>