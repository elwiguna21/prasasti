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
     <title>Davur : Restaurant Admin Dashboard + FrontEnd</title>

     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= $base_url . 'assets/v3/backend/' ?>images/favicon.png">
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
