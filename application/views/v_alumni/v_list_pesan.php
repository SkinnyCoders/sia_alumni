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
                          <li class="breadcrumb-item active">Daftar Pesan</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Pesan</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="javascript:void(0)" data-toggle="modal" data-target="#modaladd"><i class="fa fa-envelop"></i> Buat Pesan</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Subjek</th>
                                 <th class="text-nowrap">Keterangan</th>
                                 <th class="text-nowrap">tanggal</th>
                                 <th style="width: 10%">Aksi</th>
                                 
                               </tr>
                             </thead>
                             <tbody>
                                <?php
                                $no = 1;
                                foreach($pesan AS $p) :
                                  $id_pesan = $p['id_pesan'];
                                  $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $p['tanggal'])->format('d F Y H:s');
                                  switch($p['status']){
                                    case 'menunggu' :
                                      $status = '<a href="javascript:void(0)" id="1" class="btn btn-sm btn-warning cek_status"><i class="fa fa-clock"></i></a>';
                                    break;

                                    case 'terima' :
                                      $status = '<a href="javascript:void(0)" data-toggle="modal" id="'.$id_pesan.'" data-target="#modal-lg" class="btn btn-sm btn-success pesan"><i class="fa fa-comments"></i></a>';
                                    break;

                                    case 'tolak' :
                                      $status = '<a href="javascript:void(0)" id="2" class="btn btn-sm btn-danger mr-3 cek_status"><i class="fa fa-times"></i></a>';
                                    break;
                                  }
                                ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=ucwords($p['subjek'])?></td>
                                <td><?=$p['keterangan']?></td>
                                <td><?=$tgl?></td>
                                <td><a href="javascript:void(0)" id="<?=$id_pesan?>" class="btn btn-sm btn-danger mr-3 delete"><i class="fa fa-trash"></i></a> <?=$status?></td>
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

              <div class="modal fade" id="modal-lg">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title"><i class="fa fa-comments"></i> Obrolan Pesan<span id="nama2"></span></h4><br>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                         <div class="row">
                            <div class="col-md-12">
                            <div class="card card-success cardutline direct-chat direct-chat-success">
                            <!-- /.card-header -->
                            <div class="card-body" id="body_pesan">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" id="display_obrolan" onload="scrollToBottom()">
                                    <!-- Message. Default to the left -->

                                    <!-- /.direct-chat-msg -->
                                    <h5 class="text-center text-muted">Belum memulai pesan</h5>
                                    <!-- Message to the right -->
                               
                                    <!-- /.direct-chat-msg -->
                                </div>
                                <!--/.direct-chat-messages-->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form id="form_obrolan">
                                <div class="input-group">
                                    <input type="hidden" id="id_pesan" name="id_pesan" value=""> 
                                    <input type="text" name="message" placeholder="Tulis Pesan ..." class="form-control">
                                    <span class="input-group-append">
                                    <button type="button" onclick="kirimObrolan()" class="btn btn-success">Kirim</button>
                                    </span>
                                </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                            </div>
                            <!--/.direct-chat -->
                            </div>
                         </div>
                    </div>
                    <!-- /.card-body -->
                 </div>
                 <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->

              <div class="modal fade" id="modaladd">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Pesan Baru <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('alumni/pesan/tambah') ?>" method="post" role="form">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="subjek">Subjek</label>
                            <input type="text" class="form-control" name="subjek" id="subjek" placeholder="Masukkan Subjek Pesan" value="<?php echo set_value('kelas'); ?>">
                            <small class="text-danger mt-2"><?= form_error('subjek') ?></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan" value="<?php echo set_value('kelas'); ?>">
                            <small class="text-danger mt-2"><?= form_error('keterangan') ?></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                   <div class="modal-footer justify-content-between">
                     <button type="submit" name="simpan" class="btn btn-primary">Buat Pesan</button>
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

   $('.cek_status').click(function(){
     var id = this.id;
     $.ajax({
       url : "<?=base_url('alumni/pesan/error/')?>"+id,
       success: function(respone) {
        window.location.href = "<?= base_url('alumni/pesan') ?>";
      },
      error: function(request, error) {
        window.location.href = "<?= base_url('alumni/pesan') ?>";
      }
     })
   });

   //get obrolan
   $('.pesan').click(function(){
     var id = this.id;
     $('#id_pesan').val(id);
     load_obrolan(id);
     setInterval('load_obrolan('+id+')', 500);
   })

   function kirimObrolan(){
     var id = $('#id_pesan').val();
      $.ajax({
          url : "<?=base_url('alumni/pesan/obrolan_send/')?>"+id,
          data : $("#form_obrolan").serialize(),
          type : "POST",
          success : function (response) {
            $('#form_obrolan')[0].reset();
            load_obrolan(id);
          }
      })
   }

   function load_obrolan(id){
      $.ajax({
        url:"<?=base_url('alumni/pesan/obrolan_get/')?>"+id,
        method:"POST",
        dataType : "json",
				success:function(data){
          // console.log(html);
          $('#display_obrolan').html(data);
				}, error: function(data) {
          console.log(data.responseText)
        }
      })
   }

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Kelas',
       text: "Apakah anda yakin ingin menghapus data Kelas ini?",
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
             url: "<?= base_url() ?>alumni/pesan/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('alumni/pesan') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('alumni/pesan') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>