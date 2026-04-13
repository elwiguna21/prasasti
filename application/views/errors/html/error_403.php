<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base_url = load_class('Config')->config['base_url'];
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
     <!-- All Meta -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="author" content="PRASASTI">
     <meta name="robots" content="">
     <meta name="keywords" content="prasasti, lembaga kearsipan daerah kabupaten sumedang, LKD Kabupaten Sumedang, arsip daerah kabupaten sumedang, arsip, kearsipan, kabupaten sumedang, sumedang">
     <meta name="description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:title" content="PRASASTI | Pengelolaan dan Pencatatan Kearsipan Terintegrasi">
     <meta property="og:description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:image" content="<?= $base_url . 'assets/v3/frontend/images/icon-prasasti.png' ?>">
     <meta name="format-detection" content="telephone=no">

     <!-- Mobile Specific -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Title -->
     <title>ERROR 403 - PRASASTI</title>

     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= $base_url . 'assets/v3/backend/' ?>images/icon-prasasti.png">
     <link href="<?= $base_url . 'assets/v3/backend/' ?>css/style.css" rel="stylesheet">

</head>

<body class="h-100">
     <div class="authincation h-100" style="background-image: url(<?= $base_url ?>assets/v3/backend/images/student-bg.jpg); background-repeat:no-repeat; background-size:cover;">
          <div class="container h-100">
               <div class="row h-100 align-items-center">
                    <div class="col-lg-6 col-sm-12">
                         <div class="form-input-content  error-page">
                              <h1 class="error-text text-primary">403</h1>
                              <h4> Forbidden Error!</h4>
                              <?php if (!empty($message)) { ?>
                                   <p><?php echo $message; ?></p>
                              <?php } else { ?>
                                   <p>You do not have permission to view this resource.</p>
                              <?php } ?>
                              <a class="btn btn-primary" href="<?= $base_url . 'v2/authentications' ?>">Back to Authentications</a>
                         </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                         <img class="w-100 move-2" src="<?= $base_url . 'assets/v3/backend/' ?>images/svg/student.svg" alt="">
                    </div>
               </div>
          </div>
     </div>

     <!--**********************************
	Scripts
***********************************-->
     <!-- Required vendors -->
     <script src="<?= $base_url . 'assets/v3/backend/' ?>vendor/global/global.min.js"></script>
     <script src="<?= $base_url . 'assets/v3/backend/' ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
     <script src="<?= $base_url . 'assets/v3/backend/' ?>js/custom.min.js"></script>
     <script src="<?= $base_url . 'assets/v3/backend/' ?>js/deznav-init.js"></script>

</body>

</html>
