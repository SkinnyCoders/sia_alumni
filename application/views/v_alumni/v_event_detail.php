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
             <li class="breadcrumb-item"><a href="<?= base_url('alumni/event') ?>">Event</a></li>
             <li class="breadcrumb-item active">Detail Event</li>
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
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
            <!-- <div class="col-12">
                <h4>
                <i class="fas fa-globe"></i> AdminLTE, Inc.
                <small class="float-right">Date: 2/10/2014</small>
                </h4>
            </div> -->
            <!-- /.col -->

            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <img src="<?=base_url()?>assets/uploads/file_berita/<?=$event['gambar_event']?>" style="width:100%; height:250px;"  alt="">
                    <small class="mt-5 text-muted">di posting oleh <?=$event['author']?> - tanggal <?=DateTime::createFromFormat('Y-m-d H:i:s', $event['create_at'])->format('d F Y')?></small>
                </div>
            <!-- /.col -->
                <div class="col-sm-4 invoice-col ml-2">
                    <h3><strong><?=ucwords($event['judul_event'])?></strong></h3>
                    <span class="text-muted"><strong>Lokasi :</strong> <?=ucwords($event['lokasi_event'])?></span><br>
                    <span class="text-muted"> <strong>Tanggal :</strong> <?php echo DateTime::createFromFormat('Y-m-d', $event['tanggal_event'])->format('d F Y')?></span><br>
                    <span class="text-muted"> <strong>Waktu :</strong> <?php echo DateTime::createFromFormat('H:i', $event['waktu_event'])->format('H:i')?> WIB</span><br>
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row mt-3">
            <!-- accepted payments column -->
            <div class="col-8">
                <p class="lead">Deskripsi Acara</p>

                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                <?php echo $event['deskripsi_event'] ?>
                </p>
            </div>
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <!-- <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-default" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generate PDF
                </button>
            </div>
            </div> -->
        </div>
        <!-- /.invoice -->
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