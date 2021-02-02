<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SISEMAR</title>
  <link rel="shortcut icon" href="<?= base_url()?>assets/image/logo.gif" type="image/png" sizes="16x16">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('index.php/Dashboard');?>">
       <div class="sidebar-brand-icon rotate-n-15">
       <!--   <img src='../img/logo.jpeg' height='50'>-->
        </div>
        <div class="sidebar-brand-text mx-3">SISEMAR</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('Panel');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Data Arsip
      </div>

      <!-- Nav Item - Pages Collapse Menu -->


      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Panel/arsip');?>">
        <i class="fas fa-clipboard-list"></i>
          <span>Data Arsip</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Datamasterweb/updatedata');?>">
        <i class="fas fa-clipboard-list"></i>
          <span>Data Arsip (Percobaan)</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Panel/dataskpd');?>">
        <i class="fas fa-clipboard-list"></i>
          <span>Data SKPD</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Dinas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Peserta:</h6>
           
            <a class="collapse-item" href="<?php echo base_url('Panel/artikel');?>">Artikel</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/berita');?>">Berita</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/banner');?>">Banner</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/faq');?>">FAQ</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/galeri');?>">Galeri</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/link');?>">Link</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/peraturan');?>">Peraturan</a>
            <a class="collapse-item" href="javascript:void(0)" title="Edit Porfil" onclick="edit_profil('1')">Profil</a>
            
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Arsip E-office</span>
        </a>
        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Arsip:</h6>
           
            <a class="collapse-item" href="<?php echo base_url('Panel/skpd_masuk');?>">Surat Masuk</a>
            <a class="collapse-item" href="<?php echo base_url('Panel/skpd_keluar');?>">Surat Keluar</a>
            
          </div>
        </div>
      </li>



      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Admin/logout');?>">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white-400"></i>
          <span>Logout</span></a>
      </li>

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

           

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hai  <?php echo $this->session->userdata("nama");?></span>
                <img class="img-profile rounded-circle" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>


      <!-- Footer -->
      