  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard Alumni</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?php echo $total['lowongan']?></h3>

                <p>Lowongan Kerja</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
              <a href="<?= base_url('alumni/lowongan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $total['event']?></h3>

                <p>Event</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="<?= base_url('alumni/event') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $total['pesan']?></h3>

                <p>Pesan</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes"></i>
              </div>
              <a href="<?= base_url('alumni/pesan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
        <div class="col-md-12">
        <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Selamat Datang <?=$this->session->userdata('nama')?></h5>
                  Dengan adanya aplikasi ini kami berharap agar alumni yang ada dapat kami tracking keberadaannya, sehingga ada timbal balik hubungan antara pihak sekolah dan alumni yang ada. Keberadaan Alumni merupakan asset yang harus dipertahankan, mengingat almamater dengan alumni tidak bisa dipisahkan dalam hal berkomunikasi. Ada kebanggaan tersendiri jika kami bisa terus berkomunikasi dengan alumni yang ada. Terima kasih atas segala bentuk kerjasama yang telah dilakukan, besar harapan kami untuk segala testimoni, kritik dan saran anda kepada kami, Silahkan lengkapi dan selalu perbarui data diri dan status anda.
                </div>
        </div>
      </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <!-- ChartJS -->
  <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>

  <script>
    $(document).ready(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var donutData = {
        labels: [
          'Pendaftar',
          'Diterima',
          'Ditolak',
          'Dicadangkan',
          'Daftar Ulang'
        ],
        datasets: [{
          data: [1000, 500, 100, 380, 20],
          backgroundColor: ['#00c0ef', '#00a65a', '#f56954', '#f39c12', '#eaeaea'],
        }]
      }
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: donutData,
        options: pieOptions
      })
    })
  </script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('kepsek/dashboard/get_dataChart2')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: [
                          'Laki - Laki',
                          'Perempuan'
                        ],
                        datasets: [{
                          data: data.jumlah,
                          backgroundColor: ['#00c0ef', '#00a65a'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('kepsek/dashboard/get_dataChart3')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart3').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: data.nama_jurusan,
                        datasets: [{
                          data: data.jurusan,
                          backgroundColor: ['#f39c12','#00a65a','#f56954','#00c0ef',  '#eaeaea'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>