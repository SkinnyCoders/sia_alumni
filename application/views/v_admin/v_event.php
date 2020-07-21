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
                          <li class="breadcrumb-item active">Daftar Event</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Event</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/event/tambah') ?>"><i class="fa fa-plus"></i> Tambah Event</a>
                              <!-- <a class="btn btn-sm btn-success float-right ml-3" href="<?= base_url('admin/event/rekap') ?>"><i class="fa fa-download"></i> Download Rekap Event</a> -->
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Gambar</th>
                                 <th class="text-nowrap">Event</th>
                                 <th class="text-nowrap">Tanggal - Waktu</th>
                                 <th class="text-nowrap">Lokasi</th>
                                 <th class="text-nowrap">Deskripsi</th>
                                 <th class="text-nowrap">Tanggal Post</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($events as $acara) :
                              ?>
                              <tr>
                                <td><?=$no++?></td>
                                
                                <td><img class="brand-image" style="width: 70px; height: 70px; border-radius: 5%" src="<?= base_url('assets/uploads/file_berita/' . $acara['gambar_event']) ?>"></td>
                                <td><?=ucwords($acara['judul_event'])?></td>
                                <td><?=ucwords($acara['tanggal_event'])?> pukul <?=ucwords($acara['waktu_event'])?></td>
                                <td><?=$acara['lokasi_event']?></td>
                                <td><?= ucwords(word_limiter($acara['deskripsi_event'], 27))?></td>
                                <td><?= DateTime::createFromFormat('Y-m-d H:i:s', $acara['create_at'])->format('d/m/Y') ?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$acara['id_event']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$acara['id_event']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                              </tr>
                              <?php 
                              endforeach;
                               ?>
                             </tbody>
                           </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>

              <div class="modal fade" id="modal-lg">
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Edit Event</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                    <form action="<?= base_url('admin/event/update') ?>" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="id_event" value="">
                      <div class="form-group">
                    <label for="kelas">Nama Event <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Event" value="<?php echo set_value('kelas'); ?>">
                    <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="kelas">Lokasi Event <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Masukkan Lokasi Event Diselenggarakan" value="<?php echo set_value('kelas'); ?>">
                        <small class="text-danger mt-2"><?= form_error('lokasi') ?></small>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Tanggal Event</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                  </span>
                              </div>
                              <input type="text" name="tgl" class="form-control float-right tgl" placeholder="Pilih Tanggal" id="datepicker">
                          </div>
                          <!-- /.input group -->
                          <small class="text-danger mt-2"><?= form_error('tgl') ?></small>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Waktu Event</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">
                                      <i class="far fa-clock"></i>
                                  </span>
                              </div>
                              <input type="time" name="waktu" class="form-control float-right waktu" placeholder="Pilih Waktu" id="datepicker1">
                          </div>
                          <!-- /.input group -->
                          <small class="text-danger mt-2"><?= form_error('waktu') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="misi">Deskripsi Event <span class="text-danger">*</span></label>
                    <textarea id="des" name="des" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"></textarea>
                    <small class="text-danger mt-2"><?= form_error('des') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputFile">Gambar Event</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih File Gambar</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2 img" style="width: 200px;" src="" id="output">
                    </div>
                  </div>
                    </div>
                    <!-- /.card-body -->
                   <div class="modal-footer justify-content-between">
                     <button type="submit" name="simpan" class="btn btn-primary">Perbarui</button>
                     </form>
                   </div>
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/event/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#id_event').val(data.id);     
          $('#nama').val(data.nama);
          $('#lokasi').val(data.lokasi);
          $('.tgl').val(data.tanggal);
          $('#des').text(data.deskripsi);
          $('.img').attr('src', data.thumbnail);
          $('.waktu').val(data.waktu);    
       },
     });
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Event',
       text: "Apakah anda yakin ingin menghapus data ini?",
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
             url: "<?= base_url() ?>admin/event/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/event') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/event') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>

<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>