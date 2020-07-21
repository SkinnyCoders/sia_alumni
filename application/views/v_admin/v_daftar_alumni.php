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
            <li class="breadcrumb-item active"><?= ucwords($title) ?></li>
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
              <h3 class="card-title"><i class="far fa-dollar"></i> Data Rekap Alumni</h3>
              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/alumni/tambah') ?>"><i class="fa fa-user-plus"></i> Tambah Alumni</a>
              <a class="btn btn-sm btn-success float-right ml-3" data-toggle="modal" data-target="#modal-rekap" href="javascript:void(0)"><i class="fa fa-download"></i> Download Rekap Alumni</a>
              <a class="btn btn-sm btn-warning float-right ml-3 terima" data-toggle="modal" data-target="#modal-verif" href="javascript:void(0)"><i class="fa fa-check"></i> Verifikasi Alumni</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-nowrap" style="width: 5%">No</th>
                    <th class="text-nowrap" style="width: 10%">NISN</th>
                    <th class="text-nowrap" style="width: 18%">Nama</th>
                    <th class="text-nowrap" style="width: 10%">Jenis Kelamin</th>
                    <th class="text-nowrap" style="width: 15%">Jurusan</th>
                    <th class="text-nowrap" style="width: 10%">No. Telp</th>

                    <th class="text-nowrap" style="width: 10%">Tahun Lulus</th>
                    <th class="text-nowrap" style="width: 10%">Status</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach($alumnis AS $alumni) : 

                  switch($alumni['jenis_kelamin']){
                    case 'P':
                      $gender = 'Perempuan';
                    break;

                    case 'L':
                      $gender = 'Laki - Laki';
                    break;
                  }

                  switch($alumni['status']){
                    case '':
                      $status = 'Belum Diisi';
                      $label = 'default';
                    break;

                    case 'bekerja':
                      $status = 'Bekerja';
                      $label = 'success';
                    break;

                    case 'kuliah':
                      $status = 'Kuliah';
                      $label = 'success';
                    break;

                    case 'tidak':
                      $status = 'Belum / Tidak Kuliah';
                      $label = 'warning';
                    break;

                    case 'bekerja kuliah':
                      $status = 'Bekerja & Kuliah';
                      $label = 'success';
                    break;
                  }
                  
                  ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$alumni['nisn']?></td>
                      <td><?=ucwords($alumni['nama'])?></td>
                      <td><?=$gender?></td>
                      <td><?=ucwords($alumni['nama_jurusan'])?></td>
                      <td><?php if(!empty($alumni['telepon'])){ echo $alumni['telepon']; }else{echo 'belum diisi';}?></td>
                      <td><?=$alumni['tahun_lulus']?></td>
                      <td><label class="btn btn-sm btn-<?=$label?>"><?=$status?></label>
                      </td>
                      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-lg" id="<?=$alumni['nisn']?>" class="btn btn-sm mr-2 btn-primary detail"><i class="fa fa-eye"></i></a>  <a href="javascript:void(0)" id="<?=$alumni['nisn']?>" class="btn btn-sm btn-danger mr-3 delete"><i class="fa fa-trash"></i></a></td>
                  <!-- 
                      <a href="<?= base_url('operator/pendaftar/detail/') ?>" target="_blank" id="" class="btn btn-xs btn-warning update"><i class="fa fa-edit"></i></a> -->
                    </tr>
                    <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div class="modal fade" id="modal-verif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Verifikasi Alumni Mendaftar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- form start -->
                          <form id="frm_input_srt" action="<?=base_url('admin/alumni/verifikasi')?>" method="post" role="form">
                          <input type="hidden" name="tolak" id="tolak-val">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive" id="penerimaan">
                                        <table id="table-penerimaan" class="table table-hover" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap" style="width: 5%">Terima</th>
                                                    <th class="text-nowrap" style="width: 10%">NISN</th>
                                                    <th class="text-nowrap" style="width: 25%">Nama Peserta</th>
                                                    <th class="text-nowrap" style="width: 20%">Jenis Kelamin</th>
                                                    <!-- <th class="text-nowrap">Nilai Seleksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="table-peserta">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer content-right">
                    <button type="submit" name="simpan" class="btn btn-primary terima-peserta">Verifikasi</button>
                    <button type="submit" class="btn btn-danger tolak-peserta">Tolak Alumni</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

      <div class="modal fade" id="modal-rekap">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Download Laporan Alumni</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url()?>admin/alumni/rekap" method="post">
                                <div class="form-group">
                                    <label for="">Perjurusan</label>
                                    <select name="jurusan" class="form-control select2bs4" data-placeholder="Pilih Jurusan (Kosongkan Jika ingin semua jurusan)" id="">
                                        <option></option>
                                        <?php
                                        foreach($jurusan AS $j){
                                            echo '<option value="'.$j['id_jurusan'].'">'.ucwords($j['nama_jurusan']).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Per Tahun Lulus</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="thn_lulus" class="form-control float-right" placeholder="Pilih Tahun (Kosongkan Jika ingin semua tahun lulus)" id="datepicker3" value="<?php if (!empty($data_diri)) { echo $data_diri['tahun_lulus'];} else {echo set_value('thn_lulus');} ?>">
                                    </div>
                                    <!-- /.input group -->
                                    <small class="text-danger mt-2"><?= form_error('thn_lulus') ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Per Tahun Masuk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="thn_masuk" class="form-control float-right" placeholder="Pilih Tahun (Kosongkan Jika ingin semua tahun masuk)" id="datepicker2" value="<?php if (!empty($data_diri['tahun_masuk'])) {echo $data_diri['tahun_masuk'];} else {echo set_value('thn_masuk');} ?>">
                                    </div>
                                    <!-- /.input group -->
                                    <small class="text-danger mt-2"><?= form_error('thn_masuk') ?></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="download" class="btn btn-success btn-block">Download Laporan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-primary">
                <h3 class="widget-user-username"><span id="nama"></span></h3>
                <h5 class="widget-user-desc">NISN : <span id="nisn_detail"></span> | Jurusan : <span id="jurusan"></span></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" style="height:100px; width:100px;" src="<?=base_url()?>assets/img/user/default.png" id="foto" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h4 class="description-header">Data Diri</h4>
                      <hr style="width:30%; border:1px solid #eaeaea;">
                    </div>
                    <table class="table table-borderless">
                      <tr>
                        <th style="width: 35%">Email</th>
                        <td>: <span id="email"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Tanggal Lahir</th>
                        <td>: <span id="tanggal_lahir"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Tempat Lahir</th>
                        <td>: <span id="tempat_lahir"></span></td>
                      </tr>
                      
                      <tr>
                        <th style="width: 35%">Jenis Kelamin</th>
                        <td>: <span id="jenis_kelamin"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Telpon</th>
                        <td>: <span id="telepon"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Agama</th>
                        <td>: <span id="agama"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Tahun Masuk</th>
                        <td>: <span id="tahun_masuk"></span> - <span id="tahun_lulus"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 35%">Alamat</th>
                        <td>: <span id="alamat"></span></td>
                      </tr>
                    </table>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h4 class="description-header">Status Alumni</h4>
                      <hr style="width:30%; border:1px solid #eaeaea;">
                    </div>
                    <table class="table table-borderless">
                      <tr>
                        <th style="width: 20%">Status</th>
                        <td>: <span id="status"></span></td>
                      </tr>
                      <tr>
                        <th style="width: 20%">Deskripsi</th>
                        <td>: <span id="deskripsi"></span></td>
                      </tr>
                    </table>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
  </section>
</div>



<!-- /.content-wrapper -->

<?php $this->load->view('templates/cdn_admin'); ?>

<!-- bootstrap datepicker -->
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

  $('.terima').on('click',function(){
    $.ajax({
        type: 'POST',
        url: "<?= base_url('/admin/alumni/alumni_daftar') ?>",
        dataType: "json",
        success: function(data) {
            var html = '';
            var i;

            if (data.length != 0) {
              for (i = 0; i < data.length; i++) {
                if(data[i].jenis_kelamin == 'P'){
                  var gender = 'Perempuan';
                }else{
                  var gender = 'Laki - Laki';
                }
                  html += '<tr><td><div class="icheck-danger"><input type="checkbox" class="form-control" name="terima[]" id="terima' + i + '" value="' + i + '"><label for="terima' + i + '"></label><input type="hidden" name="nisn' + i + '" value="' + data[i].nisn + '"></div></td><td>' + data[i].nisn + '</td><td>' + data[i].nama + '</td><td>'+ gender +'</td></tr>'
              }
            } else {
                html += '<tr><td colspan="5" class="text-center">-- Belum Ada Data Alumni Mendaftar --</td></tr>'
            }
            $('.table-peserta').html(html);
        }
    });
  });

  $('.tolak-peserta').on('click',function(e){
        e.preventDefault();
         Swal.fire({
           title: 'Konfirmasi Tolak Alumni',
           text: "Apakah anda yakin ingin mengkonfirmasi tolak Alumni?, pastikan anda sudah memilih peserta yang ingin ditolak!",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Ya, Tolak!'
         }).then(
           function(isConfirm){
            if (isConfirm.value){
                $('#tolak-val').val('true');
                $('#frm_input_srt').submit();
            }else{
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            };
        });
    });


  $(function() {
    $("#example1").DataTable({});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  $('.detail').click(function(){
    var nisn = this.id;

    $.ajax({
      type : "post",
      url : "<?=base_url()?>admin/alumni/detail",
      data : {'nisn' : nisn},
      dataType : "json",
      success : function(res){
        $('#email').text(res.email);
        $('#agama').text(res.agama);
        $('#jenis_kelamin').text(res.jenis_kelamin);
        $('#tahun_lulus').text(res.tahun_lulus);
        $('#tahun_masuk').text(res.tahun_masuk);
        $('#telepon').text(res.telepon);
        $('#tempat_lahir').text(res.tempat_lahir);
        $('#tanggal_lahir').text(res.tanggal_lahir);
        $('#alamat').text(res.alamat);
        $('#status').text(res.status);
        $('#deskripsi').text(res.deskripsi);
        $('#nama').text(res.nama);
        $('#nisn_detail').text(res.nisn);
        $('#jurusan').text(res.jurusan);
        $('#foto').attr('src', res.foto);

      }
    })
  });

  $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Alumni',
       text: "Apakah anda yakin ingin menghapus data alumni ini?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Hapus!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>admin/alumni/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/alumni') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/alumni') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });

</script>