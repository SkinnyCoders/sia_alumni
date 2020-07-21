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
             <li class="breadcrumb-item active">Event</li>
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
             <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                  <div class="row">
                      <div class="col-sm-8">
                        <span class="info-box-text">Berikut daftar Event bulan ini</span>
                        <span class="info-box-number"><?=count($lowongans)?> Event</span>
                      </div>
                      <div class="col-sm-4">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success float-right"> <i class="fa fa-plus"></i> Tambah Event</a>
                      </div>
                  </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
             </div>
         </div>
       <div class="row">
       <?php foreach($lowongans as $l) : ?>

          <div class="col-md-3">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget" style="padding: 2px;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="card-body" style="padding: 2px;">
              <img style="width: 100%; height: 200px; border-top-left-radius:3px; border-top-right-radius:3px;" src="<?=base_url()?>assets/uploads/file_berita/<?=$l['gambar_event']?>" alt="">
                <!-- <h3 class="widget-user-username">Alexander Pierce</h3>
                <h5 class="widget-user-desc">Founder & CEO</h5> -->
                <div class="row">
                  <div class="col-sm-12" >
                    <div class="description" style="padding: 7px;">
                      <h5 class="text-header mt-2 text-bold"><?=ucwords($l['judul_event'])?></h5>
                      <h6 class="text-dark mt-2 "><?=ucwords($l['lokasi_event'])?> <br><span class="text-muted">Tanggal & Waktu : <?=DateTime::createFromFormat('Y-m-d', $l['tanggal_event'])->format('d F Y')?> - <?=$l['waktu_event']?> WIB</span></h6>
                      <!-- <span class="description-text mb-2">SALES</span> -->
                      <a href="<?=base_url('alumni/event/detail/'.$l['slug'])?>" class="btn btn-primary btn-block mt-3">Lihat Detail</a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <?php endforeach ?>
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