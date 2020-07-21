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
                          <li class="breadcrumb-item active">Daftar Komentar</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Komentar</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Nama</th>
                                 <th class="text-nowrap">Komentar</th>
                                 <th class="text-nowrap">Pada Postingan</th>
                                 <th class="text-nowrap">Tanggal</th>
                                 <th style="width: 5%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $no = 1;
                                 foreach($komentar AS $k) :
                                    //get author
                                    switch($k['komentar_oleh']){
                                        case 'admin':
                                            $getAuthor = $this->db->get_where('admin', ['username' => $k['author']])->row_array();
                                        break;

                                        case 'alumni':
                                            $getAuthor = $this->db->get_where('alumni', ['nisn' => $k['author']])->row_array();
                                        break;
                                    }

                                    //get postingan
                                    switch($k['kategori']){
                                        case 'lowongan':
                                            $getPost = $this->db->get_where('lowongan', ['id_lowongan' => $k['id_berita']])->row_array();
                                            $postKategori = 'Lowongan Kerja';
                                            $postJudul = $getPost['posisi_pekerjaan'].' '.$getPost['perusahaan'];
                                            $link = base_url('lowongan/detail/'.$getPost['slug']);
                                        break;

                                        case 'event':
                                            $getPost = $this->db->get_where('event', ['id_event' => $k['id_berita']])->row_array();
                                            $postKategori = 'Event';
                                            $postJudul = $getPost['judul_event'];
                                            $link = base_url('event/detail/'.$getPost['slug']);
                                        break;
                                    }
                                ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=$getAuthor['nama']?></td>
                                <td><?=ucwords($k['komentar'])?></td>
                                <td><?=$postKategori?> - <a href="<?=$link?>" target="_blank"><?=$postJudul?></a></td>
                                <td><?=DateTime::createFromFormat('Y-m-d H:i:s', $k['tanggal'])->format('d F Y')?></td>
                                <td><a href="javascript:void(0)" id="<?=$k['id_komentar']?>"  class="btn btn-sm btn-danger mr-3 delete"><i class="fa fa-trash"></i></a></td>
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
                     <h4 class="modal-title">Testimoni <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('admin/testimoni/update') ?>" method="post" role="form">
                        <input type="hidden" name="id" id="id_testimoni" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Testimoni</label>
                                <p class="text-muted" id="testimoni">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi alias minus excepturi recusandae expedita nobis nisi sit quae, accusantium aspernatur aperiam distinctio ipsum consequatur, provident atque reiciendis, illum voluptatum assumenda.</p>
                            </div>
                        </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="tahun">Publikasi</label>
                            <select id="tampil" class="form-control select2bs4" name="publish" style="width: 100%;" data-placeholder="Pilih Status">
                              <option></option>
                              <option value="ya">Iya</option>
                              <option value="tidak">Tidak</option>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('tahun_ajaran') ?></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
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


   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Komentar',
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
             url: "<?= base_url() ?>admin/komentar/delete/" + dataId,
             data: {
               'id': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/komentar') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/komentar') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>