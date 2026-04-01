<!DOCTYPE html>
<html lang="en">

<head>

     <!-- PAGE TITLE HERE -->
     <title><?= (!empty($title)) ? $title : 'PRASASTI'; ?></title>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="author" content="DexignZone">
     <meta name="robots" content="">

     <meta name="keywords" content="prasasti, lembaga kearsipan daerah kabupaten sumedang, LKD Kabupaten Sumedang, arsip daerah kabupaten sumedang, arsip, kearsipan, kabupaten sumedang, sumedang">
     <meta name="description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:title" content="PRASASTI | Pengelolaan dan Pencatatan Kearsipan Terintegrasi">
     <meta property="og:description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:image" content="https://sisemar.sumedangkab.go.id/assets/image/logo.gif">
     <meta name="format-detection" content="telephone=no">

     <!-- FAVICONS ICON -->
     <link rel="icon" href="<?= base_url('assets/v3/frontend/') ?>images/icon-prasasti.png" type="image/x-icon">
     <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/v3/frontend/') ?>images/icon-prasasti.png">

     <!-- MOBILE SPECIFIC -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- STYLESHEETS -->
     <link rel="stylesheet" type="text/css" href="<?= base_url('assets/v3/frontend/') ?>css/plugins.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url('assets/v3/frontend/') ?>css/style.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url('assets/v3/frontend/') ?>css/templete.css">
     <!-- <link class="skin" rel="stylesheet" type="text/css" href="<?= base_url('assets/v3/frontend/') ?>css/skin/skin-1.css"> -->
     <link class="skin" rel="stylesheet" type="text/css" href="<?= base_url('assets/v3/frontend/') ?>css/skin/skin-7.css">
</head>

<body id="bg">
     <div class="page-wraper">
          <div id="loading-area" class="loading-page-1">
               <div class="spinner">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <circle cx="8" cy="8" r="7" stroke-width="1" />
                    </svg>
               </div>
          </div>

          <?php require_once('_topbar.php'); ?>

          <!-- Content -->
          <!-- <div class="page-content bg-white"> -->
          <div class="page-content bg-white">
