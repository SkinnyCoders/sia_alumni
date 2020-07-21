  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= ucwords($title) ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/lowongan') ?>">Daftar Lowongan</a></li>
              <li class="breadcrumb-item active">Tambah</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default ">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus"></i> Tambah Lowongan Pekerjaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="kelas">Posisi Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="posisi" id="posisi" placeholder="Masukkan Posisi Pekerjaan" value="<?php echo set_value('kelas'); ?>">
                    <small class="text-danger mt-2"><?= form_error('kelas') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="kelas">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="perusahaan" id="perusahaan" placeholder="Masukkan Nama Perusahaan" value="<?php echo set_value('kelas'); ?>">
                        <small class="text-danger mt-2"><?= form_error('perusahaan') ?></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tahun">Penempatan <span class="text-danger">*</span></label>
                        <select id="provinsi" class="form-control select2bs4" name="penempatan" style="width: 100%;" data-placeholder="Pilih Penempatan">
                          <option></option>
                        </select>
                        <small class="text-danger mt-2"><?= form_error('penempatan') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="misi">Deskripsi Lowongan <span class="text-danger">*</span></label>
                    <textarea id="misi" name="des" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"></textarea>
                    <small class="text-danger mt-2"><?= form_error('des') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="exampleInputFile">Gambar Lowongan</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih File Gambar</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Tanggal Berakhir</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                  </span>
                              </div>
                              <input type="text" name="tgl_berakhir" class="form-control float-right" placeholder="Pilih Tanggal" id="datepicker">
                          </div>
                          <!-- /.input group -->
                          <small class="text-danger mt-2"><?= form_error('tgl_berakhir') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2" style="width: 200px;" src="" id="output">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tambahkan!</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    $(function() {
          //Date picker
          $('#datepicker').datepicker({
              autoclose: true
          })
      });
  </script>

  <script>
  $(document).ready(function(){
      $.ajax({
          type : "GET",
          url : "<?=base_url('admin/lowongan/provinsi')?>",
          dataType : "json",
          success : function(data){
            var html = '<option></option>';
            var i;

            for (i = 0; i < data.rajaongkir.results.length; i++) {
                html += '<option value="' + data.rajaongkir.results[i].province + '">' + data.rajaongkir.results[i].province + '</option>'
            }

            $('#provinsi').html(html);
          }
      })
  })
  </script>
  
  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>