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
             <li class="breadcrumb-item active">Status Alumni</li>
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

         <div class="col-md-12">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Perbarui Status</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="" method="post">
               <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control select2bs4" data-placeholder="Pilih Status">
                        <option></option>
                        <option value="bekerja" <?php if(!empty($status) && $status['status'] == 'bekerja' ){ echo 'selected'; }?>>Bekerja</option>
                        <option value="kuliah" <?php if(!empty($status) && $status['status'] == 'kuliah' ){ echo 'selected'; }?>>Kuliah</option>
                        <option value="tidak" <?php if(!empty($status) && $status['status'] == 'tidak' ){ echo 'selected'; }?>>Belum / Tidak bekerja</option>
                        <option value="bekerja kuliah" <?php if(!empty($status) && $status['status'] == 'bekerja kuliah' ){ echo 'selected'; }?>>Bekerja sambil kuliah</option>
                    </select>
                    <small class="text-danger mt-2"><?= form_error('status') ?></small>
                </div>
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <label for="deskripsi">Deskripsi Status</label>
                       <textarea id="deskripsi" name="deskripsi" class="form-control" style="height: 150px;" placeholder="Masukkan status anda yang sekarang. Misalkan jika anda bekerja, sebutkan dimana lokasi anda bekerja, posisi apa, dan berapa lama anda bekerja. Deskripsikan segala sesuatu yang anda anggap penting kepada kami, karena hal ini dapat membantu kami untuk mentracking alumni"><?php if (!empty($status['deskripsi'])) {echo $status['deskripsi'];}?></textarea>
                        <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
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
                 <h4 class="modal-title">Edit Tahun Ajaran <span id="nama2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form action="<?= base_url('admin/sekolah/tahun_ajaran/update') ?>" method="POST">
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Tahun Awal</label>
                         <input type="number" class="form-control tgl_mulai" name="tahun1" id="nama2" placeholder="Tahun Awal" value="">

                         <input type="hidden" class="form-control id_tahun" name="id" value="" required>
                         <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Tahun Akhir</label>
                         <input type="number" class="form-control tgl_akhir" name="tahun2" id="nama2" placeholder="Tahun Akhir" value="">
                         <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                       </div>
                     </div>
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

    $('.select2bs4').select2({
        theme: 'bootstrap4'
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