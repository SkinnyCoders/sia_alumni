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
             <li class="breadcrumb-item active">Jurusan</li>
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
         <div class="col-md-6">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tabel data jurusan</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-striped">
                 <thead>
                   <tr>
                     <th class="text-nowrap" style="width: 5%">No</th>
                     <th class="text-nowrap">Jurusan</th>
                     <th style="width: 25%">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    if (!empty($jurusan)) {
                      $no = 1;
                      foreach ($jurusan as $j) {
                        ?>
                       <tr>
                         <td><?= $no++ ?></td>
                         <td><?php echo ucwords($j['nama_jurusan']);?></td>
                         <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $j['id_jurusan'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $j['id_jurusan'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                       </tr>
                   <?php
                      }
                    }
                    ?>
                 </tbody>
               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="col-md-6">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tambah Jurusan</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="" method="post">
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <label for="jurusan">Nama Jurusan</label>
                       <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Masukkan Nama Jurusan" value="<?= set_value('jurusan') ?>">
                       <small class="text-danger mt-2"><?= form_error('jurusan') ?></small>
                     </div>
                   </div>
                 </div>
             </div>
             <div class="card-footer">
               <button type="submit" class="btn btn-primary float-right">Simpan</button>
             </div>
             </form>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="modal fade" id="modal-lg">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">Edit Jurusan <span id="nama_jurusan2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form action="<?= base_url('admin/jurusan/update') ?>" method="POST">
                   <div class="form-group">
                     <label for="jurusan">Nama Jurusan</label>
                     <input type="text" class="form-control" name="jurusan_update" id="jurusan_update" placeholder="Masukkan Nama Jurusan" value="">
                     <small class="text-danger mt-2"><?= form_error('jurusan_update') ?></small>
                   </div>
                   <div class="form-group">
                     <input type="hidden" class="form-control" name="id_jurusan" id="id_jurusan" value="">
                   </div>
               </div>
               <div class="modal-footer justify-content-between">
                 <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                 </form>
               </div>
             </div>
             <!-- /.modal-content -->
           </div>
           <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
       </div>
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

   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/jurusan/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
        $('#id_jurusan').val(data.id_jurusan);
        $('#jurusan_update').val(data.nama_jurusan);
        $('#nama_jurusan2').text(data.nama_jurusan);
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Jurusan',
       text: "Apakah anda yakin ingin menghapus data jurusan ini?",
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
             url: "<?= base_url() ?>admin/jurusan/delete/" + dataId,
             data: {
               'id_jurusan': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/jurusan') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/jurusan') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>