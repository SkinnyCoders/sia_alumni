<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <h3 class="text-header text-info text-bold my-auto ml-2">SMK PANCASILA 7 PRACIMANTORO</h3>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
    <?php if ($this->session->userdata('role') == 4) { ?>
        <a href="<?= base_url('auth/logout_peserta') ?>" class="nav-link"><i class="fas fa-arrow-circle-right nav-icon"></i> Logout</a>
    <?php }else{ ?>
      <a href="<?= base_url('front/auth/logout') ?>" class="nav-link"><i class="fas fa-arrow-circle-right nav-icon"></i> Logout</a>
    <?php } ?>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link mx-auto">
    <span style="margin-left: 30%;" class="brand-text font-weight-light font-weight-bolder text-nowrap" id="clock"></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if (!empty($this->session->userdata('foto'))) { ?>
          <img src="<?= base_url('assets/img/user/' . $this->session->userdata('foto')) ?>" class="img-circle elevation-2 mt-2" alt="User Image">
        <?php }else{ ?>
          <img src="<?= base_url('assets/img/user/default.png') ?>" class="img-circle elevation-2 mt-2" alt="User Image">
        <?php } ?>
      </div>
      <div class="info">
        <h5 class="text-nowrap d-block text-header text-white"><?= ucwords($this->session->userdata('nama')) ?></h5>
        <span><small class="d-block text-muted"><?= ucwords($this->session->userdata('nama_role')) ?></small></span>


      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--           <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li> -->
        <?php if ($this->session->userdata('role') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= active('dashboard')?>">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/alumni') ?>" class="nav-link <?= active('alumni')?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Daftar Alumni
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/lowongan') ?>" class="nav-link <?= active('lowongan')?>">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Lowongan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/event') ?>" class="nav-link <?= active('event')?>">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Event
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/testimoni') ?>" class="nav-link <?= active('testimoni')?>">
              <i class="nav-icon fa fa-trophy"></i>
              <p>
                Testimoni
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/kritik_saran') ?>" class="nav-link <?= active('kritik_saran')?>">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                Kritik & Saran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/komentar') ?>" class="nav-link <?= active('komentar')?>">
              <i class="nav-icon fa fa-comment"></i>
              <p>
                Komentar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/jurusan') ?>" class="nav-link <?= active('jurusan')?>">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Data Jurusan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/kelas') ?>" class="nav-link <?= active('kelas')?>">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Data Kelas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/pengguna') ?>" class="nav-link <?= active('pengguna')?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/pesan') ?>" class="nav-link <?= active('pesan')?>">
              <i class="nav-icon fa fa-envelope"></i>
              <p>
                Pesan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting Akun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?=base_url('admin/setting/profil')?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?=base_url('admin/setting/password')?>" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('front/auth/logout') ?>" class="nav-link">
                  <i class="fas fa-arrow-circle-right nav-icon"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="<?= base_url('alumni/dashboard') ?>" class="nav-link <?= active('dashboard')?>">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Alumni
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('alumni/data_diri') ?>" class="nav-link <?= active('data_diri')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Diri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('alumni/status') ?>" class="nav-link <?= active('status')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Status Alumni</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('alumni/semua') ?>" class="nav-link <?= active('semua')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Alumni</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('alumni/lowongan') ?>" class="nav-link <?= active('lowongan')?>">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Lowongan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('alumni/event') ?>" class="nav-link <?= active('event')?>">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Event
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('alumni/testimoni') ?>" class="nav-link <?= active('testimoni')?>">
              <i class="nav-icon fa fa-trophy"></i>
              <p>
                Testimoni
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('alumni/kritik_saran') ?>" class="nav-link <?= active('kritik_saran')?>">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                Kritik & Saran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('alumni/pesan') ?>" class="nav-link <?= active('pesan')?>">
              <i class="nav-icon fa fa-envelope"></i>
              <p>
                Pesan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting Akun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?=base_url('alumni/setting/profil')?>" class="nav-link <?= active('setting')?>">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?=base_url('alumni/setting/password')?>" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('front/auth/logout') ?>" class="nav-link">
                  <i class="fas fa-arrow-circle-right nav-icon"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>