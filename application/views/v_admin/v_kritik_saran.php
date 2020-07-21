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
                          <li class="breadcrumb-item active">Daftar Kritik & Saran Alumni</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Kritik & Saran</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">NISN</th>
                                 <th class="text-nowrap">Nama</th>
                                 <th class="text-nowrap">Jurusan</th>
                                 <th class="text-nowrap">Kritik & Saran</th>
                                 <th class="text-nowrap">tanggal</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $no = 1;
                                 foreach($kritiks AS $k) :
                                ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=$k['nisn']?></td>
                                <td><?=ucwords($k['nama'])?></td>
                                <td><?=ucwords($k['nama_jurusan'])?></td>
                                <td><?=word_limiter($k['kritik'], 5)?> & <?=word_limiter($k['saran'], 4)?></td>
                                <td><?= DateTime::createFromFormat('Y-m-d H:i:s', $k['create_at'])->format('d F Y')?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$k['id_kritik_saran']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-eye"></i></a></td>
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
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Krikit & Saran <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                    
                        <input type="hidden" name="id" id="id_testimoni" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Kritik</label>
                                <p class="text-muted" id="kritik">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi alias minus excepturi recusandae expedita nobis nisi sit quae, accusantium aspernatur aperiam distinctio ipsum consequatur, provident atque reiciendis, illum voluptatum assumenda.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Saran</label>
                                <p class="text-muted" id="saran">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi alias minus excepturi recusandae expedita nobis nisi sit quae, accusantium aspernatur aperiam distinctio ipsum consequatur, provident atque reiciendis, illum voluptatum assumenda.</p>
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
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
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
       url: "<?= base_url('admin/kritik_saran/getKritik') ?>",
       data: {
         'id': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#nama2').text(data.nama);     
          $('#kritik').text(data.kritik);
          $('#saran').text(data.saran);  
       },
     });
   });

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
             url: "<?= base_url() ?>admin/kelas/delete/" + dataId,
             data: {
               'id_kelas': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/kelas') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/kelas') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>