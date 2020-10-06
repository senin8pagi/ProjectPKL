  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Made With</b> <i class="fa fa-heart"></i>
    </div>
    <strong>Copyright &copy; 2020</strong> - Sistem Informasi MLOKET
  </footer>

  
</div>


<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../assets/bower_components/raphael/raphael.min.js"></script>
<script src="../assets/bower_components/morris.js/morris.min.js"></script>

<script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="../assets/bower_components/moment/min/moment.min.js"></script>
<script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

<script src="../assets/dist/js/adminlte.min.js"></script>

<script src="../assets/dist/js/pages/dashboard.js"></script>

<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="../assets/bower_components/chart.js/Chart.min.js"></script>

<script>
  $(document).ready(function(){

   // $(".edit").hide();

   $('#table-datatable').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : true,
    "pageLength": 50
  });



 });
  
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  }).datepicker("setDate", new Date());

  $('.datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  });


</script>


<script>
  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

  var barChartData = {
    labels : [],
    datasets : [
    {
      label: 'Pulsa HP',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
        $bulan = date('m');
        $PulsaHP = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as a FROM transaksi where transaksi_jenis='Pulsa HP' and month(transaksi_tanggal)='$bulan'");
        $total_uang = mysqli_fetch_assoc($PulsaHP);

        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      
      ?>
      ]
    },
    {
      label: 'Paket Data',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
        $thn_ini = date('m');
        $PaketData = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi where transaksi_jenis='Paket Data' and month(transaksi_tanggal)='$bulan'");
        $total_uangs = mysqli_fetch_assoc($PaketData);

        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{

          echo $total.",";
        }
      
      ?>
      ]
    },
    ]

  }
//------------------------------------------------------------------------------------------------------------------------------------------------------------
  var barChartData2 = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Pulsa HP',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $PulsaHP = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as a FROM transaksi where transaksi_jenis='Pulsa HP' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
        $total_uang = mysqli_fetch_assoc($PulsaHP);

        // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Paket Data',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $PaketData = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi where transaksi_jenis='Paket Data' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
        $total_uangs = mysqli_fetch_assoc($PaketData);

        // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{

          echo $total.",";
        }
      }
      ?>
      ]
    }
    ]

  }
  //---------------------------------------------------------------------------------------------------------------------
  var barChartData3 = {
    labels : [
    <?php 
    $tahun = mysqli_query($koneksi,"SELECT distinct year(transaksi_tanggal) as tahun FROM transaksi order by year(transaksi_tanggal) asc");
    while($t = mysqli_fetch_array($tahun)){
      ?>
      "<?php echo $t['tahun']; ?>",
      <?php 
    }
    ?>
    ],
    datasets : [
    {
      label: 'Paket Data',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)",
      data : [
      <?php
      $tahun = mysqli_query($koneksi,"SELECT distinct year(transaksi_tanggal) as tahun FROM transaksi order by year(transaksi_tanggal) asc");
      while($t = mysqli_fetch_array($tahun)){
        $thn = $t['tahun'];
        $PaketData = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as b FROM transaksi where transaksi_jenis='Paket Data' and year(transaksi_tanggal)='$thn'");
        $total_uangs = mysqli_fetch_assoc($PaketData);
        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Pulsa HP',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      $tahun = mysqli_query($koneksi,"SELECT distinct year(transaksi_tanggal) as tahun FROM transaksi order by year(transaksi_tanggal) asc");
      while($t = mysqli_fetch_array($tahun)){
        $thn = $t['tahun'];
        $PulsaHP = mysqli_query($koneksi,"SELECT sum(nominal_tagihan) as a FROM transaksi where transaksi_jenis='Pulsa HP' and year(transaksi_tanggal)='$thn'");
        $total_uang = mysqli_fetch_assoc($PulsaHP);
        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    }
    ]

  }

//-----------------------------------------------------------------------------------------------------------------------------------------
  var barChartData4 = {
    labels : [],
    datasets : [
    {
      label: 'Dalam Negeri',
      fillColor : "rgba(120, 142, 176, 1)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
        $bulan = date('m');
        $DALAMNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as a from transaksi where transaksi_jenis='Dalam Negeri' and month(transaksi_tanggal)='$bulan'");
        $total_uang = mysqli_fetch_assoc($DALAMNEGERI);

        // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      
      ?>
      ]
    },
    {
      label: 'Luar Negeri',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
        $bulan = date('m');
        $LUARNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as b from transaksi where transaksi_jenis='Luar Negeri' and month(transaksi_tanggal)='$bulan'");
        $total_uangs = mysqli_fetch_assoc($LUARNEGERI);

        // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{

          echo $total.",";
        }
      
      ?>
      ]
    }
    ]

  }
//---------------------------------------------------------------------------------------------------------------------------------------
var barChartData5 = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Dalam Negeri',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $DALAMNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as a from transaksi where transaksi_jenis='Dalam Negeri' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
        $total_uang = mysqli_fetch_assoc($DALAMNEGERI);

        // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Luar Negeri',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
      <?php
      for($bulan=1;$bulan<=12;$bulan++){
        $thn_ini = date('Y');
        $LUARNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as b from transaksi where transaksi_jenis='Luar Negeri' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
        $total_uangs = mysqli_fetch_assoc($LUARNEGERI);

        // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{

          echo $total.",";
        }
      }
      ?>
      ]
    }
    ]

  }

  //-----------------------------------------------------------------------------------------------------------------

  var barChartData6 = {
    labels : [
    <?php 
    $tahun = mysqli_query($koneksi,"select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
    while($t = mysqli_fetch_array($tahun)){
      ?>
      "<?php echo $t['tahun']; ?>",
      <?php 
    }
    ?>
    ],
    datasets : [
    {
      label: 'Dalam Negeri',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
      <?php
      $tahun = mysqli_query($koneksi,"select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
      while($t = mysqli_fetch_array($tahun)){
        $thn = $t['tahun'];
        $DALAMNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as a from transaksi where transaksi_jenis='Dalam Negeri' and year(transaksi_tanggal)='$thn'");
        $total_uang = mysqli_fetch_assoc($DALAMNEGERI);
        $total = $total_uang['a'];
        if($total_uang['a'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    },
    {
      label: 'Luar negeri',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)",
      data : [
      <?php
      $tahun = mysqli_query($koneksi,"select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
      while($t = mysqli_fetch_array($tahun)){
        $thn = $t['tahun'];
        $LUARNEGERI = mysqli_query($koneksi,"select sum(nominal_tagihan) as b from transaksi where transaksi_jenis='Luar negeri' and year(transaksi_tanggal)='$thn'");
        $total_uangs = mysqli_fetch_assoc($LUARNEGERI);
        $total = $total_uangs['b'];
        if($total_uangs['b'] == ""){
          echo "0,";
        }else{
          echo $total.",";
        }

      }
      ?>
      ]
    }
    ]

  }
//---------------------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------------------

  window.onload = function(){
    var ctx = document.getElementById("grafik1").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

   var ctx = document.getElementById("grafik2").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData2, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

    var ctx = document.getElementById("grafik3").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData3, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

   var ctx = document.getElementById("grafik4").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData4, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

    var ctx = document.getElementById("grafik5").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData5, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

    var ctx = document.getElementById("grafik6").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData6, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });
  }




</script>

</body>
</html>
