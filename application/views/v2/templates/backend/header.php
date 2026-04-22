<!DOCTYPE html>
<html lang="en">

<head>
     <!-- All Meta -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="author" content="PRASASTI">
     <meta name="robots" content="">
     <meta name="keywords" content="prasasti, lembaga kearsipan daerah kabupaten sumedang, LKD Kabupaten Sumedang, arsip daerah kabupaten sumedang, arsip, kearsipan, kabupaten sumedang, sumedang">
     <meta name="description" content="PRASASTI : Penerapan Sistem Arsip Statis Terintegrasi dalam Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:title" content="PRASASTI | Penerapan Sistem Arsip Statis Terintegrasi">
     <meta property="og:description" content="PRASASTI : Penerapan Sistem Arsip Statis Terintegrasi dalam Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:image" content="<?= base_url('assets/v3/frontend/images/icon-prasasti.png') ?>">
     <meta name="format-detection" content="telephone=no">

     <!-- Mobile Specific -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Title -->
     <title><?= (!empty($title)) ? $title : 'PRASASTI'; ?></title>

     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/v3/backend/') ?>images/icon-prasasti.png">

     <!-- Datatable -->
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

     <link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/select2/css/select2.min.css">
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
     <!-- SweetAlert2 -->
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
     <link href="<?= base_url('assets/v3/backend/') ?>css/style.css" rel="stylesheet">
     <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

     <!-- jQuery (must load before content scripts) -->
     <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
</head>

<body>

     <!--*******************
        Preloader start
    ********************-->
     <div id="preloader">
          <div class="sk-three-bounce">
               <div class="sk-child sk-bounce1"></div>
               <div class="sk-child sk-bounce2"></div>
               <div class="sk-child sk-bounce3"></div>
          </div>
     </div>
     <!--*******************
        Preloader end
    ********************-->

     <!--**********************************
        Main wrapper start
    ***********************************-->
     <div id="main-wrapper">

          <!--**********************************
            Nav header start
        ***********************************-->
          <div class="nav-header">
               <a href="<?= base_url('v2/backend/dashboards') ?>" class="brand-logo">
                    <img class="logo-abbr" src="<?= base_url('assets/v3/backend/') ?>images/logo-prasasti.png" alt="">
                    <img class="logo-compact" src="<?= base_url('assets/v3/backend/') ?>images/logo-text-prasasti.png" alt="">
                    <img class="brand-title" src="<?= base_url('assets/v3/backend/') ?>images/logo-text-prasasti.png" alt="">
               </a>

               <div class="nav-control">
                    <div class="hamburger">
                         <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
               </div>
          </div>
          <!--**********************************
            Nav header end
        ***********************************-->

          <?php require_once('_topbar.php'); ?>

          <?php require_once('_sidebar.php') ?>

          <!--**********************************
            Content body start
        ***********************************-->
          <div class="content-body">
               <!-- row -->
               <div class="container-fluid">
