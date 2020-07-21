  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=ucwords($title)?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/alumni')?>">Daftar Alumni</a></li>
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
                <h3 class="card-title"><i class="fa fa-user-plus"></i> Tambah Alumni</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" value="<?= set_value('nama')?>" required>
                                <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama">NISN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN"  value="<?= set_value('nisn')?>" required>
                                <small class="text-danger mt-2"><?= form_error('nisn') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="L" type="radio" id="male" name="gender">
                            <label for="male" class="custom-control-label">Laki - Laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" value="P" type="radio" id="female" name="gender">
                            <label for="female" class="custom-control-label">Perempuan</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="visi">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tempat_lahir" id="nama" placeholder="Masukkan Tempat Lahir" value="<?php if (!empty($data_diri)) {echo $data_diri['tempat_lahir'];} else {echo set_value('tempat_lahir');} ?>">
                                <small class="text-danger mt-2"><?= form_error('tempat_lahir') ?></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="tgl_lahir" class="form-control float-right" placeholder="Pilih tanggal" id="datepicker1" value="<?php if (!empty($data_diri['tanggal_lahir'])) { echo DateTime::createFromFormat('Y-m-d', $data_diri['tanggal_lahir'])->format('m/d/Y'); } else {   echo set_value('tanggal_lahir');} ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="thn_masuk" class="form-control float-right" placeholder="Pilih Tahun" id="datepicker2" value="<?php if (!empty($data_diri['tahun_masuk'])) {echo $data_diri['tahun_masuk'];} else {echo set_value('thn_masuk');} ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('thn_masuk') ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Lulus</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="thn_lulus" class="form-control float-right" placeholder="Pilih Tahun" id="datepicker3" value="<?php if (!empty($data_diri)) { echo $data_diri['tahun_lulus'];} else {echo set_value('thn_lulus');} ?>">
                                </div>
                                <!-- /.input group -->
                                <small class="text-danger mt-2"><?= form_error('thn_lulus') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label >Program Studi (Jurusan)</label>
                            <select name="prodi" id="prodi" class="form-control select2bs4" data-placeholder="Pilih Program Studi">
                                <option></option>
                                <?php 
                                foreach($jurusan AS $j) : ?>
                                <option value="<?=$j['id_jurusan']?>"><?=$j['nama_jurusan']?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('prodi') ?></small>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                            <label >Kelas</label>
                            <select name="kelas" id="kelas" class="form-control select2bs4" data-placeholder="Pilih Kelas">
                                <option value=""></option>
                                
                            </select>
                            <small class="text-danger mt-2"><?= form_error('kelas') ?></small>
                            </div>
                        </div> 
                    </div>
                  
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" minlength="8" placeholder="Password">
                            <small class="text-danger mt-2"><?= form_error('password') ?></small>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Konfirmasi Password</label>
                            <input type="password" name="password1" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            <small class="text-danger mt-2"><?= form_error('password1') ?></small>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Foto Pengguna</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                        </div>
                        </div>
                    </div>
                    <img class="mt-2 mb-2 img-preview" src="<?=base_url('assets/img/user/default.png')?>" id="output">
                    <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
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

  <?php $this->load->view('templates/cdn_admin');?>

  <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker1').datepicker({
              autoclose: true
          })
      })
  </script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker2').datepicker({
              autoclose: true,
              format: 'yyyy',
              viewMode: "years",
              minViewMode: "years"
          })
      });

      $(function() {
          //Date picker
          $('#datepicker3').datepicker({
              autoclose: true,
              format: 'yyyy',
              viewMode: "years",
              minViewMode: "years"
          })
      });
  </script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };

    $('#prodi').on('change', function(){
        var id_jurusan = $('#prodi').val();

        $.ajax({
            type : "POST",
            url : "<?= base_url('admin/alumni/get_kelas')?>",
            data : {'id' : id_jurusan},
            dataType : "json",
            success : function(data){

                var html = '';
                var i;

                for(i = 0; i<data.length; i++){
                    html += '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>'
                }

                $('#kelas').html(html);

            }
        })
    });
  </script>
  
