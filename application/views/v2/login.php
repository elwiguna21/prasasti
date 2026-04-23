<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="keywords" content="" />
     <meta name="author" content="" />
     <meta name="robots" content="" />
     <meta name="keywords" content="prasasti, lembaga kearsipan daerah kabupaten sumedang, LKD Kabupaten Sumedang, arsip daerah kabupaten sumedang, arsip, kearsipan, kabupaten sumedang, sumedang">
     <meta name="description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:title" content="PRASASTI | Pengelolaan dan Pencatatan Kearsipan Terintegrasi">
     <meta property="og:description" content="PRASASTI : Sistem pengelolaan dan pencatatan Kearsipan Daerah Kabupaten Sumedang oleh Dinas Arsip dan Perpustakaan Kabupaten Sumedang.">
     <meta property="og:image" content="<?= base_url('assets/v3/frontend/images/icon-prasasti.png') ?>">
     <meta name="format-detection" content="telephone=no">
     <title>Autentikasi - PRASASTI </title>
     <!-- Favicon icon -->
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/v3/backend/') ?>images/icon-prasasti.png">
     <link href="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
     <link href="<?= base_url('assets/v3/backend/') ?>css/style.css" rel="stylesheet">

     <style>
         .auth-form .btn {
              height: auto;
             font-weight: 700;
         }
     </style>
</head>

<body class="h-100">
     <div class="authincation h-100">
          <div class="container h-100">
               <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-12">
                         <div class="row align-items-center ">
                              <div class="card login-card">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-xl-6">
                                                  <div class="text-center my-5">
                                                       <a href="<?= base_url('v2'); ?>"><img src="<?= base_url('assets/v3/backend/') ?>images/logo-full-prasasti.png" alt=""></a>
                                                  </div>
                                                  <div class="media-login">
                                                       <img src="<?= base_url('assets/v3/backend/') ?>images/svg/student.svg" class="w-100" alt="">
                                                  </div>
                                             </div>
                                             <div class="col-xl-6">
                                                  <div class="auth-form">
                                                       <h3 class="text-start mb-4 font-w600">Login ke Sistem</h3>
                                                       <?php if (!empty($this->session->flashdata('status'))) { ?>
                                                            <div class="alert alert-danger alert-dismissible fade show">
                                                                 <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                                                      <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                                      <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                      <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                 </svg>
                                                                 <strong>Kesalahan!</strong> <?= $this->session->flashdata('message') ?>
                                                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                                            </div>
                                                       <?php } ?>
                                                       <form action="<?= base_url('v2/authentications/signin') ?>" method="post" class="needs-validation" novalidate>
                                                            <div class="form-group">
                                                                 <label class="mb-1 text-black">Username<span class="required">*</span></label>
                                                                 <input type="text" class="form-control" name="username" placeholder="johndoe" required autocomplete="off" autofocus>
                                                                 <div class="invalid-feedback">
                                                                      Mohon masukan username anda!
                                                                 </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <label class="mb-1 text-black">Password<span class="required">*</span></label>
<!--                                                                 <input type="password" class="form-control" name="password" placeholder="*******" required autocomplete="off">-->
                                                                 <div class="input-group mb-2">
                                                                      <input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required autocomplete="off">
                                                                      <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" id="password-addon" onclick="createpassword('pwd', this)"><i class="mdi mdi-eye-outline"></i></a>
                                                                 </div>
                                                                 <div class="invalid-feedback">
                                                                      Mohon masukan password anda!
                                                                 </div>
                                                            </div>
<!--                                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">-->
<!--                                                                 <div class="form-group">-->
<!--                                                                      <div class=" form-check ms-1 mb-2">-->
<!--                                                                           <input type="checkbox" class="form-check-input" id="basic_checkbox_1">-->
<!--                                                                           <label class="custom-control-label ms-1" for="basic_checkbox_1">I agree with Davur <a href="javascript:void(0);">Terms & Conditions</a></label>-->
<!--                                                                      </div>-->
<!--                                                                      <div class=" form-check ms-1">-->
<!--                                                                           <input type="checkbox" class="form-check-input" id="basic_checkbox_2">-->
<!--                                                                           <label class="custom-control-label ms-1" for="basic_checkbox_2">Remember my preference</label>-->
<!--                                                                      </div>-->
<!--                                                                 </div>-->
<!--                                                            </div>-->
                                                            <div class="text-center mt-2">
                                                                 <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                                            </div>
                                                       </form>
                                                       <div class="new-account mt-3 d-flex align-items-center justify-content-between flex-wrap">
                                                            <small class="mb-0">Kembali ke <a class="text-primary" href="<?= base_url('v2') ?>">Halaman Utama</a></small>
                                                            <a href="javascript:void(0);" class="small" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Silahkan hubungi administrator PRASASTI pada Dinas Arsip dan Perpustakaan Kabupaten Sumedang." title="Lupa Password">Lupa Password?</a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>


     <!--**********************************
        Scripts
    ***********************************-->
     <!-- Required vendors -->
     <script src="<?= base_url('assets/v3/backend/') ?>vendor/global/global.min.js"></script>
     <script src="<?= base_url('assets/v3/backend/') ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
     <script src="<?= base_url('assets/v3/backend/') ?>js/custom.min.js"></script>
     <script src="<?= base_url('assets/v3/backend/') ?>js/deznav-init.js"></script>

     <!-- Jquery Validation -->
     <script src="<?= base_url('assets/v3/backend/') ?>vendor/jquery-validation/jquery.validate.min.js"></script>
     <!-- Form validate init -->
     <script src="<?= base_url('assets/v3/backend/') ?>js/plugins-init/jquery.validate-init.js"></script>

     <script>
         let createpassword = (type, ele) => {
             document.getElementById(type).type = document.getElementById(type).type == "password" ? "text" : "password"
             let icon = ele.childNodes[0].classList
             let stringIcon = icon.toString()
             if (stringIcon.includes("mdi-eye-outline")) {
                 ele.childNodes[0].classList.remove("mdi-eye-outline")
                 ele.childNodes[0].classList.add("mdi-eye-off-outline")
             } else {
                 ele.childNodes[0].classList.add("mdi-eye-outline")
                 ele.childNodes[0].classList.remove("mdi-eye-off-outline")
             }
         }
     </script>

</body>

</html>
