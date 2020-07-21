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
                          <li class="breadcrumb-item active">Daftar Testimoni Alumni</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Tabel Daftar Testimoni</h3>
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
                                 <th class="text-nowrap">Testimoni</th>
                                 <th class="text-nowrap">Publish</th>
                                 <th style="width: 5%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                                 <?php
                                 $no = 1;
                                 foreach($testimonis AS $testimoni) :
                                    switch($testimoni['is_tampil']){
                                        case 'ya' :
                                            $publish = 'Tampil';
                                        break;

                                        case 'tidak' :
                                            $publish = 'Tidak Tampil';
                                        break;
                                    }
                                ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=$testimoni['nisn']?></td>
                                <td><?=ucwords($testimoni['nama'])?></td>
                                <td><?=$testimoni['nama_jurusan']?></td>
                                <td><?=$testimoni['testimoni']?></td>
                                <td><?=$publish?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$testimoni['id_testimoni']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a></td>
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/testimoni/getTestimoni') ?>",
       data: {
         'id_testimoni': dataId
       },
       dataType: "json",
       success: function(data) {
          $('#nama2').text(data.nama);     
          $('#testimoni').text(data.testimoni);
          $('#tampil').val(data.is_tampil).change();
          $('#id_testimoni').val(data.id_testimoni);    
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