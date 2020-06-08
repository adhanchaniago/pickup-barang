<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-4.5.0/css/bootstrap.min.css'); ?>">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables-1.10.21/css/dataTables.bootstrap4.min.css'); ?>">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fancybox-3.5.7/jquery.fancybox.min.css'); ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free-5.13.0/css/all.min.css'); ?>">
    <!-- Adminlte CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/adminlte-3.0.5/adminlte.min.css'); ?>">
    <!-- overlayScrollbars CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/overlayScrollbars-1.11.0/css/OverlayScrollbars.min.css'); ?>">
    
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">  

    <!-- Icon -->
    <link rel="icon" href="<?= base_url('assets/img/img_properties/icon.png'); ?>">
    
    <title><?= $title; ?></title>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          </ul>

          <!-- SEARCH FORM -->
          <!-- <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('admin/profile'); ?>" class="dropdown-item">
                  <i class="far fa-fw fa-user"></i> Profil
                </a>
                <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
                  <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="<?= base_url('admin'); ?>" class="brand-link">
            <img src="<?= base_url('assets/img/img_properties/icon.png'); ?>" alt="Logo" class="brand-image">
            <span class="brand-text font-weight-light">Pickup</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="<?= base_url('assets/img/img_profiles/') . $dataUser['img_profile']; ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="<?= base_url('admin/profile'); ?>" class="d-block"><?= $dataUser['username']; ?></a>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                  <a href="<?= base_url('admin'); ?>" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dasbor
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('pickupBarang'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-shipping-fast"></i>
                    <p>
                      Pickup Barang
                      <span class="right badge badge-danger">New</span>
                    </p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      Master Data
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('jabatan'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jabatan</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url('user'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengguna</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url('layananPaket'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Layanan Paket</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>