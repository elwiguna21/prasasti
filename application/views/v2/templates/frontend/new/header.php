<!DOCTYPE html>
<html lang="en">

<head>
     <!-- PAGE TITLE HERE -->
     <title><?= (!empty($title)) ? $title : 'PRASASTI'; ?></title>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="author" content="PRASASTI">
     <meta name="robots" content="">

     <meta name="keywords" content="prasasti, lembaga kearsipan daerah kabupaten sumedang, LKD Kabupaten Sumedang, arsip daerah kabupaten sumedang, arsip, kearsipan, kabupaten sumedang, sumedang">
     <meta name="description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:title" content="PRASASTI | Pengelolaan dan Pencatatan Kearsipan Terintegrasi">
     <meta property="og:description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:image" content="<?= base_url('assets/v3/frontend/v2/img/icon-prasasti.png') ?>">
     <meta name="format-detection" content="telephone=no">

     <!-- FAVICONS ICON -->
     <link rel="icon" href="<?= base_url('assets/v3/frontend/') ?>v2/img/icon-prasasti.png" type="image/x-icon">
     <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/v3/frontend/') ?>v2/img/icon-prasasti.png">

     <!-- MOBILE SPECIFIC -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Stylesheet -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
     <link rel="stylesheet" href="<?= base_url('assets/v3/frontend/v2/') ?>css/animate.css">
     <link rel="stylesheet" href="<?= base_url('assets/v3/frontend/v2/') ?>css/tabler-icons.min.css">
     <link rel="stylesheet" href="<?= base_url('assets/v3/frontend/v2/') ?>css/bootstrap.min.css">
     <link rel="stylesheet" href="<?= base_url('assets/v3/frontend/v2/') ?>css/swiper-bundle.min.css">
     <link rel="stylesheet" href="<?= base_url('assets/v3/frontend/v2/') ?>style.css">

     <style>
          .text-justify {
               text-align: justify !important;
          }

          .text-blue {
               color: #2B4DFF !important;
          }

          .btn-sm {
               min-width: 30px;
          }
     </style>
</head>

<body class="theme-two">
     <!-- Preloader -->
     <div class="preloader" id="preloader">
          <div class="spinner-grow" role="status">
               <span class="visually-hidden">Loading...</span>
          </div>
     </div>

     <!-- Double Quote Icon [SVG] -->
     <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
          <symbol id="double-quote-icon" viewBox="0 0 62 62" fill="none">
               <path
                    d="M14.5312 9.41406C6.51702 9.41406 0 15.9329 0 23.9453C0 31.2606 5.43154 37.3306 12.4771 38.3311C11.9131 42.4287 10.3486 46.3275 7.90415 49.7085C7.42874 50.3683 7.44654 51.2624 7.9538 51.9009C8.4515 52.5292 9.31635 52.7674 10.0754 52.4473C21.6088 47.6332 29.0625 36.4438 29.0625 23.9453C29.0625 15.9329 22.5455 9.41406 14.5312 9.41406ZM47.4688 9.41406C39.4545 9.41406 32.9375 15.9329 32.9375 23.9453C32.9375 31.2606 38.369 37.3306 45.4146 38.3311C44.8506 42.4287 43.2861 46.3275 40.8417 49.7085C40.3662 50.3683 40.384 51.2624 40.8913 51.9009C41.389 52.5292 42.2538 52.7674 43.0129 52.4473C54.5463 47.6332 62 36.4438 62 23.9453C62 15.9329 55.483 9.41406 47.4688 9.41406Z"
                    fill="url(#gradient1)" />
               <defs>
                    <linearGradient id="gradient1" x1="3.5" y1="19" x2="62" y2="31" gradientUnits="userSpaceOnUse">
                         <stop offset="0" stop-color="#601FEB" />
                         <stop offset="1" stop-color="#C700B1" />
                    </linearGradient>
               </defs>
          </symbol>
     </svg>

     <svg class="d-none" xmlns="http://www.w3.org/2000/svg">
          <symbol id="check-icon" viewBox="0 0 28 28" fill="none">
               <g clip-path="url(#clip0)">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M8.81362 13.0307C8.34112 12.7152 7.70994 12.7869 7.31911 13.1999C6.92886 13.6123 6.89211 14.247 7.23336 14.7014L10.7334 19.3681C10.9445 19.6493 11.2712 19.8207 11.6229 19.8342C11.9741 19.847 12.313 19.7012 12.5446 19.4363L20.7113 10.103C21.1144 9.64274 21.0928 8.94916 20.6623 8.51399C20.2318 8.07882 19.5388 8.05082 19.0739 8.44866L11.5786 14.8735L8.81362 13.0307Z"
                         fill="white" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M13.9327 0.519531C6.52939 0.519531 0.519531 6.52939 0.519531 13.9327C0.519531 21.336 6.52939 27.3458 13.9327 27.3458C21.336 27.3458 27.3458 21.336 27.3458 13.9327C27.3458 6.52939 21.336 0.519531 13.9327 0.519531ZM13.9327 1.68557C20.6921 1.68557 26.1798 7.17329 26.1798 13.9327C26.1798 20.6921 20.6921 26.1798 13.9327 26.1798C7.17329 26.1798 1.68557 20.6921 1.68557 13.9327C1.68557 7.17329 7.17329 1.68557 13.9327 1.68557Z"
                         fill="#601FEB" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                         d="M9.13872 12.5428C8.42939 12.0697 7.48265 12.177 6.89698 12.796C6.31073 13.4155 6.25648 14.3669 6.76806 15.0488L10.2681 19.7155C10.5848 20.1378 11.0748 20.3945 11.6021 20.4143C12.1295 20.4341 12.6376 20.2148 12.9852 19.8181L21.1519 10.4848C21.7562 9.79355 21.7241 8.75347 21.0784 8.1013C20.4326 7.44855 19.3926 7.40595 18.6961 8.00329L11.5356 14.1406L9.13872 12.5428ZM8.4918 13.5135L11.2562 15.3568C11.4738 15.5015 11.7608 15.484 11.9597 15.3142L19.455 8.88938C19.6871 8.68988 20.0342 8.70446 20.2495 8.92204C20.4647 9.13904 20.4752 9.48613 20.274 9.71654L12.1073 19.0499C11.9912 19.1817 11.8221 19.2552 11.6459 19.2482C11.4703 19.2418 11.307 19.156 11.2014 19.0155L7.7014 14.3488C7.53106 14.1213 7.54913 13.8045 7.74455 13.598C7.93938 13.3915 8.25497 13.356 8.4918 13.5135Z"
                         fill="#601FEB" />
               </g>
               <defs>
                    <clipPath id="clip0">
                         <rect width="28" height="28" fill="white" />
                    </clipPath>
               </defs>
          </symbol>
     </svg>

     <?php require_once('_top_bar.php'); ?>
