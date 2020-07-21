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
                          <li class="breadcrumb-item active">Daftar Lowongan</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Lowongan Pekerjaan</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/lowongan/tambah') ?>"><i class="fa fa-plus"></i> Tambah Lowongan</a>
                              <!-- <a class="btn btn-sm btn-success float-right ml-3" href="<?= base_url('admin/lowongan/rekap') ?>"><i class="fa fa-download"></i> Download Rekap Lowongan</a> -->
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Gambar</th>
                                 <th class="text-nowrap">Posisi - Perusahaan</th>
                                 <th class="text-nowrap">Penempatan</th>
                                 <th class="text-nowrap">Deskripsi</th>
                                 <th class="text-nowrap">Berakhir</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($lowongans as $lowongan) :
                              ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><img class="brand-image" style="width: 70px; height: 70px; border-radius: 5%" src="<?= base_url('assets/uploads/file_berita/' . $lowongan['thumbnail']) ?>"></td>
                                <td><?=ucwords($lowongan['posisi_pekerjaan'])?> - <?=ucwords($lowongan['perusahaan'])?></td>
                                <td><?=$lowongan['penempatan']?></td>
                                <td><?= ucwords(word_limiter($lowongan['deskripsi'], 27))?></td>
                                <td><?= DateTime::createFromFormat('Y-m-d', $lowongan['berakhir'])->format('d/m/Y') ?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$lowongan['id_lowongan']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$lowongan['id_lowongan']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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
                     <h4 class="modal-title">Edit Lowongan Pekerjaan</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                    <form action="<?= base_url('admin/lowongan/update') ?>" method="post" role="form" enctype="multipart/form-data">
                      <input type="hidden" name="id" id="id_lowongan" value="">
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
                            <select id="penempatan" class="form-control select2bs4 penempatan"  name="penempatan" style="width: 100%;" data-placeholder="Pilih Penempatan">
                              <option></option>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('penempatan') ?></small>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="misi">Deskripsi Lowongan <span class="text-danger">*</span></label>
                        <textarea id="des" name="des" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"></textarea>
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
                                  <input type="text" name="tgl_berakhir" class="form-control float-right tgl_berakhir" placeholder="Pilih Tanggal" id="datepicker">
                              </div>
                              <!-- /.input group -->
                              <small class="text-danger mt-2"><?= form_error('tgl_berakhir') ?></small>
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

            $('#penempatan').html(html);
          }
      })
  })
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
       url: "<?= base_url('admin/lowongan/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#id_lowongan').val(data.id);     
          $('#posisi').val(data.posisi);
          $('#perusahaan').val(data.perusahaan);
          $('.tgl_berakhir').val(data.berakhir);
          $('#des').text(data.deskripsi);
          $('.img').attr('src', data.thumbnail);
          $('.penempatan').val(data.penempatan).change();    
       },
     });
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Lowongan Pekerjaan',
       text: "Apakah anda yakin ingin menghapus data lowongan ini?",
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
             url: "<?= base_url() ?>admin/lowongan/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/lowongan') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/lowongan') ?>";
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