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
             <li class="breadcrumb-item active">Kritik & Saran</li>
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
               <h3 class="card-title">Tambah Kritik & Saran</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="" method="post">
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Kritik</label>
                       <textarea id="misi" name="kritik" class="form-control" style="height: 150px;" placeholder="Silahkan Tuliskan Kritik anda"><?php echo !empty($kritiksaran)?$kritiksaran['kritik']:'' ?></textarea>
                        <small class="text-danger mt-2"><?= form_error('kritik') ?></small>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Saran</label>
                       <textarea id="misi" name="saran" class="form-control" style="height: 150px;" placeholder="Silahkan Tuliskan Saran anda"><?php echo !empty($kritiksaran)?$kritiksaran['saran']:'' ?></textarea>
                        <small class="text-danger mt-2"><?= form_error('saran') ?></small>
                     </div>
                   </div>
                 </div>
             </div>
             <div class="card-footer">
               <button type="submit" class="btn btn-primary float-right">Simpan Kritik & Saran</button>
             </div>
             </form>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>
     </div>
   </section>
 </div>
 <!-- /.content-wrapper -->

 <?php $this->load->view('templates/cdn_admin'); ?>

 <script>

   var loadFile = function(event) {
     var output = document.getElementById('output');
     output.src = URL.createObjectURL(event.target.files[0]);
   };
 </script>