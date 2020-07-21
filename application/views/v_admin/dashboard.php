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
              <li class="breadcrumb-item active">Dashboard Admin</li>
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
                <h3><?php  echo $total[0] ?></h3>

                <p>Lowongan Kerja</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
              <a href="<?= base_url('admin/lowongan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php  echo $total[1] ?></h3>

                <p>Event</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="<?= base_url('admin/event') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php  echo $total[2] ?></h3>

                <p>Pesan</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes"></i>
              </div>
              <a href="<?= base_url('admin/pesan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- DONUT CHART -->
          <div class="col-md-12">
            <!-- PIE CHART -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Grafik Alumni</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <canvas id="pieChart" style="height:230px; min-height:300px"></canvas>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <canvas id="pieChart2" style="height:230px;"></canvas>
                      </div>
                    </div>
                    <div class="row mt-5">
                      <div class="col-md-12">
                        <canvas id="pieChart3" style="height:230px;"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <canvas id="myChart" width="400" height="200"></canvas>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
  var ctx = document.getElementById("myChart");
    var barOption = {
      scales: {
        yAxes: [{
          stacked: true,
          ticks: {
            beginAtZero: true
          }
        }],
        xAxes: [{
          stacked: true,
          ticks: {
            beginAtZero: true
          }
        }]

      }
    }

  $.ajax({
    type : 'POST',
    url : "<?=base_url('admin/dashboard/get_barChart')?>",
    dataType : "json",
    success: function(data){

      var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.label,
        datasets: [{
            label: 'Kerja',
            data: data.kerja,
            backgroundColor: [
              'rgba(127,255,0, 0.2)',
              'rgba(127,255,0, 0.2)',
              'rgba(127,255,0, 0.2)',
              'rgba(127,255,0, 0.2)',
              'rgba(127,255,0, 0.2)',
              'rgba(127,255,0, 0.2)'
            ],
            borderColor: [
              'rgba(127,255,0,1)',
              'rgba(127,255,0,1)',
              'rgba(127,255,0,1)',
              'rgba(127,255,0,1)',
              'rgba(127,255,0,1)',
              'rgba(127,255,0,1)'
            ],
            borderWidth: 2
          },
          {
            label: 'Kerja & Kuliah',
            data: data.kerja_kuliah,
            backgroundColor: [
              'rgba(60,141,188,0.2)',
              'rgba(60,141,188,0.2)',
              'rgba(60,141,188,0.2)',
              'rgba(60,141,188,0.2)',
              'rgba(60,141,188,0.2)',
              'rgba(60,141,188,0.2)'
            ],
            borderColor: [
              'rgba(60,141,188,1)',
              'rgba(60,141,188,1)',
              'rgba(60,141,188,1)',
              'rgba(60,141,188,1)',
              'rgba(60,141,188,1)',
              'rgba(60,141,188,1)'
            ],
            borderWidth: 2
          },
          {
            label: 'Kuliah',
            data: data.kuliah,
            backgroundColor: [
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255, 159, 64, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
          },
          {
            label: 'Belum Bekerja',
            data: data.tidak,
            backgroundColor: [
              'rgba(205,92,92, 0.2)',
              'rgba(205,92,92, 0.2)',
              'rgba(205,92,92, 0.2)',
              'rgba(205,92,92, 0.2)',
              'rgba(205,92,92, 0.2)',
              'rgba(205,92,92, 0.2)'
            ],
            borderColor: [
              'rgba(205,92,92,  1)',
              'rgba(205,92,92,  1)',
              'rgba(205,92,92,  1)',
              'rgba(205,92,92,  1)',
              'rgba(205,92,92,  1)',
              'rgba(205,92,92,  1)'
            ],
            borderWidth: 2
          }
        ]
      },
      options: barOption
    });
    }
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
                url : "<?=base_url('admin/dashboard/get_dataChart')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: [
                          'Bekerja',
                          'Kuliah',
                          'Bekerja Sambil Kulaih',
                          'Belum / Tidak Bekerja',
                        ],
                        datasets: [{
                          data: data.total,
                          backgroundColor: ['#00c0ef', '#00a65a', '#f39c12', '#f56954'],
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
                url : "<?=base_url('admin/dashboard/get_dataChart2')?>",
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
                url : "<?=base_url('admin/dashboard/get_dataChart3')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart3').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: data.nama_jurusan,
                        datasets: [{
                          data: data.jurusan,
                          backgroundColor: ['#00c0ef','#f56954','#00a65a','#f39c12',  '#eaeaea'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>