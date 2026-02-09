<!DOCTYPE html>
<html lang="en">

<head>
     <!-- All Meta -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="author" content="DexignZone">
     <meta name="robots" content="">
     <meta name="keywords" content="admin dashboard, admin template, administration, analytics, bootstrap, cafe admin, elegant, food, health, kitchen, modern, responsive admin dashboard, restaurant dashboard">
     <meta name="description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
     <meta property="og:title" content="Davur : Restaurant Admin Dashboard + FrontEnd">
     <meta property="og:description" content="Discover Davur - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Davur provides advanced features and an easy-to-use interface for creating a top-quality website with frontend">
     <meta property="og:image" content="https://davur.dexignzone.com/dashboard/social-image.png">
     <meta name="format-detection" content="telephone=no">

     <!-- Mobile Specific -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Title -->
     <title><?= (!empty($title)) ? $title : 'PRASASTI'; ?></title>

     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/v3/backend/') ?>images/favicon.png">
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/chartist/css/chartist.min.css">

     <!-- Datatable -->
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

     <link rel="stylesheet" href="<?= base_url('assets/v3/backend/') ?>vendor/select2/css/select2.min.css">
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
     <link href="<?= base_url('assets/v3/backend/') ?>css/style.css" rel="stylesheet">
     <!-- <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet"> -->
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
                    <img class="logo-abbr" src="<?= base_url('assets/v3/backend/') ?>images/logo.png" alt="">
                    <img class="logo-compact" src="<?= base_url('assets/v3/backend/') ?>images/logo-text.png" alt="">
                    <img class="brand-title" src="<?= base_url('assets/v3/backend/') ?>images/logo-text.png" alt="">
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
