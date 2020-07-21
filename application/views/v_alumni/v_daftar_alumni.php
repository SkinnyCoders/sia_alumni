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
             <li class="breadcrumb-item"><a href="<?= base_url('alumni/dashboard') ?>">Dashboard</a></li>
             <li class="breadcrumb-item active">Daftar Alumni</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
        <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Daftar Alumni</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Cari Alumni</label>
                        <input type="text" name="cari" placeholder="Masukkan NISN, Nama, Atau Jurusan, Kosongkan untuk menampilkan semua alumni" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-block btn-primary float-right"><i class="fa fa-search"></i> Tampilkan</button>
                        </div>
                    </div>
                 </form>

                 <?php if(!empty($alumnis)) :?>
                    <hr>
                 <table id="example1" class="table table-striped mt-4   ">
                    <thead>
                    <tr>
                        <th class="text-nowrap" style="width: 5%">No</th>
                        <th class="text-nowrap" style="width: 10%">NISN</th>
                        <th class="text-nowrap" style="width: 20%">Nama</th>
                        <th class="text-nowrap" style="width: 10%">Jenis Kelamin</th>
                        <th class="text-nowrap" style="width: 15%">Jurusan</th>
                        <th class="text-nowrap" style="width: 15%">No. Telp</th>

                        <th class="text-nowrap" style="width: 10%">Tahun Lulus</th>
                        <th class="text-nowrap" style="width: 10%">Status</th>
                        <th>Detail</th>
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
                        <td><img src="<?=base_url()?>assets/img/user/<?=$alumni['foto']?>" style="width:30px; height:30px;" class="img-circle mr-2" alt=""> <?=ucwords($alumni['nama'])?></td>
                        <td><?=$gender?></td>
                        <td><?=ucwords($alumni['nama_jurusan'])?></td>
                        <td><?php if(!empty($alumni['telepon'])){ echo $alumni['telepon']; }else{echo 'belum diisi';}?></td>
                        <td><?=$alumni['tahun_lulus']?></td>
                        <td><label class="btn btn-sm btn-<?=$label?>"><?=$status?></label>
                        </td>
                        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-lg" id="<?=$alumni['nisn']?>" class="btn btn-sm mr-2 btn-primary detail"><i class="fa fa-eye"></i></a></td>
                    <!-- 
                        <a href="<?= base_url('operator/pendaftar/detail/') ?>" target="_blank" id="" class="btn btn-xs btn-warning update"><i class="fa fa-edit"></i></a> -->
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php endif; ?>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

 <script>

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

   var loadFile = function(event) {
     var output = document.getElementById('output');
     output.src = URL.createObjectURL(event.target.files[0]);
   };

   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/sekolah/tahun_ajaran/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id_tahun').val(data.id_tahun_ajaran);
         $('.tgl_mulai').val(data.tahun_mulai);
         $('.tgl_akhir').val(data.tahun_akhir);
       },
     });
   });
 </script>